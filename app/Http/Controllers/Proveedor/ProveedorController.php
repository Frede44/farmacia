<?php

namespace App\Http\Controllers\Proveedor;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::select('id','nombre','numero_telefono','correo','descripcion')
        ->get();
        return view('proveedor.index',['proveedores' => $proveedores]);
    }

    public function create()
    {
        return view('proveedor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           
            'nombre' => 'required|string|max:35',
            'numero_telefono' => ['required', 'regex:/^\d{4}-\d{4}$/', 'unique:proveedor,numero_telefono'],
            'correo' => ['nullable', 'string', 'email', 'max:500', 'unique:proveedor,correo'],
            'descripcion' => 'nullable|string|max:500',
            
        ]);
        Proveedor::create(
            [
                'nombre' => $request->nombre,
                'numero_telefono' => $request->numero_telefono,
                'correo' => $request->correo,
                'descripcion' => $request->descripcion,
            ]
        
        );
        return redirect()->route('proveedor.index')->with('success', 'Categoria creada con éxito.');
    }
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedor.edit', ['proveedor' => $proveedor]);
    }
    public function update(Request $request, Proveedor $proveedor)
            {
                $request->validate([
                    
                    'nombre' => 'required|string|max:35',
                    'numero_telefono' => ['required', 'regex:/^\d{4}-\d{4}$/', 'unique:proveedor,numero_telefono,'.$proveedor->id],
                    'correo' => ['nullable', 'string', 'email', 'max:500', 'unique:proveedor,correo,'.$proveedor->id],
                    'descripcion' => 'nullable|string|max:500',
                    
                ]);

                // Actualiza otros campos
                $proveedor->update([
                   
                    'nombre' => $request->nombre,
                    'numero_telefono' => $request->numero_telefono,
                    'correo' => $request->correo,
                    'descripcion' => $request->descripcion,
                  // ya actualizada arriba si es necesario
                ]);
            
                return redirect()->route('proveedor.index')->with('success', 'Producto actualizado correctamente.');
            }

            
    public function destroy($id)    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('proveedor.index')->with('success', 'Categoria eliminada con éxito.');
    }

    
}
