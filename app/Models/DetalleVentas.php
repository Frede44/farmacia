<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
     use HasFactory;

    protected $table = 'ventas_detalles';

    protected $fillable = [
        'venta_id',
        'producto_id',
        'tipo_venta',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    // Relaciones
    public function venta()
    {
        return $this->belongsTo(Ventas::class, 'venta_id');
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }
}
