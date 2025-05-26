<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Productos;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Agrega esta línea

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicamentos = [
            ['Alka-D', 'Tabletas'],
            ['Alka-Seltzer', 'Tabletas'],
            ['Sal. Andrews', 'Sobre'],
            ['Pepto Bismol', 'Frasco'],
            ['Pepto Bismol', 'Tabletas masticables'],
            ['Enterogermina', 'Vial'],
            ['Pediaflora', 'Sobre'],
            ['Ruigel Plus', 'Frasco'],
            ['Neutrox', 'Frasco'],
            ['Sucracyl', 'Sobre'],
            ['Suero oral', 'Sobre'],
            ['Electroral', 'Frasco'],
            ['Hidravida', 'Frasco'],
            ['Dearexin', 'Tabletas'],
            ['Esomeprazol', 'Tabletas'],
            ['Lansoprazol adulto (30mg)', 'Sobre'],
            ['Lansoprazol niño (15mg)', 'Sobre'],
            ['Virogrip Dia', 'Tableta'],
            ['Virogrip Noche', 'Tableta'],
            ['Virogrip Dia', 'Sobre'],
            ['Virogrip Noche', 'Sobre'],
            ['Ambroxol', 'Jarabe'],
            ['Menaxol', 'Vial'],
            ['Menaxol', 'Sobre'],
            ['Ambiare', 'Jarabe'],
            ['Hedera Helix, Abrilar 100ml', 'Jarabe'],
            ['Vaporub', 'Ungüento'],
            ['Vaporub', 'Inhalador'],
            ['Virogrip', 'Inyectable'],
            ['Emagrip', 'Inyectable'],
            ['Neumonil', 'Inyectable'],
            ['Aspirina', 'Tableta'],
            ['Aspirina Forte', 'Tableta'],
            ['Acetaminofén MK', 'Tableta'],
            ['Acetaminofén', 'Jarabe'],
            ['Acetaminofén Selectpharma', 'Jarabe'],
            ['Metamizol', 'Tableta'],
            ['Metamizol', 'Suspensión'],
            ['Diclofenaco', 'Tableta'],
            ['Diclofenaco', 'Suspensión'],
            ['Ibuprofeno 600mg', 'Tableta'],
            ['Ibuprofeno 800mg', 'Tableta'],
            ['Ibuprofeno Selectpharma', 'Suspensión'],
            ['Dexketoprofeno', 'Tableta'],
            ['Dolo-Neurobion', 'Tableta'],
            ['Dolo-Neurobion', 'Inyectable'],
            ['Vitaflenaco', 'Tableta'],
            ['Metronidazol Flagelos', 'Tableta'],
            ['Metronidazol Metriquin', 'Tableta'],
            ['Metronidazol Flagelos', 'Suspensión'],
            ['Metronidazol', 'Inyectable'],
            ['Albendazol MK', 'Tableta'],
            ['Albendazol MK', 'Suspensión'],
            ['Albendazol Selectpharma', 'Suspensión'],
            ['Fluconazol Selectpharma', 'Tableta'],
            ['Fluconazol Farmandina', 'Tableta'],
            ['Tinidazol Selectpharma', 'Tableta'],
            ['Clotrimazol Selectpharma', 'Crema Vaginal'],
            ['Clotrimazol Pharmadel', 'Óvulos'],
            ['Nitazoxanida Nitaxin', 'Tableta'],
            ['Clotrimazol Selectpharma', 'Crema tópica'],
            ['Nitazoxanida Nitaxin', 'Suspensión'],
            ['Sertal Compuesto', 'Tabletas'],
            ['Sertal Compuesto', 'Gotas'],
            ['Loratadina Farmandina', 'Suspensión'],
            ['Loratadina Selectpharma', 'Suspensión'],
            ['Loratadina Selectpharma', 'Tableta'],
            ['Maleato de Clorfeniramina', 'Tableta'],
            ['Maleato de Clorfeniramina', 'Suspensión'],
            ['Calamina Lancasco', 'Loción'],
            ['Amoxicilina caplin', 'Tabletas'],
            ['Amoxicilina Lancasco', 'Suspensión'],
            ['Amoxicilina más acido clavulánico Claxil', 'Suspensión'],
            ['Amoxicilina más acido clavulánico Claxil', 'Tabletas'],
            ['Amoxicilina más acido clavulánico Koact', 'Tabletas'],
            ['Ciprofloxacina Soriflox', 'Tabletas'],
            ['Ciprofloxacina Brociflox', 'Tabletas'],
            ['Ciprofloxacina', 'Inyectable'],
            ['Ceftriaxona', 'Vial'],
            ['Cefixima Katius', 'Suspensión'],
            ['Cefixima Katius', 'Tabletas'],
            ['Trimetroprim', 'Suspensión'],
            ['Trimetroprim Bonatril forte', 'Tabletas'],
            ['Dicloxacilina', 'Tabletas'],
        ];

        foreach ($medicamentos as $index => [$nombre, $presentacion]) {
            Productos::create([
                'id' => $index + 1,
                'codigo' => 'MED' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'nombre' => $nombre,
                'descripcion' => $presentacion,
                'imagen' => 'default.png', // puedes cambiarlo luego
                'categoria_id' => 1, // cambia esto si tienes diferentes categorías
            ]);
        }
    }
}