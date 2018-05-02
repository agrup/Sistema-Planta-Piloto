<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idLoteConsumidor')->unsigned();
            $table->integer('idLoteConsumido')->unsigned();
            $table->foreign('idLoteConsumidor')->references('id')->on('lotes');
            $table->foreign('idLoteConsumido')->references('id')->on('lotes');
            $table->date('fecha');
            $table->integer('producto');
            $table->float('debe');
            $table->float('haber');
            $table->float('saldoglobal');
            $table->float('saldoLote');
            $table->integer('tipo');
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
        Schema::dropIfExists('movimientos');
    }
}
