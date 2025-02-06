<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_usuario'); // id del usuario que solicita la reserva
            $table->integer('id_cancha'); // id de la cancha que se reserva
            $table->date('fecha_reserva'); // fecha de la reserva
            $table->time('hora'); // hora de la reserva
            $table->integer('estado'); // estado de la reserva
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
        Schema::dropIfExists('reservas');
    }
}
