<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudContactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_contacto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_usuario'); // id del usuario que solicita el contacto
            $table->string('mensaje'); // mensaje que envia el usuario
            $table->integer('tipo_solicitud'); // tipo de solicitud
            $table->integer('estado'); // estado de la solicitud
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
        Schema::dropIfExists('solicitud_contacto');
    }
}
