<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Productos;
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
        $categorias = [
            ['nombre' => 'Tableta', 'descripcion' => 'Presentación en tableta'],
            ['nombre' => 'Tabletas', 'descripcion' => 'Presentación en tabletas'],
            ['nombre' => 'Sobre', 'descripcion' => 'Presentación en sobre'],
            ['nombre' => 'Frasco', 'descripcion' => 'Presentación en frasco'],
            ['nombre' => 'Tableta masticable', 'descripcion' => 'Presentación en tableta masticable'],
            ['nombre' => 'Vial', 'descripcion' => 'Presentación en vial'],
            ['nombre' => 'Jarabe', 'descripcion' => 'Presentación en jarabe'],
            ['nombre' => 'Ungüento', 'descripcion' => 'Presentación en ungüento'],
            ['nombre' => 'Inhalador', 'descripcion' => 'Presentación en inhalador'],
            ['nombre' => 'Inyectable', 'descripcion' => 'Presentación inyectable'],
            ['nombre' => 'Suspensión', 'descripcion' => 'Presentación en suspensión'],
            ['nombre' => 'Crema Vaginal', 'descripcion' => 'Presentación en crema vaginal'],
            ['nombre' => 'Óvulos', 'descripcion' => 'Presentación en óvulo'],
            ['nombre' => 'Crema tópica', 'descripcion' => 'Presentación en crema tópica'],
            ['nombre' => 'Gotas', 'descripcion' => 'Presentación en gotas'],
            ['nombre' => 'Loción', 'descripcion' => 'Presentación en loción'],
            ['nombre' => 'Crema', 'descripcion' => 'Presentación en crema'],
            ['nombre' => 'Gel', 'descripcion' => 'Presentación en gel'],
            ['nombre' => 'Lata', 'descripcion' => 'Presentación en lata'],
            ['nombre' => 'Masticable', 'descripcion' => 'Presentación masticable'],
            ['nombre' => 'Efervescente', 'descripcion' => 'Presentación efervescente'],
            ['nombre' => 'Tableta 600mg', 'descripcion' => 'Presentación tableta de 600mg'],
            ['nombre' => 'Tableta 800mg', 'descripcion' => 'Presentación tableta de 800mg'],
            ['nombre' => 'Cápsula', 'descripcion' => 'Presentación en cápsula'],
            ['nombre' => 'Pomada', 'descripcion' => 'Presentación en pomada'],
            
        ];
    
        // Primero crear las categorías
        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    
    }}