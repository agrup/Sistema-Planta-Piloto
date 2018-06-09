<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombres')->nullable($value = true);
            $table->string('apellido')->nullable($value = true);
            $table->string('telefono')->nullable($value = true);
            $table->string('documento');
            $table->string('tipo_documento')->nullable($value = true);
            $table->date('fecha_nac')->nullable($value = true);
            $table->text('domicilio')->nullable($value = true);
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
        Schema::dropIfExists('personas');
    }
}
