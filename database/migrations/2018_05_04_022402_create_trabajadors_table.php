<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('legajo');
            $table->integer('idPersona')->nullable($value = true);
            $table->text('sector')->nullable($value = true);
            $table->text('puesto')->nullable($value = true);
            $table->text('seudonimo')->nullable($value = true);
            $table->boolean('estado')->nullable($value = true);
            $table->timestamps();
        });

        Schema::create('planificacion_trabajador', function (Blueprint $table){

                $table->integer('planificacion_id');
                
                $table->integer('trabajador_id');

                $table->primary(['planificacion_id', 'trabajador_id']);

            });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trabajadors');
    }
}
