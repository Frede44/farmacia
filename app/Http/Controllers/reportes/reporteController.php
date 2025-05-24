<?php

namespace App\Http\Controllers\reportes;

use App\Http\Controllers\Controller;
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

        $productosMasVendidos = DB::table('ventas_detalles')
            ->select('productos.nombre', DB::raw('SUM(ventas_detalles.cantidad) as total_vendido'))
            ->join('productos', 'ventas_detalles.producto_id', '=', 'productos.id')
            ->groupBy('productos.nombre')
            ->orderBy('total_vendido', 'desc')
            ->limit(10)
            ->get();
        return view('reportes.index', compact('productosMasVendidos'));
    }


}
