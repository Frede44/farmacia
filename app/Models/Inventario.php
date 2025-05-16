<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $table = 'inventario'; // Nombre de la tabla en la base de datos
    protected $fillable=[
        'id',
        'id_producto', // Relación con la tabla productos
       // 'compra',
        'xunidad',
        'xcaja',
        'caducidad',
        'cantidad_caja',
        'unidad_caja'

    ];
    public function producto()
    {
        return $this->belongsTo(Productos::class,'id_producto');
    }

}
