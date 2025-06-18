<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\DetalleVentas;
use App\Models\Inventario;
use App\Models\Ventas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:panel.index')->only('index');
    }
    public function index()
    {

        // Establecer el inicio de la semana en Lunes y el fin en Domingo
        $inicioSemana = Carbon::now()->startOfWeek(Carbon::MONDAY)->startOfDay();
        $finSemana = Carbon::now()->endOfWeek(Carbon::SUNDAY)->endOfDay();


        // Obtener las ventas de la semana actual, agrupadas por día
        $ventasDeLaSemanaDB = DB::table('ventas')
            ->select(
                DB::raw('DATE(fecha) as fecha_dia'), // La fecha completa del día de venta
                DB::raw('SUM(total) as total_ventas_dia') // Suma del total de ventas para ese día
            )
            ->whereBetween('fecha', [$inicioSemana, $finSemana]) // Filtra por el rango de la semana actual
            ->groupBy('fecha_dia') // Agrupa por la fecha para sumar todas las ventas de un mismo día
            ->orderBy('fecha_dia', 'asc') // Ordena por fecha
            ->get()
            ->keyBy(function ($item) {
                // Crea un índice usando la fecha 'YYYY-MM-DD' para fácil acceso
                return Carbon::parse($item->fecha_dia)->toDateString();
            });

        // Preparar el array final para el gráfico (Lunes a Domingo)
        $ventasParaGrafico = [];
        $diasSemanaNombres = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $diaActualIteracion = $inicioSemana->copy(); // Empezamos desde el Lunes

        for ($i = 0; $i < 7; $i++) {
            $fechaFormatoYMD = $diaActualIteracion->toDateString(); // 'YYYY-MM-DD'
            // dayOfWeekIso devuelve 1 para Lunes, 2 para Martes, ..., 7 para Domingo
            $nombreDia = $diasSemanaNombres[$diaActualIteracion->dayOfWeekIso - 1];

            // Busca si hay ventas para este día en los resultados de la BD
            $totalVentas = isset($ventasDeLaSemanaDB[$fechaFormatoYMD]) ? $ventasDeLaSemanaDB[$fechaFormatoYMD]->total_ventas_dia : 0;

            $ventasParaGrafico[] = [
                'label' => $nombreDia,       // Ej: "Lunes"
                'y'     => (float) $totalVentas, // El total de ventas (o 0)
                // 'fecha_original' => $fechaFormatoYMD // Opcional: si necesitas la fecha completa en JS
            ];

            $diaActualIteracion->addDay(); // Avanza al siguiente día
        }

        $ventasRecientes = Ventas::with('cliente')
            ->orderBy('fecha', 'desc')
            ->take(5)
            ->get();


        $productosVentas = DB::table('ventas_detalles')
            ->join('productos', 'ventas_detalles.producto_id', '=', 'productos.id')
            ->select(
                'productos.id',
                'productos.codigo',
                'productos.nombre',
                'productos.descripcion',

                'productos.imagen',
                'productos.categoria_id',
                DB::raw('SUM(ventas_detalles.cantidad) as total_vendido')
            )
            ->where('ventas_detalles.tipo_venta', '=', 'unidad')
            ->groupBy(
                'productos.id',
                'productos.codigo',
                'productos.nombre',
                'productos.descripcion',

                'productos.imagen',
                'productos.categoria_id'
            )
            ->orderByDesc('total_vendido')
            ->take(5)
            ->get();

       $productosPorVencer = Inventario::with('producto')
    ->where('caducidad', '<=', Carbon::now()->addDays(30))
    ->orderBy('caducidad', 'asc')
    ->get();

    foreach ($productosPorVencer as $producto) {
    $producto->dias_restantes = Carbon::now()->diffInDays(Carbon::parse($producto->caducidad), false);
}

$productosBajoStock = Inventario::where('total_unidad', '<=', 5)
    ->with('producto', 'categoria')
    ->get();

        return view('Panel.index', compact('ventasParaGrafico', 'ventasRecientes', 'productosVentas', 'productosPorVencer', 'productosBajoStock'));
    }
}
