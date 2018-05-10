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
            $table->text('seudonimo');
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
        Schema::dropIfExists('trabajadors');
    }
}
