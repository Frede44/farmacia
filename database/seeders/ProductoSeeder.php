<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Productos;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Primero obtienes la categoría por nombre
        $categoria = Categoria::where('nombre', 'Caja de pastillas')->first();
        Productos::create([
            'codigo' => 'P001',
            'nombre' => 'Producto 1',
            'descripcion' => 'Descripción del producto 1',
            'categoria_id' => $categoria->id, // Asociando la categoría al producto
            'precio_venta' => 50,
            'imagen' => '1746757922_1143252.jpg',

        ]);
    }
}
