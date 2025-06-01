<?php

namespace App\Http\Controllers\reportes;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ventas\ventasController;
use App\Models\DetalleVentas;
use App\Models\Productos;
use App\Models\Ventas;
use Barryvdh\DomPDF\PDF;
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
        // 1) Consulta los 10 productos más vendidos
        $cantidadVendida = Ventas::select(DB::raw('SUM(total) as total_vendido'))
            ->get();

        $numeroVentas = Ventas::count();

        $promedioVentas = $numeroVentas > 0 ? $cantidadVendida->sum('total_vendido') / $numeroVentas : 0;

        $numeroProductos = Productos::count();

        $ventasPorDia = Ventas::selectRaw('DAYNAME(fecha) as dia, COUNT(*) as ventas, SUM(total) as ingresos')
            ->whereBetween('fecha', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy(DB::raw('DAYNAME(fecha)'))
            ->orderBy(DB::raw('MIN(fecha)')) // opcional si necesitas orden
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
