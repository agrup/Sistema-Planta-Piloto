<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_producto')->unsigned();
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->date('fechaInicio');
            $table->date('fechaInicioMaduracion');
            $table->date('fechaFinalizacion');
            $table->date('fechaVencimiento');
            $table->float('cantidadElavorada');
            $table->float('cantidadFinal');
            $table->boolean('tipoTP');
            $table->text('asignatura');
            $table->double('costounitario');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotes');
    }
}
