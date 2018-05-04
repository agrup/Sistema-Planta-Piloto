<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Planificacion extends Model
{
	public function trabajadors(){
		$this->belongsToMany(Trabajador::class);
	} 
}
