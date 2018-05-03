<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idFormulacion');
            $table->integer('id_producto')->unsigned();
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->integer('idIngrediente')->unsigned();
            $table->foreign('idIngrediente')->references('id')->on('productos');
            $table->integer('cantidadIngrediete');
            $table->boolean('estado');
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
        Schema::dropIfExists('formulaciones');
    }
}
