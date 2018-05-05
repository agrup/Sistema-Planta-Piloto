<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    public function planificacion(){
    	return $this->belongsTo('App\Planificacion');
    }
}
