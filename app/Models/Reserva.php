<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = [
        'id_usuario',
        'id_cancha',
        'fecha_reserva',
        'hora',
        'estado'
    ];

    protected $casts = [
        'id_usuario' => 'integer',
        'id_cancha' => 'integer',
        'fecha_reserva' => 'date',
        'hora' => 'string',
        'estado' => 'integer'
    ];
}