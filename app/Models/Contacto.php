<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'solicitud_contacto';

    protected $fillable = [
        'id_usuario',
        'mensaje',
        'tipo_solicitud',
        'estado'
    ];

    protected $casts = [
        'estado' => 'integer'
    ];
}