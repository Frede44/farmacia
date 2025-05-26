<?php

namespace App\Http\Controllers\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class categoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::select('id','nombre','descripcion')
        ->get();
        return view('categorias.index',['categorias' => $categorias]);
    }
    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:categoria,nombre',
            'descripcion' => 'nullable|string|max:250',
        ]);
        Categoria::create(
            [
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]
        
        );
        return redirect()->route('categorias.index')->with('success', 'Categoria creada con éxito.');
    }
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', ['categoria' => $categoria]);
    }
    public function update(Request $request, Categoria $categoria)
            {
                $request->validate([
                    
                    'nombre' => 'required|string|max:50|unique:productos,nombre,',
                    'descripcion' => 'nullable|string|max:250',
                     
                ]);

                // Actualiza otros campos
                $categoria->update([
                   
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                  // ya actualizada arriba si es necesario
                ]);
            
                return redirect()->route('categorias.index')->with('success', 'Producto actualizado correctamente.');
            }  
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoria eliminada con éxito.');
    }   
}
