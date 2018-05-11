<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJornadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jornadas', function (Blueprint $table) {
            $table->increments('id');
            $table->float('cantHorasLunes')->default(0);
            $table->float('cantHorasMartes')->default(0);
            $table->float('cantHorasMiercoles')->default(0);
            $table->float('cantHorasJueves')->default(0);
            $table->float('cantHorasViernes')->default(0);
            $table->float('cantHorasSabado')->default(0);
            $table->float('cantHorasDomingo')->default(0);
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
        Schema::dropIfExists('jornadas');
    }
}
