<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

      protected $table = 'compras';
    protected $fillable = [
        'usuario_id',
        'total',
        'fecha',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

}
