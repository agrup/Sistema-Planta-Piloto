<?php

use Illuminate\Support\Facades\Schema;Laravel Helper Completions

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_salidas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('tipo');
            $table->integer('id_movimiento')->unsigned();
            $table->foreign('id_movimiento')->references('id')->on('movimientos');
            $table->text('detalle');
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
        Schema::dropIfExists('detalle_salidas');
    }
}
