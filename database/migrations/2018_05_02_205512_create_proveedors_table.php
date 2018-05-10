<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombre');
            $table->text('telefono')->nullable($value = true);
            $table->text('rubro')->nullable($value = true);;
            $table->text('localidad')->nullable($value = true);
            $table->text('provincia')->nullable($value = true);
            $table->text('pais')->nullable($value = true);
            $table->text('email')->nullable($value = true);
            $table->integer('cp')->nullable($value = true);
            $table->text('direccion')->nullable($value = true);
            $table->text('nombreContacto')->nullable($value = true);
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
        Schema::dropIfExists('proveedors');
    }
}
