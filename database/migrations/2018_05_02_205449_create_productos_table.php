<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombre')->nullable($value = true);
            $table->text('descripcion')->nullable($value = true);
            $table->text('tipoUnidad')->nullable($value = true);
            $table->string('codigo')->nullable($value = true);
            $table->boolean('alarmaActiva')->nullable($value = true);
            $table->double('alarmaAmarilla')->nullable($value = true);
            $table->double('alarmaRoja')->nullable($value = true);
            $table->text('categoria')->nullable($value = true);
            $table->boolean('estado')->nullable($value = true);
            $table->timestamps();
        });

        Schema::create('producto_productoi', function (Blueprint $table) {
  
            $table->integer('producto_id');
            $table->integer('ingrediente_id');
            $table->primary(['producto_id','ingrediente_id']);
            $table->double('cantidad');
            $table->double('cantidadProducto');
        });




    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_productoi');
        Schema::dropIfExists('productos');


    }
}
