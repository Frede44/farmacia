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
    
        'xunidad',
        'xcaja',
        'caducidad',
        'cantidad_caja',
        'unidad_caja',
        'total_unidad' // Total de unidades calculado como cantidad_caja * unidad_caja
        ,'id_categoria' // Relación con la tabla categorias
        ,'estado' // Agregado para manejar el estado del inventario

    ];
    public function producto()
    {
        return $this->belongsTo(Productos::class,'id_producto');
    }

    public function categoria()
    {
    return $this->belongsTo(Categoria::class, 'id_categoria');
    }

}
