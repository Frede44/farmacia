<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
     protected $table='ventas';
    protected $fillable = [
        'cliente_id',
        'usuario_id',
        'fecha',
        'total',
        'estado',
    ];

    // Relación con detalles de venta
    public function detalles()
    {
        return $this->hasMany(DetalleVentas::class, 'venta_id');
    }

    // Relación con cliente
    public function cliente()
    {
        return $this->belongsTo(Personas::class, 'cliente_id');
    }

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

}
