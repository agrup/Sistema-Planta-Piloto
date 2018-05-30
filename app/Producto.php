<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use App\Lote;

/**
 * Producto
 * @mixin Eloquent
 *
 * */
class Producto extends Model
{


    protected $guarded=[];




#addformulacion agrega las ttablas pivot al producto que le paso
    public function formulacion ()
    {
    	 # return $this->belongsToMany('Producto', 'producto_productoi', 'producto_id', 'ingrediente_id');
    	 return $this->belongsToMany('App\Producto','producto_productoi')
    	 	->withPivot('producto_id','ingrediente_id','cantidad','cantidadProducto')->get();
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

    /**
     * @return array [ ['id'=>, 'cantidad'=>, 'cantidadProducto'=> ] .. ]
     */
    public function getIngredientes(){
           $ingredientes = $this->formulacion();
           $arrayResult = [];
           foreach ($ingredientes as $ing){
               array_push($arrayResult,['id'=>$ing->pivot->ingrediente_id,'cantidad'=>$ing->pivot->cantidad, 'cantidadProducto'=>$ing->pivot->cantidadProducto]);
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

    /**
     * @param int $cantidad a realizar
     * @return array =  [ ['codigo
     */
    public function getFormulacion(int $cantidad)
     {
         $formulacion = [];
         $ingredientes = $this->getIngredientes();
         foreach ($ingredientes as $ing){
            $arrAux=[];
            $arrayLotes=[];
            $productoAux = Producto::find($ing['id']);
            $arrAux['id']=$ing['id'];
            $arrAux['codigo']=$productoAux->codigo;
            $arrAux['nombre']=$productoAux->nombre;
            $arrAux['tipoUnidad']=$productoAux->tipoUnidad;
            $arrAux['cantidad'] = $cantidad * $ing['cantidad'] / $ing ['cantidadProducto'];
            //Agrego además los lotes, accion altamente cuestionable
             $lotes = Lote::where('producto_id','=',$ing['id'])->get();
             foreach($lotes as $lote){
                 if(GestorStock::getSaldoLote($lote->id)>0){
                     array_push($arrayLotes,$lote->id);
                 }
             }
             $arrAux['lotes']=$arrayLotes;
            array_push($formulacion,$arrAux);
        }
        return $formulacion;
     }




     //filtro producto por codigo
    public static function filterRAW($codigo ,$nombre, $categoria,$alarma){


      $query=null;

     if($codigo!=null){
        $query = 'codigo='."'$codigo'";
     }; 
     
     if($nombre!=null){
        if ($query==null) {
            $query='nombre='."'$nombre'";
        }else{
            $query=$query.'and nombre='."'$nombre'";
        }
     };

     if($categoria!=null){
      if ($query==null) {
            $query='categoria='."'$categoria'";
        }else{
          $query=$query.'and categoria='."'$categoria'";
        }
     };

     if($alarma!=null){
       if ($query==null) {
              $query=$query.'alarma='."'$alarma'";
          }else{
            $query=$query.'and alarma='."'$alarma'";
          }
     };
     if ($query==null) {
       return Producto::all();
     }else{
     return Producto::whereRAW($query)->get();
     }
                
    }


}


