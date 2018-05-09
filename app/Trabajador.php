<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $guarded=[];
    public function planificacions()
    {
    	$this->belongsToMany('App\Planificacion');

    }


}
