<?php

namespace App\Http\Controllers;

use App\Lote;

class LotesController extends Controller
{
    public function index()
    {
    	$lotes= Lote::ALL();
    	 return view('lotes.index',compact('lotes'));
    }

    public function show($id)
    {

		$lotes= Lote::find($id);
	
		return view('lotes.show',compact('lotes'));
    }


}
