<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
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

        $mesActual = Carbon::now()->format('Y-m');
    $mesAnterior = Carbon::now()->subMonth()->format('Y-m');

    // Total ventas mes actual
    $ventaActual = DB::table('ventas')
        ->whereRaw("DATE_FORMAT(fecha, '%Y-%m') = ?", [$mesActual])
        ->sum('total');

    // Total ventas mes anterior
    $ventaAnterior = DB::table('ventas')
        ->whereRaw("DATE_FORMAT(fecha, '%Y-%m') = ?", [$mesAnterior])
        ->sum('total');

    // Calcular variación (%)
    $porcentaje = 0;
    if ($ventaAnterior > 0) {
        $porcentaje = round((($ventaActual - $ventaAnterior) / $ventaAnterior) * 100,2);
    }


        $ventasPorMes = DB::table('ventas')
        ->select(
            DB::raw("DATE_FORMAT(fecha, '%Y-%m') as periodo"),
            DB::raw("SUM(total) as total")
        )
        ->groupBy('periodo')
        ->orderBy('periodo')
        ->get();
        return view('panel.index', compact('ventasPorMes','ventaActual', 'ventaAnterior', 'porcentaje'));
    }

    
}
