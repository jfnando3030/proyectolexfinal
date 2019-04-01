<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbParametroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_parametro', function (Blueprint $table) {
            $table->string('codpar', 5);
            $table->integer('secuencia');
            $table->string('descripcion');
            $table->integer('valor');
            $table->primary('codpar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_parametro');
    }
}
