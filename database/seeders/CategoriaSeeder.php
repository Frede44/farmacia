<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(
            [
                
                'nombre' => 'Caja de pastillas',
                'descripcion' => 'Caja de pastillas de todo tipo',
            ]
            );
        
    }
}
