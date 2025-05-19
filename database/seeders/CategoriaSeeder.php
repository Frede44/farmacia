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
        Categoria::create([
            'nombre' => 'Tabletas',
            'descripcion' => 'Presentación en tabletas',
        ]);
        
        Categoria::create([
            'nombre' => 'Sobre',
            'descripcion' => 'Presentación en sobre',
        ]);
        
        Categoria::create([
            'nombre' => 'Frasco',
            'descripcion' => 'Presentación en frasco',
        ]);
        
        Categoria::create([
            'nombre' => 'Tabletas masticables',
            'descripcion' => 'Presentación en tabletas masticables',
        ]);
        
        Categoria::create([
            'nombre' => 'Vial',
            'descripcion' => 'Presentación en vial',
        ]);
        
        Categoria::create([
            'nombre' => 'Tableta',
            'descripcion' => 'Presentación en tableta',
        ]);
        
        Categoria::create([
            'nombre' => 'Jarabe',
            'descripcion' => 'Presentación en jarabe',
        ]);
        
        Categoria::create([
            'nombre' => 'Presentación',
            'descripcion' => 'Otra forma de presentación',
        ]);
        
        Categoria::create([
            'nombre' => 'Ungüento',
            'descripcion' => 'Presentación en ungüento',
        ]);
        
        Categoria::create([
            'nombre' => 'Inhalador',
            'descripcion' => 'Presentación en inhalador',
        ]);
        
        Categoria::create([
            'nombre' => 'Inyectable',
            'descripcion' => 'Presentación inyectable',
        ]);
        
        Categoria::create([
            'nombre' => 'Suspensión',
            'descripcion' => 'Presentación en suspensión',
        ]);
        
        Categoria::create([
            'nombre' => 'Crema Vaginal',
            'descripcion' => 'Presentación en crema vaginal',
        ]);
        
        Categoria::create([
            'nombre' => 'Óvulos',
            'descripcion' => 'Presentación en óvulos',
        ]);
        
        Categoria::create([
            'nombre' => 'Crema tópica',
            'descripcion' => 'Presentación en crema tópica',
        ]);
        
        Categoria::create([
            'nombre' => 'Gotas',
            'descripcion' => 'Presentación en gotas',
        ]);
        
        Categoria::create([
            'nombre' => 'Loción',
            'descripcion' => 'Presentación en loción',
        ]);
        
    }
}
