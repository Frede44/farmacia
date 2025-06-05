<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function index()
    {
        // Verifica si el usuario ya está autenticado
         $roles = Role::all();
        return view('Auth.Register', compact('roles'));
      
    }

   

    public function store(Request $request)
    {
        $user =User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

       
           
        $user->roles()->sync($request->rol);

        auth()->login($user);

  

        // Logic to create a new user

        return redirect()->route('usuarios.index')->with('success', 'Registration successful!');
    }
}
