<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Models\Personas;
use Illuminate\Http\Request;

class ventasController extends Controller
{

    public function __construct()
    {
    
        $this->middleware('can:ventas.index')->only(['index']);
        $this->middleware('can:ventas.create')->only(['create', 'store']);
        $this->middleware('can:ventas.show')->only(['show']);
        $this->middleware('can:ventas.edit')->only(['edit', 'update']);
        $this->middleware('can:ventas.destroy')->only(['destroy']);
    }

    public function index()
    {
        $personas = Personas::all();
        return view('ventas.index', compact('personas'));
    }

    public function create()
    {
        $personas = Personas::all();
        return view('ventas.create', compact('personas'));
    }

    public function store(Request $request)
    {
        // Logic to store the sale
        return redirect()->route('ventas.index')->with('success', 'Venta creada con éxito.');
    }

    public function show($id)
    {
        return view('ventas.show', compact('id'));
    }

    public function edit($id)
    {
        return view('ventas.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update the sale
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada con éxito.');
    }

    public function destroy($id)
    {
        // Logic to delete the sale
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada con éxito.');
    }
}
