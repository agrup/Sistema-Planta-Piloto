<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Producto;


class Lote extends Model
{

    protected $guarded=[];

	public function producto(){
		return $this->belongsTo('App\Producto');
	}

	public function toArray()
	{

	}

    public static function getNameProdByIdLote()
    {
        return (Producto::find($this->producto_id))->nombre;
    }


}
