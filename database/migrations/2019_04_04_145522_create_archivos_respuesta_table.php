<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivosRespuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos_respuestas', function (Blueprint $table) {
            $table->increments('id');   
            $table->string('path')->nullable(); //nullable significa que permite valores nulos
            $table->char('estado',1)->default(1);
            $table->integer('id_respuesta')->unsigned();
            $table->foreign('id_respuesta')->references('id')->on('respuestas')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivos_respuestas');
    }
}
