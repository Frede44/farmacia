<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;

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

    public function edit($id)
    {
        // Aquí puedes manejar la lógica para editar un usuario
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view("usuarios.edit", compact("user", "roles")); // Pasar el usuario a la vista de edición
    }

    public function update(Request $request, User $user)
    {
        // Validación
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => ['nullable', 'string', 'confirmed'],
            'rol' => 'required|exists:roles,id',
        ]);

        // Preparamos los datos para actualizar
        $dataToUpdate = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ];

        if (!empty($validatedData['password'])) {
            $dataToUpdate['password'] = Hash::make($validatedData['password']);
        }

        // ✅ Aquí sí se actualiza correctamente
        $user->update($dataToUpdate);

        

        // Redirección con éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito');
    }
}
