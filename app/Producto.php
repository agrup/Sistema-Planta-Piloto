<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
       public function scopeincomplete($query)
    {
    	return $query->where('id','>=',2);
    }



    public function formulacion (){
    	  return $this->belongsToMany('Producto', 'producto_productoi', 'producto_id', 'ingrediente_id');

    }


}
