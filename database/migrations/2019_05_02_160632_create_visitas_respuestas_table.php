<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitasRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas_respuestas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('asunto');
            $table->string('respuesta',500);
            $table->date('fecha');
            $table->time('hora');
            $table->string('id_visita');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas_respuestas');
    }
}
