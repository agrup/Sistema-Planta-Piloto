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
                <th>Unidad</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td >{{ $lote['id'] }}</td>
                <td>{{ $producto['nombre'] }}</td>
                <td>{{ $lote['cantidadElaborada'] }}</td>
                <td>{{$producto['tipoUnidad']}}</td>
              </tr>
              <tr></tr>
              <tr></tr>
            </tbody>
        <input type="hidden" id="producto" value="{{$producto['id']}}">

    @include('elementosComunes.cierreTabla')
  
      <div class="row">
        <div class="col-md-6">

          <form class="formu" id="myform" action="">
            {{ csrf_field() }}
              <input type="hidden" value="{{$lote['id']}}" name="loteID">
            <div class="form-group">
              <label>Cantidad a Elaborar</label>
              <input type="text" id="cantidad" class="form-control" >
              <button type="button" id="btnformulacion" class="btn btn-primary">Actualizar Formulación</button>
          </div>
          
          </div>
          <div class="col">
            <div class="form-group">
              <label for="exampleInputEmail1">Fecha Inicio</label>
              <input type="date" class="form-control" id="fecha" value="{{$fecha}}"> </div>
          {{-- <div class="form-group">
              <label></label>
              <label for="exampleInputEmail1">Trabajo Práctico</label>
              <select class="form-control" id="tp">
                <option value="1">Si</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Asignatura</label>
              <input type="text" class="form-control" id="asignatura" > </div>--}}
          </div>
        </div>
         
        </div>
      </div>
      <div class="row">
        <div class="col">
        
            <h4 class="">
              <b>Formulación:</b>
            </h4>
            <table id="tformulacion" class="table">
              <thead>
                <tr>
                  <th style="width:15% ">Insumo</th>
                  <th style="width:15% ">Lote&nbsp;</th>
                  <th style="width:15% ">Cantidad Utilizada</th>    
                  <th style="width:15% ">Tipo Unidad</th>
                  <th style="width:15% ">Stock</th>
                  <th style="width:15% "> </th>
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
                    <td id="tdstock"></td>
                    <td> <button type="button" value="agregarLote" class="btn btn-primary">Agregar Lote</button></td>
                    
                  </tr>
                @endforeach
              </tbody>
            </table>
            <button type="submit" id="guardar" class="btn btn-primary">Guardar</button>
          </form>
          <div>
             <form action="/" method="get">
                 <button  class="btn btn-secondary" >Volver al Menú</button>  
             </form>
         </div>
        </div>
      </div>
    </div>
  </div>
@endsection
 @section('script')
 <script type="text/javascript" src="{{asset('js/produccion/getFormulacionProductoPlanificado.js')}}"></script>

 <script type="text/javascript" src="{{asset('js/produccion/addRow Lote.js')}}"></script>
 <script src="{{asset('js/produccion/postLote.js')}}" type="text/javascript"></script>
 <script>
     document.addEventListener("DOMContentLoaded", function() {
         PostLote.init('/produccion/iniciarPlanificado');
     });

 </script>
 @endsection