<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisponibilidadCanchasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilidad_canchas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('id_hora'); // referencia a la hora inicial de la reserva
            $table->string('hora'); // hora que se muestra en la vista
            $table->boolean('cancha_1')->default(true);
            $table->boolean('cancha_2')->default(true);
            $table->boolean('cancha_3')->default(true);
            $table->timestamps();
            
            // Índice compuesto para búsquedas más rápidas
            $table->unique(['fecha', 'hora']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disponibilidad_canchas');
    }
}
