<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_solicitud');
            $table->integer('id_user_solicitud')->unsigned();
            $table->char('leido_solicitud',1)->default(0);
            $table->integer('id_user_abogado')->nullable();
            $table->char('estado_solicitud',1)->default(1);
            $table->date('fecha_solicitud');
            $table->time('hora_solicitud');
            $table->foreign('id_user_solicitud')->references('id')->on('users')
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
        Schema::dropIfExists('solicitud');
    }
}
