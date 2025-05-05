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
            'nombre' => 'required|string|max:35|unique:categoria,nombre',
            'descripcion' => 'nullable|string|max:500',
        ]);
        Categoria::create(
            [
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]
        
        );
        return redirect()->route('categorias.index')->with('success', 'Categoria creada con éxito.');
    }
}
