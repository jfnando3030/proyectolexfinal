<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cuenta', function (Blueprint $table) {
            $table->increments('secuencia');
            $table->integer('idreg');
            $table->string('coddistribuidor', 20);
            $table->date('fechaperdesde');
            $table->date('fechaperhasta');
            $table->decimal('valoracum', 10, 4);
            $table->char('estadoreg',1);
            $table->char('estadopago',1);
            $table->date('fechacobro');
            $table->integer('ordenpagono');
            $table->integer('puntosacum');
            $table->char('estadopuntos',1);
            $table->char('tipopago',2);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_cuenta');
    }
}
