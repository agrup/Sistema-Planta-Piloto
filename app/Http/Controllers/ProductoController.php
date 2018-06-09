<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Movimiento;
class ProductoController extends Controller
{
    


  public function administracionInsumo(){
    $insumoProducto = 'insumo';
    $succes=false;
    return view('administracion.buscarInsumoProducto')->with(compact('succes'))
                                            ->with(compact('insumoProducto'));
  } 



  

  public function showAltaInsumo(){



    $insumoProducto = "insumo";
    $insumos = [];
     $succes=false;
    return view('administracion.altaInsumoProducto')->with(compact('insumoProducto'))
                                                    ->with(compact('succes'))
                                                    ->with(compact('insumos'));
  }

  public function altaInsumo(){
/*

*/
    $this->validate(request(),[
       'nombre'=>'required',
        'descripcion'=>'required',
        'tipoUnidad'=>'required',
        'codigo'=>'required',
        'alarmaActiva'=>'required|boolean',

      ]);

    $insumoProducto = "insumo";
    $insumos = [];
     $datosInsumo = [

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

 $succes=false;

      if (count(Producto::where('codigo',$datosInsumo['codigo'])->get())==0) {
              
      $producto = Producto::create($datosInsumo);
      $succes=true;
      Movimiento::crearUltimoRealFicticio($producto->id);
      }else{
        throw new Exception('Codigo de Insumo existente');
      } 

     
        
        

    return view('administracion.altaInsumoProducto')->with(compact('insumoProducto'))
                                                    ->with(compact('succes'))
                                                    ->with(compact('insumos'))
                                                    ->withSucces('Alta Exitosa');
                                                    ;
  }



public function showModificarInsumo()
{
  $producto =Producto::find(request()->input('id'));

  return view('administracion.modificarInsumo')->with(compact($producto));
}


  public function modificarInsumo(){
    $insumoProducto = "insumo";
    $insumos = [];
     $datosInsumo = [

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

 $succes=false;

      if (count(Producto::where('codigo',$datosInsumo['codigo'])->get())!=0) {
              
        throw new Exception('Codigo de Insumo inexistente');
      }else{
      Producto::where('codigo',$datosInsumo['codigo'])->delete();
      $Producto = Producto::create($datosInsumo);
      $succes=true;
      } 

    return view('administracion.altaInsumoProducto')->with(compact('insumoProducto'))
                                                    ->with(compact('succes'))
                                                    ->with(compact('insumos'));
  }

  public function showdeleteInsumo(){
    $insumoProducto = 'insumo';
    return view('administracion.deleteInsumo')->with(compact('insumoProducto'));
  }



  public function deleteInsumo(){
    $insumoProducto = 'insumo';

    Producto::where('codigo',request()->input('codigo'))->delete();

    return view('administracion.deleteInsumo')->with(compact('insumoProducto'));
  }




  public function showAltaProducto(){
  $insumoProducto = "producto";
  $succes=false;
  $insumos=Producto::all()->toArray();
  //var_dump(compact('insumos'));
  return view('administracion.altaInsumoProducto')
                                                    ->with(compact('insumos'))
                                                    ->with(compact('insumoProducto'))
                                                    ->with(compact('succes'));
}

  public function administracionProducto(){
    $insumoProducto = 'producto';
    $succes=false;
    return view('administracion.buscarInsumoProducto')->with(compact('succes'))
                                                  ->with(compact('insumoProducto'));
  }

public function altaProducto(){
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
  

      if (count(Producto::where('codigo',$datosProducto['codigo'])->get())==0) {
              
        $Producto = Producto::create($datosProducto);
      }else{
        var_dump(count(Producto::where('codigo',$datosProducto['codigo'])->get()));
        throw new Exception('Codigo de Producto existente');
      } 

        //$Producto = Producto::create($datosProducto);
        //recorro todos los ingredientes para agregarlos a la formulacion del producto creado
        $formulacion = explode(',',$formulacion);// pasa el string a array

/*
    */
        for ($i= 0; $i<count($formulacion) ; $i=$i+2) {
          $ingrediente_id =$formulacion[$i];
          $cantidadProducto = $formulacion[$i+1];
          if ($Producto->agregarIngrediente($cantidad,$cantidadProducto,$ingrediente_id)){
            throw new Exception('erro ingrediente ingrediente ya agregado');
          }
        }

        Movimiento::crearUltimoRealFicticio($Producto->id);

        $insumoProducto = 'producto';
        $succes=true;
        //$continuar = request()->input('continuar');
       $insumos=Producto::all()->toArray();
          return view('administracion.altaInsumoProducto')->with(compact('insumos'))
                                          ->with(compact('succes'))
                                          ->withSucces('Alta Exitosa')
                                          ->with(compact('insumoProducto'));
       

      }



public function showModificarProducto()
{
  $producto =Producto::find(request()->input('id'));

  return view('administracion.modificarProducto')->with(compact($producto));
}

public function modificarProducto()
{

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

      if (count(Producto::where('codigo',$datosProducto['codigo'])->get())==0) {
              
        throw new Exception('Codigo de Producto inexistente');
      }else{
        Producto::find($datosProducto['codigo'])->formulacion()->detach();
        $Producto = Producto::create($datosProducto);

      } 
     

        //$Producto = Producto::create($datosProducto);
        //recorro todos los ingredientes para agregarlos a la formulacion del producto creado
        $formulacion = explode(',',$formulacion);// pasa el string a array

        for ($i= 0; $i<count($formulacion) ; $i=$i+2) {
          $ingrediente_id =$formulacion[$i];
          $cantidadProducto = $formulacion[$i+1];
          if ($Producto->agregarIngrediente($cantidad,$cantidadProducto,$ingrediente_id)){
            throw new Exception('error ingrediente ingrediente ya agregado');
          }
        }
  


  return view('administracion.modificarProducto');
}

  public function showdeleteProducto(){
    $insumoProducto = 'producto';
    return view('administracion.deleteProducto')->with(compact('insumoProducto'));
  }

  public function deleteProducto(){
    $insumoProducto = 'producto';

    $producto=Producto::where('codigo',request()->input('codigo'));
    
    $producto->detach();

    //return \Response::json(['response'=>true]);
    //return response()->json($producto);
    $result = true;
    return Response::json(['success' => $result], 200);
    //return view('administracion.deleteProducto')->with(compact('insumoProducto'));
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
  $inspro = request()->input('insumoProducto');
		// $insumoProducto = 'producto';


		 $codigo=request()->input('codigo');
		 $nombre=request()->input('nombre');
		 $categoria=request()->input('categoria');
		 $alarma=request()->input('alarma');

	   if($inspro=='producto'){

    $productos = (Producto::filterRAW($codigo,$nombre,$categoria,$alarma));

    $respuesta=[];
        foreach ($productos as $producto) {
          if (!empty($producto->getIngredientes())) {
           array_push($respuesta, $producto);
          }
          
        }       


     }
      if($inspro=='insumo'){
        $respuesta=[];
        
        $insumos= (Producto::filterRAW($codigo,$nombre,$categoria,$alarma));

        foreach ($insumos as $insumo) {
          if (empty($insumo->getIngredientes())) {
           array_push($respuesta, $insumo);
          }
          
        }
        
         //var_dump($productos);
      }


		return  \Response::json($respuesta);






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