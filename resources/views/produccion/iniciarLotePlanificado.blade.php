@extends('layouts.layoutPrincipal' )

@section('section')
		@include('elementosComunes.aperturaTitulo')
			Iniciar Lote Planificado
		@include('elementosComunes.cierreTitulo')

		
    @include('elementosComunes.aperturaTabla')
            <thead>
              <tr>
                <th>Lote</th>
                <th>Producto</th>
                <th>Cantidad Planificada</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id="idlote" value="{{$producto['id']}}">{{ $lote['id'] }}</td>
                <td>{{ $producto['nombre'] }}</td>
                <td>{{ $lote['cantidadElaborada'] }}</td>
              </tr>
              <tr></tr>
              <tr></tr>
            </tbody>
    @include('elementosComunes.cierreTabla')
  
      <div class="row">
        <div class="col-md-6">
          <form class="formu" id="myform" action="">

            <div class="form-group">
              <label>Cantidad a Elaborar</label>
              <input type="text" id="cantidad" class="form-control" >
              <button type="button" id="btnformulacion" class="btn btn-primary">Actualizar Formulación</button>
          </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Unidad</label>
              <input type="text" id="tipoUnidad"  class="form-control"> 
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="exampleInputEmail1">Fecha Inicio</label>
              <input type="date" class="form-control" id="fecha" value="{{$fecha}}"> </div>
            <div class="form-group">
              <label></label>
              <label for="exampleInputEmail1">Trabajo Práctico</label>
              <select class="form-control" id="tp">
                <option value="true">Si</option>
                <option value="false">No</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Asignatura</label>
              <input type="text" class="form-control" id="asignatura" > </div>
          </div>
        </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <form>
            <h4 class="">
              <b>Formulación:</b>
            </h4>
            <table id="tformulacion" class="table">
              <thead>
                <tr>
                  <th>Insumo</th>
                  <th>Lote&nbsp;</th>
                  <th>Cantidad Utilizada</th>
                  <th>Tipo Unidad</th>
                </tr>
              </thead>
              <tbody id="tbodyformulacion">
                @foreach($formulacion as $value)
                  <tr>
                  
                    <td>{{$value['nombre']}}</td>
                    <td><input type="text"></td>
                    <td><input type=""  placeholder="Cantidad Teorica:{{$value['cantidad']}}"></td>
                    <td> {{$value['tipoUnidad']}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <button type="submit" id="guardar" class="btn btn-primary">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
 @section('script')
 <script type="text/javascript" src="{{asset('js/getFormulacionProductoPlanificado.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('js/postLote.js')}}"></script>--}}
 <script src="{{asset('js/postLote.js')}}" type="text/javascript"></script>
 <script>
     document.addEventListener("DOMContentLoaded", function() {
         PostLote.init('/produccion/iniciarPlanificado');
     });

 </script>
 @endsection  