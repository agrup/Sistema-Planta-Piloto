<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    public function planificacions()
    {
    	$this->belongsToMany(Planificacion::class);

    }


}
