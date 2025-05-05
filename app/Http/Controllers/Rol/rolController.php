<?php

namespace App\Http\Controllers\Rol;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class rolController extends Controller
{

    public function __construct()
    {
        // Asigna los permisos a las acciones del controlador
        $this->middleware('can:rol.index')->only('index');
        $this->middleware('can:rol.create')->only('create', 'store');
        $this->middleware('can:rol.show')->only('show');
        $this->middleware('can:rol.edit')->only('edit', 'update');
        $this->middleware('can:rol.destroy')->only('destroy');
    }


    public function index()
    {
        // Verifica si el usuario tiene el permiso para ver la lista de roles
        $role = Role::all();
        return view('rol.index', compact('role'));
    }

    

    public function create()
    {
        // Verifica si el usuario tiene el permiso para crear un nuevo rol
        $permissions = Permission::all()->groupBy(function($item) {
            return explode('.', $item->name)[0];
        });
        return view('rol.create', compact('permissions'));
    }

    public function edit(Role $rol)  {
        $permissions = Permission::all()->groupBy(function($item) {
            return explode('.', $item->name)[0];
        });
    
        // Obtener permisos asignados al rol como array de nombres
        $rolePermissions = $rol->permissions->pluck('name')->toArray();
    
        return view('rol.edit', compact('permissions', 'rol', 'rolePermissions'));
    }

    public function update(Request $request, Role $rol)  {
        // Verifica si el usuario tiene el permiso para actualizar un rol
        $request->validate([
            'name' => 'required',
           
        ]);

        $rol->update(['name' => $request->name]);
        $rol->syncPermissions($request->permissions);

        return redirect()->route('rol.index')->with('success', 'Rol actualizado exitosamente.');
    }

 

    public function store(Request $request)
    {
        // Verifica si el usuario tiene el permiso para almacenar un nuevo rol
        $request->validate([
            'name' => 'required|unique:roles|max:255',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('rol.index')->with('success', 'Rol creado exitosamente.');
    }

    public function destroy(Role $rol)  {

        $rol->delete();
        return redirect()->route('rol.index')->with('success', 'Rol borrado exitosamente.');

        
    }

   
}
