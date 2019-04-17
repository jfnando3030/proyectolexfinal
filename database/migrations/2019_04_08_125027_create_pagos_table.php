<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_tarifa');
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion');
            $table->char('cantidad_consultorias',1)->default(0);
            $table->string('modo_pago');
            $table->decimal('monto_pago', 8, 2);    
            $table->char('activo',1)->default(0);
            $table->char('estado',1);
            $table->string('comprobante_pago');
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
        Schema::dropIfExists('pagos');
    }
}
