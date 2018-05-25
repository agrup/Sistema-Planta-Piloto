
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

//informes stock
Route::get('/stock', 'StockController@show');
Route::post('/stock', 'StockController@show');

//lotes 
Route::get('/verLotes', 'LotesController@show');
Route::get('/detalleLote', 'LotesController@showDetalle');

//Planificacion
Route::get('/planificacion', 'PlanificacionController@index');
Route::post('/planificacion','PlanificacionController@show');
Route::get('/planificacionDia','PlanificacionController@PlanificacionDia');
Route::get('/calendarioSig','PlanificacionController@calendarioSig'); //flechita << >>
Route::get('/calendarioAnt','PlanificacionController@calendarioAnt');
Route::get('/sumarizacion','PlanificacionController@verNecesidadInsumos');

//Alta de planificacion
Route::post('/planificacion/agregarProducto','PlanificacionController@agregarProducto');
Route::post('/planificacion/agregarInsumo','PlanificacionController@agregarInsumo');
Route::post('/planificacion/eliminar','PlanificacionController@eliminar');
Route::post('/planificacion/modificar', 'PlanificacionController@modificar');

Route::get('/','MainController@index');

//Produccion
Route::get('/produccion','ProduccionController@index');
Route::post('/produccion','ProduccionController@show');

Route::get('/produccion/loteEnProduccion/{id}','ProduccionController@loteEnProduccion');

Route::get('/produccion/iniciarPlanificado/{id}','ProduccionController@iniciarPlanificado');
Route::get('produccion/loteNoPlanificado', 'ProduccionController@loteNoPlanificado');

Route::get('/produccion/formulacion','ProduccionController@getFormulacion');



Route::get('/produccion/loteEnProduccion/{id}' ,'ProduccionController@showLoteInProd');
//Route fictisio

Route::get('/produccion/detalleLoteEnProduccion/{id}','PruebaController@detalleLoteEnProduccion');

	
Route::get('/lotes', 'LotesController@index') ;
Route::get('/lotes/{id}', 'LotesController@show') ;

Route::get('/trabajador', 'TrabajadorController@index');
Route::get('/trabajador/create', 'TrabajadorController@create');
Route::post('/trabajador', 'TrabajadorController@store');

Route::get('/test', function() {
  	$producto = Producto::find(1)->formulacion;
  	echo ("$producto");
	
});


