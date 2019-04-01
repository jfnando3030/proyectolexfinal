<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbEmailtemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_emailtemplates', function (Blueprint $table) {
            $table->string('codigo', 3);
            $table->text('cuerpo');
            $table->string('emaildesde');
            $table->string('observacion');
            $table->char('estado',1)->default('A');

            $table->primary('codigo');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_emailtemplates');
    }
}
