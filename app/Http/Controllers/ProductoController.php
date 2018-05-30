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

  public function altaProducto(){
    $insumoProducto = "producto";
    return view('administracion.altaInsumoProducto')->with(compact('insumoProducto'));
  }
  public function addProducto(){
    //Recibe por post los datos de un producto para alta
    //"codigo", "nombre", "descripcion", "unidad", "alarmaActiva", "alarmaAmarilla",  "alarmaRoja", "categoria"
    $alarma = null;
    if(request()->input('alarmaActiva')=="true")
        $alarma= true;
    else
        $alarma = false;

    $estado = null;
    if(request()->input('estado')=="true")
        $estado = true;
    else
        $estado = false;

     $datosNuevoProd = [
            
            'nombre'=>request()->input('nombre'),
            'descripcion'=>request()->input('descripcion'),
            'tipoUnidad'=>request()->input('tipoUnidad'),
            'codigo'=>request()->input('codigo'),
            'alarmaActiva'=>$alarma,
            'alarmaAmarilla'=>request()->input('alarmaAmarilla'),
            'alarmaRoja'=>request()->input('alarmaRoja'),
            'categoria'=>request()->input('categoria'),
            'estado'=>$estado
        ];

    $nuevoProd = Producto::create($datosNuevoProd);

    $insumoProducto = 'producto';
    return view('administracion.buscarInsumoProducto')->with(compact('insumoProducto'));
  }

  public function altaInsumo(){
    $insumoProducto = "insumo";
    return view('administracion.altaInsumoProducto')->with(compact('insumoProducto'));
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
		 if ($alarma == 'true') {
		 	$alarma=true;
		 }else{
		 	$alarma=false;
		 }
		 

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