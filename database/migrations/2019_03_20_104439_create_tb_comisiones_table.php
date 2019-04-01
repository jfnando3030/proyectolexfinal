<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbComisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_comisiones', function (Blueprint $table) {
            $table->integer('num_transaccion');
            $table->string('cedula', 11);
            $table->decimal('monto', 10, 4);
            $table->date('fecha');
            $table->string('descripcion');
            $table->char('tipocompra',1);
            $table->string('numcomprobante', 20);
            $table->char('estadopago',1);
            $table->primary('num_transaccion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_comisiones');
    }
}
