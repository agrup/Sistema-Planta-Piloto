<?php 

namespace App;




use Carbon\Carbon;

$lunes = Carbon::now()->startOfWeek();

echo $lunes;