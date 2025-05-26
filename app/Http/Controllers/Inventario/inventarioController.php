<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\Models\Inventario;
use App\Models\Productos;
use Illuminate\Http\Request;


class InventarioController extends Controller
{
    public function index()
{
    $inventarios = Inventario::with('producto:id,nombre')
        ->select('id','id_producto','xunidad','xcaja','caducidad','cantidad_caja','unidad_caja')
        ->get()
        ->map(function($item) {
            $item->fechaCaducidadObj = new \DateTime($item->caducidad);
            $hoy = new \DateTime();
            $diff = $hoy->diff($item->fechaCaducidadObj);
            $item->diferenciaDias = (int)$diff->format('%r%a'); // días con signo (+/-)
            return $item;
        });

    return view('inventario.index', ['inventarios' => $inventarios]);
}
    public function create()
    {
        $productos = Productos::all();
        return view('inventario.create',compact ('productos'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'id_producto' => 'required|exists:productos,id',
          //  'compra' => 'required|numeric',
            'xunidad' => 'required|numeric',
            'xcaja' => 'required|numeric',
            'caducidad' => 'required|date',
            'cantidad_caja' => 'required|integer',
            'unidad_caja'=> 'required|integer',
        ]);

        $total = $request->cantidad_caja *  $request->unidad_caja;

        Inventario::create([
            'id_producto' => $request->id_producto,
          //  'compra' => $request->compra,
            'xunidad' => $request->xunidad,
            'xcaja' => $request->xcaja,
            'caducidad' => $request->caducidad,
            'cantidad_caja' => $request->cantidad_caja,
            'unidad_caja' => $request->unidad_caja,
            'total_unidad' => $total
                ]);
        
        return redirect()->route('inventario.index')->with('success', '¡Producto guardado correctamente!');
    }
    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);
        $productos = Productos::all();
        return view('inventario.edit', ['inventario' => $inventario, 'productos' => $productos]);
    }
    public function update(Request $request, Inventario $inventario)
    {
        $request->validate([
            'id_producto' => 'required|exists:productos,id',
          //  'compra' => 'required|numeric',
            'xunidad' => 'required|numeric',
            'xcaja' => 'required|numeric',
            'caducidad' => 'required|date',
            'cantidad_caja' => 'required|integer',
            'unidad_caja'=> 'required|integer',
        ]);

        $inventario->update([
            'id_producto' => $request->id_producto,
          //  'compra' => $request->compra,
            'xunidad' => $request->xunidad,
            'xcaja' => $request->xcaja,
            'caducidad' => $request->caducidad,
            'cantidad_caja' => $request->cantidad_caja,
            'unidad_caja' => $request->unidad_caja,
        ]);

        return redirect()->route('inventario.index')->with('success', '¡Producto actualizado correctamente!');
    }
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();
        return redirect()->route('inventario.index')->with('success', '¡Producto eliminado correctamente!');
    }

    

     
}
