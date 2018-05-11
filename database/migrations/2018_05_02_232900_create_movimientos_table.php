t<?php

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

            $table->integer('idLoteConsumidor')->nullable($value = true);
            $table->integer('idLoteIngrediente')->nullable($value = true);
            $table->timestamp('fecha');
            $table->integer('producto_id')->nullable($value = true);
            $table->double('debe')->default(0);
            $table->double('haber')->default(0);
            $table->double('saldoGlobal')->nullable($value = true);
            $table->double('saldoLote')->nullable($value = true);
            $table->integer('tipo');
            $table->integer('planificacion_id')->nullable($value = true);
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
