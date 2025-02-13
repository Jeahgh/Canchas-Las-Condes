<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisponibilidadCanchas extends Model
{
    protected $table = 'disponibilidad_canchas';

    protected $fillable = [
        'fecha',
        'id_hora',
        'hora',
        'cancha_1',
        'cancha_2',
        'cancha_3'
    ];
    
    protected $casts = [
        'cancha_1' => 'boolean',
        'cancha_2' => 'boolean',
        'cancha_3' => 'boolean'
    ];

}