<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table='productos';
    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'descripcion',
        'precio_venta',
        'imagen',
        'categoria_id',

    ];

    public function categoria()
{
    return $this->belongsTo(Categoria::class, 'categoria_id');
}
}
