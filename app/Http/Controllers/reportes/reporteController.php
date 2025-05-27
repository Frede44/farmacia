<?php

namespace App\Http\Controllers\reportes;

use App\Http\Controllers\Controller;
use App\Models\DetalleVentas;
use App\Models\Ventas;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reporteController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:reportes.index')->only('index'); // Permiso para ver la lista de reportes
    }
    public function index()
    {
        // 1) Consulta los 10 productos más vendidos
        $productosMasVendidos = DB::table('ventas_detalles')
            ->select(
                'productos.id',
                'productos.nombre',
                DB::raw('SUM(ventas_detalles.cantidad) as ventas')
            )
            ->join('productos', 'ventas_detalles.producto_id', '=', 'productos.id')
            ->groupBy('productos.id', 'productos.nombre')
            ->orderBy('ventas', 'desc')
            ->limit(10)
            ->get();

        // 2) Calcula el total de ventas para el porcentaje
        $totalVentas = $productosMasVendidos->sum('ventas');

        // 3) Define la paleta de colores (debe coincidir con tu CSS)
        $colores = ['blue', 'green', 'purple', 'orange'];

        // 4) Agrega a cada producto su porcentaje y su clase de color
        $productosMasVendidos = $productosMasVendidos->map(function ($item, $index) use ($totalVentas, $colores) {
            $item->porcentaje = $totalVentas > 0 ? round(($item->ventas / $totalVentas) * 100, 2) : 0;
            $item->colorClass = $colores[$index % count($colores)];
            return $item;
        });

        // 5) Prepara los datos para CanvasJS
        $dataPoints = $productosMasVendidos->map(function ($item) {
            return [
                'label' => $item->nombre,
                'y' => $item->ventas
            ];
        });

        return view('reportes.index', [
            'productosMasVendidos' => $productosMasVendidos,
            'dataPoints' => $dataPoints
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

    

        return back()->with('error', 'Tipo de exportación no válido.');
    }
}
