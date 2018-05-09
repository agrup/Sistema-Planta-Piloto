<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $guarded=[];

#prueba de concatenar query	
       public function scopeincomplete($query)
    {
    	return $query->where('id','>=',2);
    }


#addformulacion agrega las ttablas pivot al producto que le paso
    public function formulacion ()
    {
    	 # return $this->belongsToMany('Producto', 'producto_productoi', 'producto_id', 'ingrediente_id');
    	 return $this->belongsToMany('App\Producto','producto_productoi')
    	 	->withPivot('producto_id','ingrediente_id','cantidad','cantidadProducto')
    	 	#->withTimestamps()
    	 ;

    }

#getIngredientesById devuelce una lista de los id de ingredientes para un prosucto
 
    	

    	public function getIngredientes(){
           $ingredientes = $this->formulacion()->get();
           $arrayResult = [];
           foreach ($ingredientes as $ing){
               array_push($arrayResult,['id'=>$ing->pivot->ingrediente_id,'cantidad'=>$ing->pivot->cantidad]);
           }
           return $arrayResult;
        }   
}
# consulta en tinker

#>>> App\Producto::find(6)->formulacion()->attach(4,['cantidad'=>'4','cantidadProducto'=>'12','ingrediente_id'=>'2'])

