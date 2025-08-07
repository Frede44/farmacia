<?php

namespace App\Http\Controllers\reportes;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ventas\ventasController;
use App\Models\Compras;
use App\Models\DetalleVentas;
use App\Models\Productos;
use App\Models\Ventas;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Exporter\Exporter;

class reporteController extends Controller
{
    private $exporter;




    public function __construct(Exporter $exporter)
    {
        $this->middleware('can:reportes.index')->only('index'); // Permiso para ver la lista de reportes
        $this->exporter = $exporter;
    }
    public function index()
    {

        Carbon::setLocale('es');
        // 1) Consulta los 10 productos más vendidos
        $cantidadVendida = Ventas::select(DB::raw('SUM(total) as total_vendido'))
            ->get();

        $numeroVentas = Ventas::count();

        $promedioVentas = $numeroVentas > 0 ? $cantidadVendida->sum('total_vendido') / $numeroVentas : 0;

        $numeroProductos = Productos::count();

        $ventas2 = Ventas::selectRaw('DATE(fecha) as fecha, COUNT(*) as ventas, SUM(total) as ingresos')
            ->whereBetween('fecha', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy(DB::raw('DATE(fecha)'))
            ->orderBy(DB::raw('MIN(fecha)'))
            ->get();

        $productosMasVendidos = DB::table('ventas_detalles')
            ->join('productos', 'ventas_detalles.producto_id', '=', 'productos.id')
            ->select('productos.nombre as label', DB::raw('SUM(ventas_detalles.cantidad) as y'))
            ->groupBy('productos.nombre')
            ->orderByDesc('y')
            ->limit(10) // o los que quieras mostrar
            ->get();

        $totalGeneral = DB::table('ventas_detalles')
            ->join('productos', 'ventas_detalles.producto_id', '=', 'productos.id')
            ->select(DB::raw('SUM(ventas_detalles.cantidad * ventas_detalles.precio_unitario) as total'))
            ->value('total');

        $categoriasMasVendidas = DB::table('ventas_detalles')
            ->join('productos', 'ventas_detalles.producto_id', '=', 'productos.id')
            ->join('categoria', 'productos.categoria_id', '=', 'categoria.id')
            ->select(
                'categoria.nombre as label',
                DB::raw('SUM(ventas_detalles.cantidad) as y'),
                DB::raw('SUM(ventas_detalles.cantidad * ventas_detalles.precio_unitario) as total')
            )
            ->groupBy('categoria.nombre')
            ->orderByDesc('y')
            ->limit(10)
            ->get()
            ->map(function ($item) use ($totalGeneral) {
                $item->porcentaje = $totalGeneral > 0 ? round(($item->total / $totalGeneral) * 100, 2) : 0;
                return $item;
            });

        $ventasPorDia = $ventas2->map(function ($venta) {
            return [
                'dia' => Carbon::parse($venta->fecha)->locale('es')->dayName,
                'ventas' => $venta->ventas,
                'ingresos' => $venta->ingresos,
            ];
        });



        return view('reportes.index', [
            'cantidadVendida' => $cantidadVendida,
            'numeroVentas' => $numeroVentas,
            'promedioVentas' => $promedioVentas,
            "numeroProductos" => $numeroProductos,
            "ventasPorDia" => $ventasPorDia,
            "productosMasVendidos" => $productosMasVendidos,
            "totalGeneral" => $totalGeneral,
            "categoriasMasVendidas" => $categoriasMasVendidas
        ]);
    }

    public function vistaGanancia()
    {

        return view('reportes.ganancias');
    }

    public function reporteGanancias(Request $request)
    {
        $filterType = $request->input('filterType', 'day');
        
        // Inicializamos las consultas para poder aplicar filtros dinámicamente
        $queryVentas = Ventas::query();
        $queryCompras = Compras::query();

        $startDate = null;
        $endDate = null;

        // Lógica de filtrado para establecer las fechas
        switch ($filterType) {
            case 'day':
                $date = $request->input('specificDate', date('Y-m-d'));
                $startDate = Carbon::parse($date)->startOfDay();
                $endDate = Carbon::parse($date)->endOfDay();
                break;
            case 'month':
                $month = $request->input('monthSelect', date('m'));
                $year = $request->input('yearSelect', date('Y'));
                $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
                $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
                break;
            case 'year':
                $year = $request->input('yearSelect', date('Y'));
                $startDate = Carbon::createFromDate($year, 1, 1)->startOfYear();
                $endDate = Carbon::createFromDate($year, 1, 1)->endOfYear();
                break;
            case 'range':
                $startDate = Carbon::parse($request->input('startDate'))->startOfDay();
                $endDate = Carbon::parse($request->input('endDate'))->endOfDay();
                break;
            default:
                // Por defecto, usamos el día actual
                $startDate = Carbon::now()->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                break;
        }

        // Aplicamos el rango de fechas a las consultas
        if ($startDate && $endDate) {
            $queryVentas->whereBetween('fecha', [$startDate, $endDate]);
            $queryCompras->whereBetween('fecha', [$startDate, $endDate]);
        }

        // --- CÁLCULOS PARA LOS KPIs ---
        $totalVentas = $queryVentas->sum('total');
        $numeroVentas = $queryVentas->count();
        $totalCompras = $queryCompras->sum('total');
        $ganancias = $totalVentas - $totalCompras;
        $ticketPromedio = ($numeroVentas > 0) ? $totalVentas / $numeroVentas : 0;

        // --- DATOS PARA LA GRÁFICA ---
        // Clonamos las consultas para no afectar los cálculos anteriores
        $ventasPorDiaQuery = clone $queryVentas;
        $comprasPorDiaQuery = clone $queryCompras;

        // Agrupamos ventas y compras por día
        $ventasAgrupadas = $ventasPorDiaQuery
            ->select(DB::raw('DATE(fecha) as dia'), DB::raw('SUM(total) as total_ventas'))
            ->groupBy('dia')->pluck('total_ventas', 'dia');

        $comprasAgrupadas = $comprasPorDiaQuery
            ->select(DB::raw('DATE(fecha) as dia'), DB::raw('SUM(total) as total_compras'))
            ->groupBy('dia')->pluck('total_compras', 'dia');

        // Unimos las fechas de ambas colecciones para tener todos los días con actividad
        $dias = $ventasAgrupadas->keys()->merge($comprasAgrupadas->keys())->unique()->sort();

        $labels = [];
        $chartData = [];

        foreach ($dias as $dia) {
            $labels[] = Carbon::parse($dia)->format('d/m/Y'); // Formato de fecha legible
            $ventaDia = $ventasAgrupadas->get($dia, 0);
            $compraDia = $comprasAgrupadas->get($dia, 0);
            $chartData[] = $ventaDia - $compraDia;
        }

        // --- CONSTRUCCIÓN DE LA RESPUESTA JSON ---
        $data = [
            'ganancias' => number_format($ganancias, 2, '.', ','),
            'totalVentas' => number_format($totalVentas, 2, '.', ','),
            'totalCompras' => number_format($totalCompras, 2, '.', ','),
            'numeroVentas' => $numeroVentas,
            'ticketPromedio' => number_format($ticketPromedio, 2, '.', ','),
            'grafica' => [
                'labels' => $labels,
                'data' => $chartData,
            ]
        ];

        return response()->json($data);
    }

    public function exportar(Request $request)
    {
        $tipo = $request->input('tipo');
        $rango = (int) $request->input('rango');
        $fechaInicio = now()->subDays($rango);

        $ventas = DetalleVentas::with('producto')->where('created_at', '>=', $fechaInicio)->get();

        if ($tipo === 'pdf') {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('exports.ventas_pdf', ['ventas' => $ventas]);
            return $pdf->download('ventas.pdf');
        }
        if ($tipo === 'excel') {
        }



        return back()->with('error', 'Tipo de exportación no válido.');
    }
}
