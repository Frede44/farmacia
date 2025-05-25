<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Models\Compras;
use App\Models\DetalleCompras;
use App\Models\Productos;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class comprasController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:compras.index')->only('index'); // Permiso para ver la lista de compras
        $this->middleware('can:compras.create')->only('create'); // Permiso para crear una compra
    }
    public function index()
    {
        $compras = Compras::all();
        return view('compras.index', compact('compras'));
    }

    public function show($id)
    {
        $compras = Compras::findOrFail($id);
        $detalles = DetalleCompras::with('producto')->where('compra_id', $id)->get();
        return view('compras.show', compact('compras', 'detalles'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Productos::all();
        return view('compras.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
      
        // Validar la solicitud
   $request->validate([
            'productos' => 'required|array',
            'productos.*.id_proveedor' => 'required|exists:proveedor,id',
            'productos.*.id_producto' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio' => 'required|numeric|min:0',
        ]);

    

        $total = 0;

        // Calcular total
       foreach ($request->productos as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
        // Crear la compra
        $compra = Compras::create([
            'usuario_id' => auth()->user()->id,
            'total' => $total,
            'fecha' => now(),
        ]);

        // Crear los detalles de la compra
        foreach ($request->productos as $producto) {
            $detalles = DetalleCompras::create([
                'compra_id' => $compra->id,
                'proveedor_id' => $producto['id_proveedor'],
                'producto_id' => $producto['id_producto'],
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio'],
                'subtotal' => $producto['precio'] * $producto['cantidad'],
            ]);
        }

        

        return redirect()->route('compras.index')->with('success', 'Compra creada exitosamente.');
    }

    public function edit($id) {
        $compra = Compras::findOrFail($id);
        return view('compras.edit', compact('compra'));
    }

    public function destroy($id) {
        $compra = Compras::findOrFail($id);
        $compra->delete();
        return redirect()->route('compras.index')->with('success', 'Compra eliminada exitosamente.');
    }

}
