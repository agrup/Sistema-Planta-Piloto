
<?php

Route::get('/','MainController@index');



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


//Produccion
Route::get('/produccion','ProduccionController@index');
Route::post('/produccion','ProduccionController@show');
Route::get('/produccion/loteEnProduccion/{id}','ProduccionController@loteEnProduccion');
Route::get('/produccion/iniciarPlanificado/{id}','ProduccionController@iniciarPlanificado');
Route::get('/produccion/loteNoPlanificado', 'ProduccionController@loteNoPlanificado');
Route::post('/produccion/loteNoPlanificado', 'ProduccionController@newLoteNoPlanificado');
Route::get('/produccion/formulacion','ProduccionController@getFormulacion');
Route::get('/produccion/loteEnProduccion/{id}' ,'ProduccionController@showLoteInProd');

//Producto
Route::post('/Administracion/BuscarProducto','ProductoController@search');//busca nsumos y productos a partir de un array de caracteristicas


//Route fictisio
Route::get('/produccion/detalleLoteEnProduccion/{id}','PruebaController@detalleLoteEnProduccion');

	
Route::get('/lotes', 'LotesController@index') ;
Route::get('/lotes/{id}', 'LotesController@show') ;

Route::get('/trabajador', 'TrabajadorController@index');
Route::get('/trabajador/create', 'TrabajadorController@create');
Route::post('/trabajador', 'TrabajadorController@store');




