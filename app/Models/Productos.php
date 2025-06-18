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
        'imagen',
        'categoria_id',
        'estado', // Agregado para manejar el estado del producto

    ];

    public function categoria()
{
    return $this->belongsTo(Categoria::class, 'categoria_id');
}
}
