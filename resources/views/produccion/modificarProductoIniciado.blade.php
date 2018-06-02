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
                <label>Cantidad Actual</label>
                <input type="text" class="form-control" value={{$lote['cantidad']}}></div>
              <div class="col">
                <label for="exampleInputEmail1">Unidad</label>
                <input type="text" class="form-control"  id="inlineFormInput" disabled="true" value="{{$producto['tipoUnidad']}}"> </div>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <form class="formu" action="">
            <div class="form-group" id="#divselect">
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

                     
                   @endif
                

          </form>
        </div>
      </div>

      @include('elementosComunes.aperturaTabla')
   <div class="row"></div>
    <div class="col"></div>
          <form id="myform">
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

                  @foreach($formulacion as $insumo)
                      <?php
                      $arrayTrazabilidad=array();
                      ?>
                      @for ($i = 0; $i < count($trazabilidad); $i++)
                        @if ($trazabilidad[$i]['nombre']==$insumo['nombre'])
                              <?php   array_push($arrayTrazabilidad,$i); //guardo los i de las trazabilidades
                              ?>   
                        @endif
                      @endfor

                    @if(empty($arrayTrazabilidad))

                              <tr>
                              <td>{{$insumo['nombre']}}</td>
                              <td><input type="" ></td>
                              <td><input type="" placeholder="Teorica Total: {{$insumo['cantidad']}}"></td>
                              <td>{{ $insumo['tipoUnidad'] }}</td>
                              <td> <button type="button" value="agregarLote" class="btn btn-primary">Agregar Lote</button></td>
                              </tr>

                    @else
                        @for ($i = 0; $i < count($arrayTrazabilidad); $i++)
                          <tr>
                            <td>{{$insumo['nombre']}}</td>
                            <td><input type="text" name="" value="{{$trazabilidad[$arrayTrazabilidad[$i]]['lote_id']}}"></td>
                            <td><input type="text" name="" value=" {{ $trazabilidad[$arrayTrazabilidad[$i]]['cantidad'] }}"></td>
                            <td>{{ $insumo['tipoUnidad'] }}</td>
                          @if($i==count($arrayTrazabilidad)-1)
                            <td> <button type="button" value="agregarLote" class="btn btn-primary">Agregar Lote</button></td>
                          </tr>
                          @else
                            </tr>
                          @endif        
                        @endfor

                    @endif
                  @endforeach


              </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
   </div>
 </div>
 @include('elementosComunes.cierreTabla')

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