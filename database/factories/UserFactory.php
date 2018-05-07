<?php

use Faker\Generator as Faker;


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Producto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'descripcion' => $faker->sentence,
        'codigo' => str_random(5),
        'alarmaActiva' => $faker->boolean,
        'alarmaAmarilla'=>21,
        'estado'=>$faker->boolean,
        'tipoUnidad'=> str_random(2)


    ];
});

$factory->define(App\Lote::class, function (Faker $faker) {
    return [

        'producto_id'=>mt_rand(1,50),
        'fechaInicio'=>$faker->dateTimeBetween('this week', '+6 days'),
        'fechaInicioMaduracion'=>$faker->dateTimeBetween('this week', '+6 days'),
        'fechaFinalizacion'=>$faker->dateTimeBetween('this week', '+6 days'),
        'fechaVencimiento'=>$faker->dateTimeBetween('this week', '+6 days'),
        'cantidadElavorada'=>mt_rand(100,500),
        'cantidadFinal'=>mt_rand(10,100),
        'tipoTP'=> $faker->boolean,
        'asignatura'=>str_random(5),
        'costounitario'=>mt_rand(100,120)

    ];
});



$factory->define(App\Movimiento::class, function (Faker $faker) {
    return [
        'idLoteConsumidor'=>mt_rand(1,50),
        'idLoteIngrediente'=>mt_rand(1,50),
        'fecha'=>$faker->dateTimeBetween('this week', '+6 days'),
        'codigo'=> mt_rand(1,50),
        'debe'=>mt_rand(1,50),
        'haber'=>mt_rand(1,50),
        'saldoglobal'=>mt_rand(1,50),
        'saldoLote'=>mt_rand(1,50),
        'tipo'=>1
        
    ];
});

  

$factory->define(App\Planificacion::class, function (Faker $faker) {
    return [
        'fecha'=>$faker->dateTimeBetween('this week', '+6 days'),
        'diaSemana'=>'Lunes',
        'descripcion'=>$faker->sentence
    ];
});
