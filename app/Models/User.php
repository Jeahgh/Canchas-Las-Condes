<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{

    // Constantes para roles
    // const ROL_ADMINISTRADOR = 1;
    // const ROL_VECINO = 2;

    // // Constantes para estado
    // const ESTADO_ACTIVO = 1;
    // const ESTADO_INACTIVO = 0;

    // // Accessor para rol
    // public function getRolNombreAttribute()
    // {
    //     return match($this->rol) {
    //         self::ROL_ADMINISTRADOR => 'Administrador',
    //         self::ROL_VECINO => 'Vecino',
    //         default => 'No definido'
    //     };
    // }

    // // Accessor para estado
    // public function getEstadoNombreAttribute()
    // {
    //     return match($this->estado) {
    //         true => 'Habilitado',
    //         false => 'Inhabilitado',
    //         default => 'No definido'
    //     };
    // }


    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    // User::factory()->count(50)->create();

    protected $fillable = [
        'nombre',
        'rut',
        'email',
        'telefono',
        'fecha_nacimiento',
        'genero',
        'rol',
        'password',
        'estado',
        'eliminado'
    ];

    /**
     * Los atributos que deben ocultarse en la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser casteados a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_nacimiento' => 'date',
        'fecha_registro' => 'datetime',
        'ultima_conexion' => 'datetime',
        'estado' => 'boolean',
        'intentos_fallidos' => 'integer',
    ];
}
