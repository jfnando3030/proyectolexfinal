<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPeriodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_periodo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anio');
            $table->string('descripcion');
            $table->date('fechadesde');
            $table->date('fechahasta');
            $table->integer('duraciondias');
            $table->time('horadesde');
            $table->time('horahasta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_periodo');
    }
}
