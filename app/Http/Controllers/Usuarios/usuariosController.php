<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;



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

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

       
        // Validación
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
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


       
        // Actualizamos el usuario
        $user->fill($dataToUpdate);
        $user->save();
        // Sincronizamos los roles
        $user->syncRoles([$validatedData['rol']]);
        // Si se desea, se puede enviar un correo de notificación al usuario


        // Redirección con éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito');
    }
}
