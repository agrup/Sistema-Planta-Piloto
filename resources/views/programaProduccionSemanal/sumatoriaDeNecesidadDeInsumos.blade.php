@extends('layouts.layoutPrincipal' )
@section('section')
    @include('elementosComunes.aperturaTitulo')
        Verificar Insumos
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTitulo')
    
    <h5><b>Sumarizacion hasta: </b></h5>
    <form action="/planificacion/verificar/{{$fechaHasta}}" method="get" class="form-inline">
        {{csrf_field()}}
        {{-- {date("d-m-Y",strtotime($fechaHasta))}} --}}
        <div class="input-group">
        @if(isset($_GET['fecha']))
        <input type="date" name="fecha" class="form-control" value="{{$_GET['fecha']}}"> 
        @else
         <input type="date" name="fecha" class="form-control" value="{{$fechaHasta}}">   
         @endif                 
        </div>
        <input type="submit" class="btn btn-primary" value="Ir a la Fecha">         
    </form>

    
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTitulo')
    <h4 class="">En necesidad</h4>
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTabla')
    <thead>
    <tr>
        <th>Código</th>
        <th>Insumo</th>
        <th>Necesidad Final</th>
        <th>Fecha Agotamiento</th>
    </tr>
    </thead>
    <tbody>
    @foreach($necesidad['necesidades'] as $v)
        <tr>
            <td> {{$v['codigo']}}</td>
            <td>{{$v['insumo']}}</td>
            <td>{{$v['necesidadFinal']}}  {{$v['tipoUnidad']}}</td>
            <td>{{date("d-m-Y",strtotime($v['fechaAgotamiento']))}}</td>
        </tr>
    @endforeach
    <?php unset($value);?>

    </tbody>
    @include('elementosComunes.cierreTabla')
    @include('elementosComunes.aperturaTitulo')
    <h4 class="">Alarmas Baja Cantidad</h4>
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTabla')
    <thead>
    <tr>
        <th>Código</th>
        <th>Insumo</th>
        <th>Cantidad Restante</th>
    </tr>
    </thead>
    <tbody>
    @foreach($necesidad['alarmas'] as $v)
        <tr>
            <td> {{$v['codigo']}}</td>
            <td>{{$v['insumo']}}</td>
            @if($v['color']=="roja")
                <td><font color="red" > {{$v['cantidad']}}  {{$v['tipoUnidad']}}</font></td>
            @elseif($v['color']=="amarilla")
                <td > {{$v['cantidad']}}  {{$v['tipoUnidad']}}</td>
            @else    
                <td>{{$v['cantidad']}}  {{$v['tipoUnidad']}}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
    @include('elementosComunes.cierreTabla')

  {{--@include('alertaStock')--}}  
    <div class="rowFlex" >
        <div>
            <form action="/planificacion" method="post">
                  @if(isset($_GET['fecha']))
                    <input type="date" name="fecha" class="form-control" value="{{$_GET['fecha']}}" hidden="true"> 
                    @else
                     <input type="date" name="fecha" class="form-control" value="{{$fechaHasta}}" hidden="true">   
                     @endif  
              <button  class="btn btn-primary" >Volver a la Semana</button>   
            </form>
         </div>
         
         <div>
            <form action="/planificacion/planificacionDia" method="get"> 
                 @if(isset($_GET['fecha']))
                    <input type="date" name="fecha" class="form-control" value="{{$_GET['fecha']}}" hidden="true"> 
                    @else
                     <input type="date" name="fecha" class="form-control" value="{{$fechaHasta}}" hidden="true">   
                     @endif  
              <button action="/planificacion" class="btn btn-primary">Volver a la Fecha</button>   
           </form>
        </div>
        <div>
             <form action="/" method="get">
                 <button  class="btn btn-secondary" >Volver al Menú</button>  
             </form>
         </div>
    </div>

@endsection