@extends('layouts.layoutPrincipal' )
@section('section')
    @include('elementosComunes.aperturaTitulo')
  
        Sumatoria de necesidades de Insumos
   
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTitulo')
    <h4 class="">Sumarizacion hasta: <?= $_GET['fecha'];?></h4>
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
            <td>{{$v['fechaAgotamiento']}}</td>
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
    <form action="/sumarizacion" method="get">
        {{csrf_field()}}
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="">Revisar Planificacion Hasta:</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <input type="date" name="fecha" class="form-control"> </div>
            </div>
        </div>

    </div>
    @include('elementosComunes.aperturaBoton')
    <input type="submit" class="btn btn-primary" value="Ir a la Fecha">
    @include('elementosComunes.cierreBoton')
    </form>
@endsection