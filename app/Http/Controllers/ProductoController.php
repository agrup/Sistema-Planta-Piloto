<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
class ProductoController extends Controller
{
    

	public function administracionProducto(){
		$insumoProducto = 'producto';
		return view('administracion.buscarInsumoProducto')->with(compact('insumoProducto'));
	}
  public function administracionInsumo(){
    $insumoProducto = 'insumo';
    return view('administracion.buscarInsumoProducto')->with(compact('insumoProducto'));
  }

  public function showAltaProducto(){
    $insumoProducto = "producto";

    $insumos=Producto::all()->toArray();
    //var_dump(compact('insumos'));
    return view('administracion.altaInsumoProducto')
                                                      ->with(compact('insumos'))
                                                      ->with(compact('insumoProducto'));

  }


  public function addProducto(){
    //Recibe por post los datos de un producto para alta
    //"codigo", "nombre", "descripcion", "unidad", "alarmaActiva", "alarmaAmarilla",  "alarmaRoja", "categoria"

      $estado = true;
     $datosProducto = [

            'nombre'=>request()->input('nombre'),
            'descripcion'=>request()->input('descripcion'),
            'tipoUnidad'=>request()->input('tipoUnidad'),
            'codigo'=>request()->input('codigo'),
            'alarmaActiva'=>request()->input('alarmaActiva'),
            'alarmaAmarilla'=>request()->input('alarmaAmarilla'),
            'alarmaRoja'=>request()->input('alarmaRoja'),
            'categoria'=>request()->input('categoria'),
            'estado'=>true
        ];

    $cantidad = request()->input('productoCantidad');

    $formulacion = request()->input('formulacion');
    var_dump($formulacion);
    $Producto = Producto::create($datosProducto);
    
    //recorro todos los ingredientes para agregarlos a la formulacion del producto creado
    $formulacion = explode(',',$formulacion);// pasa el string a array

    for ($i= 0; $i<count($formulacion) ; $i=$i+2) {
      $ingrediente_id =$formulacion[$i];
      $cantidadProducto = $formulacion[$i+1];
      if ($Producto->agregarIngrediente($cantidad,$cantidadProducto,$ingrediente_id)){
        return 'erro ingrediente ingrediente ya agregado';
      }
    }

    var_dump($formulacion);
/*
    foreach($formulacion as $ingrediente);
    {
      $ingrediente_id =$ingredinte['id'];
      $cantidadProducto = $ingredinte['cantidad'];
      if ($Producto->agregarIngrediente($cantidad,$cantidadProducto,$ingrediente_id)){
        return 'erro ingrediente ingrediente ya agregado';
      }
    }
        
*/


    $insumoProducto = 'producto';
    

    return view('administracion.buscarInsumoProducto')->with(compact('insumoProducto'));
  }

  public function altaInsumo(){
    $insumoProducto = "insumo";
    $insumos = [];
    return view('administracion.altaInsumoProducto')->with(compact('insumoProducto'))
                                                    ->with(compact('insumos'));
  }



	/*public static function  search()
	{
		$response = array(
			'c' => 'success',
            'status' => 'success',
            'msg' => 'Setting created successfully',
        );
        return \Response::json($response);
		*/

	public function  search()
	{
		
		 $insumoProducto = 'producto';	

		 $codigo=request()->input('codigo');
		 $nombre=request()->input('nombre');
		 $categoria=request()->input('categoria');
		 $alarma=request()->input('alarma');

		 

		$productos= (Producto::filterRAW($codigo,$nombre,$categoria,$alarma))->toArray();

		return  \Response::json($productos);






	}



	 


}
/*

//filtro producto por codigo
     public function filterByCodigo (int $codigo)
     {
        if ($codigo != null) {
          return $this->where('codigo','=',$codigo);
        }else{
          return $this;
        }
     }
       //filtro producto por nombre
       public function filterByName ($nombre)
       {
        if ($nombre != null) {
          return $this->where('nombre','=',$nombre);
        }else{
          return $this;
        }
       }   
     //filtro producto por categoria
         public function filterByCategoria ($categoria)
              {
          if ($categoria != null) {
            return $this->where('categoria','=',$categoria);
          }else{
            return $this;
          }
         }
     //filtro producto por alarma
       public function filterByAlarma ($alarma)
            {
        if ($alarma != null) {
          return $this->where('alarmaActiva','=',$alarma);
        }else{
          return $this;
        }
       }
*/