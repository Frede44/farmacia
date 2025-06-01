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

         Permission::create(['name' => 'panel.index', 'descripcion' => 'Vista panel de control'])->syncRoles([$role1, $role2]);
   
        Permission::create(['name' => 'productos.index', 'descripcion' => 'Vista productos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'productos.edit', 'descripcion' => 'Vista editar productos' ])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'productos.create', 'descripcion' => 'Vista crear productos' ])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'productos.destroy','descripcion' => 'Eliminar productos' ])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'usuarios.index', 'descripcion' => 'Vista usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.create', 'descripcion' => 'Vista crear usuario'])->syncRoles([$role1 ]);
        Permission::create(['name' => 'usuarios.show', 'descripcion' => 'Ver detalles de usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.edit', 'descripcion' => 'Vista editar usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'usuarios.destroy', 'descripcion' => 'Eliminar usuario'])->syncRoles([$role1]);

        Permission::create(['name' => 'categorias.index', 'descripcion' => 'Vista categorías'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'categorias.create', 'descripcion' => 'Vista crear categoría'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'categorias.show', 'descripcion' => 'Ver detalles de categoría'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'categorias.edit', 'descripcion' => 'Vista editar categoría'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'categorias.destroy', 'descripcion' => 'Eliminar categoría'])->syncRoles([$role1, $role2]);

       Permission::create(['name' => 'inventario.index', 'descripcion' => 'Vista inventario'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'inventario.create', 'descripcion' => 'Vista crear inventario'])->syncRoles([$role1]);
          Permission::create(['name' => 'inventario.show', 'descripcion' => 'Ver detalles de inventario'])->syncRoles([$role1]);
          Permission::create(['name' => 'inventario.edit', 'descripcion' => 'Vista editar inventario'])->syncRoles([$role1]);
          Permission::create(['name' => 'inventario.destroy', 'descripcion' => 'Eliminar registro de inventario'])->syncRoles([$role1]);

          Permission::create(['name' => 'proveedor.index', 'descripcion' => 'Vista proveedor'])->syncRoles([$role1, $role2]);
          Permission::create(['name' => 'proveedor.create', 'descripcion' => 'Vista crear proveedor'])->syncRoles([$role1]);
           Permission::create(['name' => 'proveedor.show', 'descripcion' => 'Ver detalles de proveedor'])->syncRoles([$role1]);
           Permission::create(['name' => 'proveedor.edit', 'descripcion' => 'Vista editar proveedor'])->syncRoles([$role1]);
           Permission::create(['name' => 'proveedor.destroy', 'descripcion' => 'Eliminar registro de proveedor'])->syncRoles([$role1]);

        Permission::create(['name' => 'rol.index', 'descripcion' => 'Vista roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'rol.create', 'descripcion' => 'Vista crear rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'rol.show', 'descripcion' => 'Ver detalles de rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'rol.edit', 'descripcion' => 'Vista editar rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'rol.destroy', 'descripcion' => 'Eliminar rol'])->syncRoles([$role1]);

        Permission::create(['name' => 'persona.index', 'descripcion' => 'Vista personas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'persona.create', 'descripcion' => 'Vista crear persona'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'persona.show', 'descripcion' => 'Ver detalles de persona'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'persona.edit', 'descripcion' => 'Vista editar persona'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'persona.destroy', 'descripcion' => 'Eliminar persona'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'ventas.index', 'descripcion' => 'Vista ventas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'ventas.create', 'descripcion' => 'Vista crear venta'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'ventas.show', 'descripcion' => 'Ver detalles de venta'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'ventas.edit', 'descripcion' => 'Vista editar venta'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'ventas.destroy', 'descripcion' => 'Eliminar venta'])->syncRoles([$role1, $role2]);

       
        
        Permission::create(['name' => 'reportes.index', 'descripcion' => 'Vista reportes'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'compras.index', 'descripcion' => 'Vista compras'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'compras.create', 'descripcion' => 'Vista crear compra'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'compras.show', 'descripcion' => 'Ver detalles de compra'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'compras.edit', 'descripcion' => 'Vista editar compra'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'compras.destroy', 'descripcion' => 'Eliminar compra'])->syncRoles([$role1, $role2]);

        
    
          
    }
}
