<?php

namespace App\Http\Controllers\Rol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class rolController extends Controller
{
    public function index()
    {
        // Verifica si el usuario tiene el permiso para ver la lista de roles
        $role = Role::all();
        return view('rol.index', compact('role'));
    }

   
}
