<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lote;
class Producto extends Model
{


    protected $guarded=[];




#addformulacion agrega las ttablas pivot al producto que le paso
    public function formulacion ()
    {
    	 # return $this->belongsToMany('Producto', 'producto_productoi', 'producto_id', 'ingrediente_id');
    	 return $this->belongsToMany('App\Producto','producto_productoi')
    	 	->withPivot('producto_id','ingrediente_id','cantidad','cantidadProducto')
    	 ;

    }

#getIngredientesById devuelce una lista de los id de ingredientes para un prosucto

    	public static function showLotesByProd (string $codigo)
      {
        $lotesReturn=[];
        $lotes = GestorLote::getLotesPorProd($codigo);
        foreach ($lotes as $lote) {
            array_push($lotesReturn,
              [
                  'numeroLote'=>$lote->id,
                  'fechaInicio'=>$lote->fechaInicio,
                  'vencimiento'=>$lote->fechaVencimiento,
                  'cantidad'=>$lote->cantidadFinal
              ]);
        }
        return $lotesReturn;
      }

    	public function getIngredientes(){
           $ingredientes = $this->formulacion()->get();
           $arrayResult = [];
           foreach ($ingredientes as $ing){
               array_push($arrayResult,['id'=>$ing->pivot->ingrediente_id,'cantidad'=>$ing->pivot->cantidad]);
           }
           return $arrayResult;
        }   

     public function lotes ()
     {
        return $this->hasMany('App\Lote')->get()
        ;
     } 

     public function getArrayLotes()
     {

      return ['producto'=>$this->nombre,'tu'=>$this->tipoUnidad,'codigo'=>$this->codigo,'lotes'=>$this->lotes()];
      /*
        $arrayResult = [];
        $lotes = $this->lotes();
        foreach ($lotes as $lote) {
          array_push($arrayResult,$lote->toArray());
        }
        return $arrayResult;*/
     }

        public function productoToArray()
     {
        return ['nombre'=>$this->nombre,
              'tipoUnidad'=>$this->tipoUnidad,
              'codigo'=>$this->codigo,
              ];
     }



}   


# consulta en tinker

#>>> App\Producto::find(6)->formulacion()->attach(4,['cantidad'=>'4','cantidadProducto'=>'12','ingrediente_id'=>'2'])

