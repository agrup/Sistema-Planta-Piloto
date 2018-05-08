<?php 

use App\Lote;
use App\Producto;


Route::get('/', function () {

	$name = 'Planta Piloto';
	$branch ='branch Agu';

    return view('welcome' ,
    	compact('name','branch')

    	);
});


Route::get('/planificacion', 'Planificacioncontroller@verCalendario($id)' );
Route::get('/lotes', 'LotesController@index') ;
Route::get('/lotes/{id}', 'LotesController@show') ;

Route::get('/trabajador', 'TrabajadorController@index');
Route::get('/trabajador/create', 'TrabajadorController@create');
Route::post('/trabajador', 'TrabajadorController@store');

Route::get('/test', function() {
  	$producto = Producto::find(1)->formulacion;
  	echo ("$producto");
	
});

