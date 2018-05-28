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
                <label>Cantidad Elaborada</label>
                <input type="text" class="form-control" placeholder="Cantidad Actual: {{$lote['cantidad']}}"> </div>
              <div class="col">
                <label for="exampleInputEmail1">Unidad</label>
                <input type="text" class="form-control"  id="inlineFormInput" disabled="true" value="{{$producto['tipoUnidad']}}"> </div>
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
                      <div class="form-group">
                    <label>Asignatura</label>
                    <input type="text" class="form-control" placeholder="Asignatura Actual: {{$lote['asignatura']}}"> </div>
                   @else
                      <option value="true">SI</option>
                      <option value="false" selected>NO</option>
                   @endif
                </select>

          </form>
        </div>
      </div>

      @include('elementosComunes.aperturaTabla')
   <div class="row"></div>
    <div class="col"></div>
          <form >
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
                  <?php $b=false;?>
                    <tr>
                      <td>{{$insumo['nombre']}}</td>
                      @for ($i = 0; $i < count($trazabilidad); $i++)
                          @if ($trazabilidad[$i]['nombre']==$insumo['nombre'])
                          <?php $b=true;?>
                            <td><input type="text" name="" value="{{$trazabilidad[$i]['numeroLote']}}"></td>
                            <td><input type="text" name="" value=" {{ $trazabilidad[$i]['cantidad'] }} "></td>

                            @break    
                          @endif
                      @endfor
                      @if ($b==false)
                        <td><input type="" ></td>
                        <td><input type="" placeholder={{$insumo['cantidad']}}></td>
                      @endif 
                    <td>{{ $insumo['tipoUnidad'] }}</td>      
                    </tr>
                  @endforeach

              </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
   </div>
 </div>
 @include('elementosComunes.cierreTabla')

@endsection