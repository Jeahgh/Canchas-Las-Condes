<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cancha extends Model
{
    protected $table = 'canchas';

    protected $fillable = [
        'nombre',
        'estado',
        'descripcion'
    ];

    protected $casts = [
        'estado' => 'integer'
    ];
}