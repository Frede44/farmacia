<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table='categoria';
    protected $fillable = [
        'nombre',
        'descripcion',
    ];
    public function producto()
    {
        return $this->hasMany(Productos::class, 'categoria_id');
    }
    public function scopeActivos($query)
    {
       return $query->whereNotIn('estado', [1,0]);
    }
}
    