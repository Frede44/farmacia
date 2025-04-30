<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class usuariosController extends Controller
{
    public function index()
    {
        // Aquí puedes manejar la lógica para mostrar la lista de usuarios
        $users = User::all(); // Obtener todos los usuarios de la base de datos
        return view("usuarios.index", compact("users")); // Pasar los usuarios a la vista
    }

    public function store(Request $request)
    {
        // Aquí puedes manejar la lógica para almacenar un nuevo usuario
        // Por ejemplo, validar los datos y guardarlos en la base de datos
        // return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito');
    }

    public function destroy($id)
    {
        // Aquí puedes manejar la lógica para eliminar un usuario
        // Por ejemplo, buscar el usuario por ID y eliminarlo de la base de datos
        // return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito');
    }
}
