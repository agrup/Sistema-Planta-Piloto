@extends('layouts.layoutPrincipal' )
@section('section')
    @include('elementosComunes.aperturaTitulo')
    <h2 class="display-5">
        <b>Sumatoria de necesidades de Insumos</b>
    </h2>
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
            <td>{{$v['necesidadFinal']}}  {{$v['tu']}}</td>
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
            <td>{{$v['cantidad']}}  {{$v['tu']}}</td>
        </tr>
    @endforeach
    </tbody>
    @include('elementosComunes.cierreTabla')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="">Revisar Planificacion Hasta:</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <input type="date" class="form-control"> </div>
            </div>
        </div>
    </div>
    @include('elementosComunes.aperturaBoton')
    <a class="btn btn-primary" href="#">Ir a la Fecha</a>
    @include('elementosComunes.cierreBoton')

@endsection