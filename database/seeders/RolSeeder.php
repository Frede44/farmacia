<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'cajero']);

        Permission::create(['name' => 'dashboard.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'productos.index'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'productos.show'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'productos.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'productos.create'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'productos.destroy'])->syncRoles([$role1, $role2]);
        
        Permission::create(['name' => 'usuarios.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.create'])->syncRoles([$role1 ]);
        Permission::create(['name' => 'usuarios.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'categorias.index'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'categorias.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'categorias.show'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'categorias.edit'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'categorias.destroy'])->syncRoles([$role1, $role2]);

       Permission::create(['name' => 'inventario.index'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'inventario.create'])->syncRoles([$role1]);
          Permission::create(['name' => 'inventario.show'])->syncRoles([$role1]);
          Permission::create(['name' => 'inventario.edit'])->syncRoles([$role1]);
          Permission::create(['name' => 'inventario.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'rol.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'rol.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'rol.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'rol.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'rol.destroy'])->syncRoles([$role1]);
    
          
    }
}
