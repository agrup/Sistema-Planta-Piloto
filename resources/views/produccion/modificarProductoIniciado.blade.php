@extends('layouts.layoutPrincipal' )
@section('section')
  @include('elementosComunes.aperturaTitulo')
            Modificar Producto Iniciado
@include('elementosComunes.cierreTitulo')
@include('elementosComunes.aperturaTabla')
             <thead>
              <tr>
                <th>Lote</th>
                <th>Código</th>
                <th>Producto</th> 
                <th>Unidad</th> 
              </tr>
            </thead>
            <tbody>
              <tr><td>{{$lote['id']}}</td>
                <td>{{$producto['codigo']}}</td>
                <td>{{$producto['nombre']}}</td> 
                <td>{{$producto['tipoUnidad']}}</td>         
              </tr>
            </tbody>
            <input type="hidden" id="producto" value="{{$producto['id']}}">
@include('elementosComunes.cierreTabla')        
      <div class="row">
        <div class="col-md-6">
          <form class="formu" action="">
            <div class="form-group">
              <label>Fecha Inicio</label>
              <input type="date" class="form-control" value="{{$lote['fecha']}}" id="fecha"> </div>
            <div class="row">
              <div class="col">
                <label>Cantidad Actual</label>
                <input type="text" class="form-control" value="{{$lote['cantidad']}}" id="cantidad"></div>
           
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <form class="formu" action="">
          {{-- <div class="form-group" id="#divselect">
              <label>Trabajo Práctico</label>
                  
                   @if($lote['tipoTp']==true)
                   <select class="form-control" id="selectTP">
                      <option value="true" selected>SI</option>
                      <option value="false" >NO</option>
                      <div class="form-group">
                    <label id="asignatura">Asignatura</label>
                    <input id="inputasignatura" type="text" class="form-control" placeholder="Asignatura Actual: {{$lote['asignatura']}}"> </div>
                     </select>
                   @else
                   <select class="form-control" id="selectTP">
                      <option value="true">SI</option>
                      <option value="false" selected>NO</option>
                     </select>
                      <label>Asignatura</label>
                      <input id="inputasignatura" type="text" class="form-control" disabled="true" />

                     
                   @endif--}} 
                

          </form>
        </div>
      </div>
  <form id="myform">
      @csrf
      @include('elementosComunes.aperturaTabla')
   <div class="row"></div>
    <div class="col"></div>

            <h4 class="">
              <b>Formulación:</b>
            </h4>
           <table id="tformulacion" class="table">
              <thead>
                <tr>
                  <th >Insumo</th>
                  <th>Lote&nbsp;</th>
                  <th>Cantidad Utilizada</th>
                  <th>Tipo Unidad</th>
                </tr>
              </thead>
              <tbody id="tbodyformulacion">
                @foreach($formulacion as $ingrediente)
                  <tr class="trConsumo">
                      <input type="hidden" value="{{$ingrediente['id']}}" class="interes">
                    <td>{{$ingrediente['nombre']}}</td>
                    
                    <td><select class="interes">
                      <option disabled="true" selected="true">--Seleccionar Lote--</option>
                      @foreach($ingrediente['lotes'] as $lote)
                        <option value="{{$lote['id']}}" data-stock="{{$lote['stock']}}">{{$lote['id']}}</option>
                      @endforeach
                    </select></td>
                    <td><input type=""  placeholder="Teorica total:{{$ingrediente['cantidad']}}" class="interes"></td>
                    <td> {{$ingrediente['tipoUnidad']}}</td>
                    <td> <button type="button" value="agregarLote" class="btn btn-primary">Agregar Lote</button></td>
                  </tr>
                @endforeach
              </tbody>
            </table>

            <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
            <div>
             <form action="/" method="get">
                 <button  class="btn btn-secondary" >Volver al Menú</button>  
             </form>
         </div>
   </div>
 </div>
 @include('elementosComunes.cierreTabla')
  </form>

@endsection
@section('script')
   <script type="text/javascript" src="{{asset('js/produccion/addAsignatura.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/produccion/addRowLote.js')}}"></script>
   <script type="text/javascript" src="{{asset('js/produccion/postLote.js')}}"></script>
   <script>
       document.addEventListener("DOMContentLoaded", function() {
           PostLote.init("/produccion/modificarIniciado/{{$lote['id']}}");
       });

   </script>

@endsection