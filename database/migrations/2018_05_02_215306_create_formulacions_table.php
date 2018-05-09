<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idFormulacion');
            $table->integer('id_producto')->nullable($value = true);
            $table->integer('idIngrediente')->nullable($value = true);
            $table->integer('cantidadIngrediete')->nullable($value = true);
            $table->boolean('estado')->nullable($value = true);
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
        Schema::dropIfExists('formulacions');
    }
}
