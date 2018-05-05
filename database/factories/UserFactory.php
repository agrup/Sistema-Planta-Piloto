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
        
        'tipoUnidad'=> str_random(2)


    ];
});

$factory->define(App\Lote::class, function (Faker $faker) {
    return [

        'id_producto'=>mt_rand(1,50),
        'fechaInicio'=>dateTimeThisYear(),
        'fechaInicioMaduracion'=>dateTimeThisYear(),
        'fechaFinalizacion'=>dateTimeThisYear(),
        'fechaVencimiento'=>dateTimeThisYear(),
        'cantidadElavorada'=>mt_rand(100,500),
        'cantidadFinal'=>mt_rand(10,100),
        'tipoTP'=> $faker->boolean,
        'asignatura'=>str_random(5),
        'costounitario'=>mt_rand(100,120)

    ];
});

$factory->define(App\Formulacion::class, function (Faker $faker) {
    return [

    ];
});



