<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table='proveedor';
    protected $fillable = [
        'nombre',
        'numero_telefono',
        'correo',
        'descripcion',

    ];
    public function producto()
    {
        return $this->belongsTo(Productos::class,'id_producto');
    }
}
