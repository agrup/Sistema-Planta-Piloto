<?php

namespace App\Http\Controllers;

use APP\Lotes;

class LotesController extends Controller
{
    public function index()
    {
    	$lotes= Lotes::ALL();
    }

}
