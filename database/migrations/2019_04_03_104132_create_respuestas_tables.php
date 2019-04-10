<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->text('respuesta');
            $table->integer('solicitud_id')->unsigned();
            $table->date('fecha');
            $table->time('hora');
            $table->char('leido',1)->default(0);
            $table->char('estado',1)->default(1);
            $table->integer('id_autorespuesta')->nullable();
            $table->integer('id_user_receptor');
           



           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
}
