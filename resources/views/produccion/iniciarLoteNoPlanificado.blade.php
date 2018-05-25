@extends('layouts.layoutPrincipal' )
	
@section('section') 
	@include("elementosComunes.aperturaTitulo")
		Iniciar Lote No Planificado
	@include("elementosComunes.cierreTitulo")
	<div class="p-0">
    <div class="container">
      <form class="form-group">
        <div class="row">
          <div class="col">
           
            <div class="form-group">
              <label>Producto</label>
              <select  id="selectProducto" class="form-control" >
              	<option  selected="selected">--Seleccione un Producto--</option>
                  @foreach($productos as $value)
                	<option  id="producto" value="{{$value['id']}}">{{$value['nombre']}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label contenteditable="true" for="exampleInputEmail1">Cantidad Elaborada</label>
              <input id="cantidad" type="text" class="form-control" id="inlineFormInput"> 
          </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Unidad</label>
              <select class="form-control">
              
              </select>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="exampleInputEmail1">Fecha Inicio</label>
              <input type="date" class="form-control" id="inlineFormInput"> </div>
            <div class="form-group">
              <label></label>
              <label for="exampleInputEmail1">Trabajo Práctico</label>
              <select class="form-control">
                <option value="1">Si</option>
                <option value="2">No</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Asignatura</label>
              <input type="text" class="form-control" id="inlineFormInput"> </div>
          </div>
        </div>
        <button type="submit" id="btnformulacion" class="btn btn-primary">Ver Formulacion</button>
        <div id="alert" class="alert alert-info"></div>

        <h4 class="">
          <b>Formulación:</b>
        </h4>
        
       
          
          
    
        @include("elementosComunes.aperturaTabla")
              <thead>
                <tr>
                  <th>Insumo</th>
                  <th>Lote&nbsp;</th>
                  <th>Cantidad Utilizada</th>
                  <th>Tipo Unidad</th>
                </tr>
              </thead>
              <tbody id="insumo">
               
              </tbody>
            @include("elementosComunes.cierreTabla")
        <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
    </div>
  </div>

@endsection
 @section('script')
 <script type="text/javascript" src="{{asset('js/getFormulacion.js')}}"></script>
 @endsection