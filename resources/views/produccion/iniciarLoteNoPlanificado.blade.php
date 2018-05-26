@extends('layouts.layoutPrincipal' )
	
@section('section') 
	@include("elementosComunes.aperturaTitulo")
		Iniciar Lote No Planificado
	@include("elementosComunes.cierreTitulo")
	<div class="p-0">
    <div class="container">
      <form class="form-group" id="myform" enctype='application/json' >
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
              <input id="cantidad" type="text" class="form-control" "> 
          </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Unidad</label>
              <input type="text" id="tipoUnidad"  class="form-control"> 
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="exampleInputEmail1">Fecha Inicio</label>
              <input type="date" class="form-control" id="fecha"> </div>
            <div class="form-group">
              <label></label>
              <label for="exampleInputEmail1">Trabajo Práctico</label>
              <select class="form-control" id="tp">
                <option value="1">Si</option>
                <option value="2">No</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Asignatura</label>
              <input type="text" class="form-control" id="asignatura"> </div>
          </div>
        </div>
        <button type="button" id="btnformulacion" class="btn btn-primary">Ver Formulacion</button>
        

        <h4 class="">
          <b>Consumo:</b>
        </h4>
        
       
    
        @include("elementosComunes.aperturaTabla")
              <thead id="theadformulacion">
                <tr id="trhformulacion">
                  <th id="thinsumo">Insumo</th>
                  <th id="thlote">Lote&nbsp;</th>
                  <th id="thcantidad">Cantidad Utilizada</th>
                  <th id="thtu">Tipo Unidad</th>
                </tr>
              </thead>
              <tbody id="tbodyformulacion">
               
              </tbody>
            @include("elementosComunes.cierreTabla")
        <button type="submit" id="guardar" class="btn btn-primary">Guardar</button>
      </form>
    </div>
  </div>

@endsection
 @section('script')
 <script type="text/javascript" src="{{asset('js/getFormulacion.js')}}"></script>
 <script type="text/javascript" src="{{asset('js/postloteNoPlanificado.js')}}"></script>
 @endsection