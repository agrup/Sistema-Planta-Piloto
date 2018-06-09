@extends('layouts.layoutPrincipal' )
	
@section('section') 
	@include("elementosComunes.aperturaTitulo")
		Iniciar Lote No Planificado
	@include("elementosComunes.cierreTitulo")
	<div class="p-0">
    <div class="container">
      <form class="form-group" id="myform"   >
      	 {{ csrf_field() }}
        <div class="row">
          <div class="col">
           
            <div class="form-group">
              <label>Producto</label>
              <select  id="selectProducto" class="form-control" >
              	<option  selected="selected">--Seleccione un Producto--</option>
                  @foreach($productos as $value)
                	<option  id="producto" name="{{$value['tipoUnidad']}}" value="{{$value['id']}}">{{$value['nombre']}}</option>
                	
                @endforeach

              </select>
            </div>	
            <div class="form-group">
              <label contenteditable="true" for="exampleInputEmail1">Cantidad Elaborada</label>
              <input id="cantidad" type="text" class="form-control" >
          </div>
          
          </div>
          <div class="col">
            <div class="form-group">
              <label for="exampleInputEmail1">Fecha Inicio</label>
              <input type="date" class="form-control" id="fecha" @if(isset($fecha)) value="{{$fecha}}" @endif> </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Unidad</label>
              <input type="text" id="tipoUnidad"  class="form-control"> 
            </div>
            <div class="form-group">
             </div>
          </div>
        </div>
        <button type="button" id="btnformulacion" class="btn btn-primary">Ver Formulacion</button>
        

        <h4 class="">
          <b>Consumo:</b>
        </h4>
        
       
    
        @include("elementosComunes.aperturaTabla")
              <thead id="theadformulacion">
                <tr id="trhformulacion">
                  <th style="width:15% " id="thinsumo">Insumo</th>
                  <th style="width:15% " id="thlote">Lote&nbsp;</th>
                  <th style="width:15% " id="thcantidad">Cantidad Utilizada</th>

                  <th  style="width:15% " id="thtu">Tipo Unidad</th>
                  <th style="width:15% ">Stock</th>
                  <th style="width:15% "></th>
                </tr>
              </thead>
              <tbody id="tbodyformulacion">
               
              </tbody>
            @include("elementosComunes.cierreTabla")
        <button type="submit" id="guardar" class="btn btn-primary">Guardar</button>
        <div>
             <form action="/" method="get">
                 <button  class="btn btn-secondary" >Volver al Menú</button>  
             </form>
         </div>
      </form>
    </div>


  </div>

@endsection
 @section('script')
 <script type="text/javascript" src="{{asset('js/produccion/getFormulacionProductoNoPlanificado.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/produccion/postLote.js')}}"></script>
 <script>
     document.addEventListener("DOMContentLoaded", function() {
         PostLote.init("/produccion/loteNoPlanificado");
     });

 </script>
 <script type="text/javascript" src="{{asset('js/produccion/addRowLote.js')}}"></script>
 @endsection