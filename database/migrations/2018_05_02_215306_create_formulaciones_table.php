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
            $table->integer('idProducto');
            $table->integer('idIngrediente');
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
