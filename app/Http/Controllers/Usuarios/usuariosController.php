<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class usuariosController extends Controller
{

    public function __construct()
    {
    
        $this->middleware("can:usuarios.index")->only("index"); // Permiso para ver la lista de usuarios
        $this->middleware("can:usuarios.create")->only("create", "store"); // Permiso para crear usuarios
        $this->middleware("can:usuarios.edit")->only("edit", "update"); // Permiso para editar usuarios
        $this->middleware("can:usuarios.destroy")->only("destroy"); // Permiso para eliminar usuarios
    }

    public function index()
    {
        // Aquí puedes manejar la lógica para mostrar la lista de usuarios
        $users = User::with('roles')->get();

        // unir roles con usuarios
        

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
