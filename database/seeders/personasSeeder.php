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
        'nombre' => 'Juan Perez',
        'dpi' => '1234567890101',
        'telefono' => '12345678',
        'direccion' => 'Calle 1, Ciudad',
        'correo' => 'los@gmail.com'
    ],
    [
        'nombre' => 'Maria Lopez',
        'dpi' => '2234567890102',
        'telefono' => '23456789',
        'direccion' => 'Avenida 2, Ciudad',
        'correo' => 'maria@gmail.com'
    ],
    [
        'nombre' => 'Carlos Gómez',
        'dpi' => '3234567890103',
        'telefono' => '34567890',
        'direccion' => 'Calle 3, Ciudad',
        'correo' => 'carlos@gmail.com'
    ],
    [
        'nombre' => 'Ana Martínez',
        'dpi' => '4234567890104',
        'telefono' => '45678901',
        'direccion' => 'Avenida 4, Ciudad',
        'correo' => 'ana@gmail.com'
    ],
    [
        'nombre' => 'Luis Ramírez',
        'dpi' => '5234567890105',
        'telefono' => '56789012',
        'direccion' => 'Calle 5, Ciudad',
        'correo' => 'luis@gmail.com'
    ],
    [
        'nombre' => 'Sofía Torres',
        'dpi' => '6234567890106',
        'telefono' => '67890123',
        'direccion' => 'Avenida 6, Ciudad',
        'correo' => 'sofia@gmail.com'
    ],
    [
        'nombre' => 'Miguel Castillo',
        'dpi' => '7234567890107',
        'telefono' => '78901234',
        'direccion' => 'Calle 7, Ciudad',
        'correo' => 'miguel@gmail.com'
    ],
    [
        'nombre' => 'Laura Mendoza',
        'dpi' => '8234567890108',
        'telefono' => '89012345',
        'direccion' => 'Avenida 8, Ciudad',
        'correo' => 'laura@gmail.com'
    ],
    [
        'nombre' => 'Diego Ruiz',
        'dpi' => '9234567890109',
        'telefono' => '90123456',
        'direccion' => 'Calle 9, Ciudad',
        'correo' => 'diego@gmail.com'
    ],
    [
        'nombre' => 'Elena Morales',
        'dpi' => '1034567890110',
        'telefono' => '01234567',
        'direccion' => 'Avenida 10, Ciudad',
        'correo' => 'elena@gmail.com'
    ],
    [
        'nombre' => 'Jorge Vásquez',
        'dpi' => '1134567890111',
        'telefono' => '11234567',
        'direccion' => 'Calle 11, Ciudad',
        'correo' => 'jorge@gmail.com'
    ],
    [
        'nombre' => 'Patricia Herrera',
        'dpi' => '1234567890112',
        'telefono' => '12234567',
        'direccion' => 'Avenida 12, Ciudad',
        'correo' => 'patricia@gmail.com'
    ],
    [
        'nombre' => 'Ricardo Ortiz',
        'dpi' => '1334567890113',
        'telefono' => '13234567',
        'direccion' => 'Calle 13, Ciudad',
        'correo' => 'ricardo@gmail.com'
    ],
    [
        'nombre' => 'Gabriela Flores',
        'dpi' => '1434567890114',
        'telefono' => '14234567',
        'direccion' => 'Avenida 14, Ciudad',
        'correo' => 'gabriela@gmail.com'
    ],
    [
        'nombre' => 'Fernando Cruz',
        'dpi' => '1534567890115',
        'telefono' => '15234567',
        'direccion' => 'Calle 15, Ciudad',
        'correo' => 'fernando@gmail.com'
    ],
    [
        'nombre' => 'Valeria Soto',
        'dpi' => '1634567890116',
        'telefono' => '16234567',
        'direccion' => 'Avenida 16, Ciudad',
        'correo' => 'valeria@gmail.com'
    ],
    [
        'nombre' => 'Andrés Reyes',
        'dpi' => '1734567890117',
        'telefono' => '17234567',
        'direccion' => 'Calle 17, Ciudad',
        'correo' => 'andres@gmail.com'
    ],
    [
        'nombre' => 'Camila Navarro',
        'dpi' => '1834567890118',
        'telefono' => '18234567',
        'direccion' => 'Avenida 18, Ciudad',
        'correo' => 'camila@gmail.com'
    ],
    [
        'nombre' => 'Pablo Peña',
        'dpi' => '1934567890119',
        'telefono' => '19234567',
        'direccion' => 'Calle 19, Ciudad',
        'correo' => 'pablo@gmail.com'
    ],
    [
        'nombre' => 'Monica Salazar',
        'dpi' => '2034567890120',
        'telefono' => '20234567',
        'direccion' => 'Avenida 20, Ciudad',
        'correo' => 'monica@gmail.com'
    ],
    [
        'nombre' => 'Sebastián Rojas',
        'dpi' => '2134567890121',
        'telefono' => '21234567',
        'direccion' => 'Calle 21, Ciudad',
        'correo' => 'sebastian@gmail.com'
    ]
]);

    }
}
