<?php

namespace Database\Seeders;

use App\Models\Personas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class personasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

DB::table('personas')->insert([
    [
        'nombre' => 'CF',
        'dpi' => '1',
        'telefono' => '1',
        'direccion' => '1',
        'correo' => 'cf@gmail.com'
    ],
  
]);

    }
}
