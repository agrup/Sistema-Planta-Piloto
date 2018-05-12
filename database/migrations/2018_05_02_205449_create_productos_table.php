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
            $table->text('nombre');
            $table->text('descripcion')->nullable($value = true);
            $table->text('tipoUnidad');
            $table->string('codigo');
            $table->boolean('alarmaActiva')->default(false);
            $table->double('alarmaAmarilla')->nullable($value = true);
            $table->double('alarmaRoja')->nullable($value = true);
            $table->text('categoria')->default('sin categoria');
            $table->boolean('estado')->default(true);
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
