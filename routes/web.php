
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
Route::post('/produccion/iniciarPlanificado/','ProduccionController@postIniciarPlanificado');
Route::get('/produccion/loteNoPlanificado', 'ProduccionController@indexLoteNoPlanificado');
Route::post('/produccion/loteNoPlanificado', 'ProduccionController@newLoteNoPlanificado');
Route::get('/produccion/formulacion','ProduccionController@getFormulacion');
Route::get('/produccion/loteEnProduccion/{id}' ,'ProduccionController@showLoteInProd');
Route::get('/produccion/modificarIniciado/{id}','ProduccionController@showModificarIniciado');
Route::post('/produccion/modificarIniciado/{id}', 'ProduccionController@postModificarIniciado');
Route::post('/produccion/postMaduracion/{id}','ProduccionController@postMaduracion');
Route::post('/produccion/postFinalizarLote/{id}','ProduccionController@postFinalizarLote');

//Producto
Route::get('/Administracion/BuscarProducto','ProductoController@search');//busca insumos y productos a partir de un array de caracteristicas



Route::get('/productos/administracionProductos', 'ProductoController@administracionProducto');
Route::get('/productos/administracionInsumos', 'ProductoController@administracionInsumo');
Route::get('/productos/administracionInsumo', 'ProductoController@administracionInsumo');

//Alta Producto
Route::get('/productos/altaProducto', 'ProductoController@showAltaProducto');
Route::post('/productos/altaProducto', 'ProductoController@altaProducto');
//Alta Insumo
Route::get('/productos/altaInsumo', 'ProductoController@showaltaInsumo');
Route::post('/productos/altaInsumo', 'ProductoController@altaInsumo');

//Route fictisio
Route::get('/produccion/detalleLoteEnProduccion/{id}','PruebaController@detalleLoteEnProduccion');

	
Route::get('/lotes', 'LotesController@index') ;
Route::get('/lotes/{id}', 'LotesController@show') ;

Route::get('/trabajador', 'TrabajadorController@index');
Route::get('/trabajador/create', 'TrabajadorController@create');
Route::post('/trabajador', 'TrabajadorController@store');



//Administracion de productoInsumos
//Route::get('/productos/altaProducto', 'ProductoController@altaProducto');
//Route::get('/productos/altaInsumo', 'ProductoController@altaInsumo');

