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
            $table->integer('producto_id');
            $table->integer('idIngrediente');
            $table->integer('cantidadIngrediete');
            $table->boolean('estado')->default(true);
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
