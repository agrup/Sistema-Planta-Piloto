@extends('layouts.layoutPrincipal' )
@section('section')
  @include('elementosComunes.aperturaTitulo')
            Modificar Producto Finalizado
@include('elementosComunes.cierreTitulo')
@include('elementosComunes.aperturaTabla')
             <thead>
              <tr>
                <th>Lote</th>
                <th>Código</th>
                <th>Producto</th> 
              </tr>
            </thead>
            <tbody>
              <tr><td>{{$lote['id']}}</td>
                <td>{{$producto['codigo']}}</td>
                <td>{{$producto['nombre']}}</td>          
              </tr>
            </tbody>
@include('elementosComunes.cierreTabla')        
      <div class="row">
        <div class="col-md-6">
          <form class="formu" action="">
            <div class="form-group">
              <label>Fecha Inicio</label>
              <input type="date" class="form-control" value="{{$lote['fecha']}}"> </div>
            <div class="row">
              <div class="col">
                <label>Cantidad Elaborada</label>
                <input type="text" class="form-control" placeholder="100"> </div>
              <div class="col">
                <label for="exampleInputEmail1">Unidad</label>
                <input type="text" class="form-control"  id="inlineFormInput"> </div>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <form class="formu" action="">
            <div class="form-group">
              <label>Trabajo Práctico</label>
                <select class="form-control">
                   @if($lote['tipoTp'])
                      <option value="true" selected>SI</option>
                      <option value="false" >NO</option>
                   @else
                      <option value="true">SI</option>
                      <option value="false" selected>NO</option>
                   @endif
                </select>
            
              
            <div class="form-group">
              <label>Asignatura</label>
              <input type="text" class="form-control"> </div>
          </form>
        </div>
      </div>
   @include('elementosComunes.aperturaTabla')
          <form>
            <h4 class="">
              <b>Formulación:</b>
            </h4>
            <table class="table">
              <thead>
                <tr>
                  <th>Insumo</th>
                  <th>Lote&nbsp;</th>
                  <th>Cantidad Utilizada</th>
                  <th>Tipo Unidad</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
   @include('elementosComunes.cierreTabla') 
@endsection