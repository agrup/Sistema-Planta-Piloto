<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});
//un Ejemplo

//
//Route::get('/hola', function () {
  //  return 'HOLA';
//});
//Route::get('/planta',function(){
//	return view('pages.Produccion');
//});

//devolver el id del 
//Route::get('/users/{id}',function($id){
//	return 'este es el user '.$id;
//});

//Route::get('/','PagesController@index');
Route::get('/calendario','PagesController@calendario');


Route::get('/stock', 'StockController@show');
Route::post('/stock', 'StockController@show');
Route::get('/verLotes/{lote}', 'LotesController@show');
Route::get('/detalleLote', 'PagesController@detalleLote');

//Planificacion
Route::get('/planificacion', 'PlanificacionController@index');
Route::post('/planificacion','PlanificacionController@show');
Route::get('/planificacionDia','PagesController@calendarioDia');
Route::get('/calendarioSig','PlanificacionController@calendarioSig'); //flechita << >>
Route::get('/calendarioAnt','PlanificacionController@calendarioAnt');
Route::get('/sumarizacion','PlanificacionController@verNecesidadInsumos');



Route::get('/','PagesController@index');
Route::get('/produccion','PagesController@produccion');



Route::get('/lotes', 'LotesController@index') ;
Route::get('/lotes/{id}', 'LotesController@show') ;

Route::get('/trabajador', 'TrabajadorController@index');
Route::get('/trabajador/create', 'TrabajadorController@create');
Route::post('/trabajador', 'TrabajadorController@store');

Route::get('/test', function() {
  	$producto = Producto::find(1)->formulacion;
  	echo ("$producto");
	
});


