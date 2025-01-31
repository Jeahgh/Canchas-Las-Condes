<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre completo
            $table->string('rut')->unique(); // RUT sin puntos y con guion
            $table->string('email')->unique(); // Correo único
            $table->string('telefono')->nullable(); // Teléfono opcional
            $table->date('fecha_nacimiento')->nullable(); // Fecha de nacimiento
            $table->string('direccion')->nullable(); // Dirección del usuario
            $table->string('genero')->nullable(); // Género
            $table->string('foto_perfil')->nullable(); // Imagen de perfil
            $table->boolean('rol')->default(true); // Rol en el sistema
            $table->boolean('estado')->default(true); // Si está habilitado o no
            $table->timestamp('fecha_registro')->useCurrent(); // Fecha en que se registró
            $table->timestamp('ultima_conexion')->nullable(); // Última conexión
            $table->integer('intentos_fallidos')->default(0); // Para bloquear tras varios intentos fallidos
            $table->string('password'); // Contraseña encriptada
            $table->rememberToken(); // Token de sesión
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
