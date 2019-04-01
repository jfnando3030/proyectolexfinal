<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMisHerramientasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mis_herramientas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo',255);
            $table->string('descripcion');
            $table->string('path')->nullable(); //nullable significa que permite valores nulos
            $table->char('estado',1)->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mis_herramientas');
    }
}
