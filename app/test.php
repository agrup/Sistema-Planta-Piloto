<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
/*
require 'Planificacion.php';
var_dump(Planificacion::getSemana('2018-05-14'));*/
echo (Carbon::createFromFormat('Y-m-d','2018-06-06')->format('Y-m-d H:i:s'));


