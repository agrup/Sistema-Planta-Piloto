<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    public function planificacions()
    {
    	$this->belongsToMany('App\Planificacion');

    }


}
