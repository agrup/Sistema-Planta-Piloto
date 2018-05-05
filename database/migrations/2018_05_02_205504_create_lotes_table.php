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
            $table->integer('producto_id');
            $table->date('fechaInicio')->nullable($value = true);
            $table->date('fechaInicioMaduracion')->nullable($value = true);
            $table->date('fechaFinalizacion')->nullable($value = true);
            $table->date('fechaVencimiento')->nullable($value = true);
            $table->double('cantidadElavorada')->nullable($value = true);
            $table->double('cantidadFinal')->nullable($value = true);
            $table->boolean('tipoTP')->nullable($value = true);
            $table->text('asignatura')->nullable($value = true);
            $table->double('costounitario')->nullable($value = true);

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
