<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompras extends Model
{
    use HasFactory;

    protected $table = 'detalle_compras';
    protected $fillable = [
        'compra_id',
        'proveedor_id',
        'producto_id',
        'cantidad',
        'precio',
        'subtotal'
    ];

    public function compra()
    {
        return $this->belongsTo(Compras::class, 'id_compra');
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}
