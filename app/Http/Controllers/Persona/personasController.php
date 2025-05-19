<?php

namespace App\Http\Controllers\Persona;

use App\Http\Controllers\Controller;
use App\Models\Personas;
use Illuminate\Http\Request;

class personasController extends Controller
{
    public function __construct()
    {
        // Asigna los permisos a las acciones del controlador
        $this->middleware('can:persona.index')->only('index');
        $this->middleware('can:persona.create')->only('create', 'store');
        $this->middleware('can:persona.show')->only('show');
        $this->middleware('can:persona.edit')->only('edit', 'update');
        $this->middleware('can:persona.destroy')->only('destroy');
    }

    public function index()
    {
        // Verifica si el usuario tiene el permiso para ver la lista de personas

        $personas = Personas::all();
        return view('persona.index', compact('personas'));
    }

    public function create()
    {
        // Verifica si el usuario tiene el permiso para crear una nueva persona
        return view('persona.create');
    }

    public function store(Request $request)
    {
        // Verifica si el usuario tiene el permiso para almacenar una nueva persona
        $request->validate([
            'nombre' => 'required|string|max:100',
            'dpi' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:250',
            'correo' => 'required|email|max:255',
        ]);

        Personas::create($request->all());
        return redirect()->route('persona.index')->with('success', 'Persona creada con éxito.');
    }

    public function edit(Personas $persona)
    {
        // Verifica si el usuario tiene el permiso para ver los detalles de una persona
        return view('persona.edit', compact('persona'));
    }

    public function update(Request $request, Personas $persona)
    {
        // Verifica si el usuario tiene el permiso para actualizar una persona
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dpi' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
        ]);

        $persona->update($request->all());
        return redirect()->route('persona.index')->with('success', 'Persona actualizada con éxito.');
    }

    public function destroy(Personas $persona)
    {
        // Verifica si el usuario tiene el permiso para eliminar una persona
        $persona->delete();
        return redirect()->route('persona.index')->with('success', 'Persona eliminada con éxito.');
    }
}
