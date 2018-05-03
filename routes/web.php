<?php 

use App\Lote;

Route::get('/', function () {

	$name = 'Planta Piloto';
	$branch ='branch Agu';

    return view('welcome' ,
    	compact('name','branch')

    	);
});


Route::get('/lotes', function () {

	$lotes = Lote::all();

	#$lotes= DB::table('lotes')->get();
	#$Lotes = Lote::all();

    return view('lotes.index',compact('lotes'));
	
});

Route::get('/lotes/{id}', function ($id) {



	$lotes= Lote::find($id);
	#$Lotes = Lote::all();
	#dd($lotes);
   return view('lotes.show',compact('lotes'));
	
});