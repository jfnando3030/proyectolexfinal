<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codpatrocinador');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('cedula')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('direccion')->nullable();
            $table->integer('idciudad')->nullable();
            $table->integer('idprovincia')->nullable();
            $table->string('telefono')->nullable();
            $table->date('fechanacim')->nullable();
            $table->string('sexo')->nullable();
            $table->char('estado',1)->default(1);
            $table->string('activado')->nullable();
            $table->string('celular')->nullable();
            $table->string('emailrecupera')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->date('fechaactivacion')->nullable();
            $table->time('horaactivacion')->nullable();
            $table->string('tipopagos')->nullable();
            $table->string('titular')->nullable();
            $table->integer('codigobco')->nullable();
            $table->string('numctatarjeta')->nullable();
            $table->string('codigoseguridad')->nullable();
            $table->string('fechavencimiento')->nullable();
            $table->string('rol');
            $table->string('path')->nullable(); //nullable significa que permite valores nulos
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
