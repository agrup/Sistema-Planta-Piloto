<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planificacions', function (Blueprint $table) {
            $table->increments('id');

            $table->date('fecha')->nullable($value = true);
            $table->text('diaSemana')->nullable($value = true);
            $table->text('descripcion')->nullable($value = true);
            $table->timestamps();
        });

        Schema::create('planificacion_trabajador', function (Blueprint $table) {
            $table->integer('planificacion_id');
            $table->integer('trabajador_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planificacions');
    }
}
