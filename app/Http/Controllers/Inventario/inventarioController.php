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
    $inventarios = Inventario::with('producto.categoria')
        ->select('id','id_producto','xunidad','xcaja','caducidad','cantidad_caja','unidad_caja', 'total_unidad','id_categoria')
        ->where('estado', true) // Filtrar solo inventarios activos
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
       

        $productos = Productos::with('categoria')
            ->select('id','codigo','nombre','descripcion','imagen','categoria_id')
            ->where('estado', true) // Filtrar solo productos activos
            ->get();
        return view('inventario.create',compact ('productos'));
    }

    public function store(Request $request)
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

        $total = $request->cantidad_caja *  $request->unidad_caja;

        $categoria = Productos::findOrFail($request->id_producto)->categoria_id;

        Inventario::create([
            'id_producto' => $request->id_producto,
          //  'compra' => $request->compra,
            'xunidad' => $request->xunidad,
            'xcaja' => $request->xcaja,
            'caducidad' => $request->caducidad,
            'cantidad_caja' => $request->cantidad_caja,
            'unidad_caja' => $request->unidad_caja,
            'total_unidad' => $total,
            'id_categoria' => $categoria,
            'estado' => true, // Por defecto, el inventario está activo

                ]);
        
        return redirect()->route('inventario.index')->with('success', '¡Producto guardado correctamente!');
    }
    public function edit($id)
    {
    $inventario = Inventario::findOrFail($id);

    // IDs de productos usados en otros inventarios (excluyendo el actual)
    $productosUsados = Inventario::where('id', '!=', $inventario->id)
        ->pluck('id_producto');
    // Solo productos activos y que no estén en otros inventarios
    $productos = Productos::where('estado', true)
        ->whereNotIn('id', $productosUsados)
        ->get();

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
            'total_unidad' => $request->cantidad_caja * $request->unidad_caja,
            'unidad_caja' => $request->unidad_caja,
           // "estado" => true, // Por defecto, el inventario está activo
        ]);

        return redirect()->route('inventario.index')->with('success', '¡Producto actualizado correctamente!');
    }
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->estado = false;
        $inventario->save();
        return redirect()->route('inventario.index')->with('success', '¡Producto eliminado correctamente!');
    }

    

     
}
