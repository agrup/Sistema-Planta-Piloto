@extends('layouts.layoutPrincipal' )
@section('section')
    @include('elementosComunes.aperturaTitulo')
  
        Programa de Producción Semanal
    
    @include('elementosComunes.cierreTitulo')

    {{-- Flechas anterior y siguiente semana --}}
    <div class="py-5">
        <div class="container">
            <div class="row">
                <form action="calendarioAnt" method="GET" enctype="multipart/form-data" class="col-md-11"> {{csrf_field()}}
                    <input   type="hidden" name="fecha" value="{{$planificaciones[0]['fecha']}}">
                    <input type="submit" class="btn btn-primary"  value="<<">
                </form>
                <form action="calendarioSig" method="GET" enctype="multipart/form-data"  class="col-md-1">
                    {{csrf_field()}}
                    <input  type="hidden" name="fecha" value="{{$planificaciones[0]['fecha']}}">
                    <input type="submit" class="btn btn-primary" value=">>">
                </form>
            </div>
        </div>
    </div>
    {{--  Input y boton para ir a una semana específica  --}}
    <div class="py-5">
        <div class="container">
            <div class="row">
                <form action="planificacion" method="POST" enctype="multipart/form-data"  class="col-md-5">
                    {{csrf_field()}}
                    <input class="inputchiquito"  type="date" name="fecha" value="{{$planificaciones[0]['fecha']}}" >
                    <input  class="btn btn-secondary"  type="submit" value="Ir a semana">
                </form>
            </div>
        </div>
    </div>
    {{-- Tabla de contenidos, el form es para los botones de cada dia --}}
    <form action="/planificacion/planificacionDia" method="get" enctype="multipart/form-data">
        {{csrf_field()}}
    @include('elementosComunes.aperturaTabla')
        {{-- Header de la tabla --}}
    <thead>
    <tr>
        <th>
            <b>Producción</b>
        </th>
        {{--  Botones de cada dia --}}
        @foreach($planificaciones as $planificacion)
                <th> <input type="submit" class="btn btn-primary" name="fecha" value={{date('d-m-Y',strtotime($planificacion["fecha"]))}}></th>
        @endforeach
    </tr>
    {{-- fila de los titulos de los dias: Lunes - Martes, etc --}}
    <tr>
        <th class="diassemana"></th>
        @foreach($planificaciones as $planificacion )
            <th class="diassemana">{{$planificacion["diaSemana"]}}</th>
        @endforeach
    </tr>
    </thead>
    {{--  Cuerpo de la tabla  --}}
    <tbody>
    {{-- Busco la planificacion con mas productos y guardo la cantidad en $trNumber --}}
    @php
        $trNumber=0;
        foreach($planificaciones as  $planificacion){
            $numberAux = count($planificacion['productos']);
            if($numberAux > $trNumber){
                $trNumber = $numberAux;
            }
        }
    @endphp

    {{--  Imprimo la cantidad de rows y lleno los td si existe el i-esimo producto para cada planificacion --}}
    @for($i=0;$i<$trNumber ; $i++)
        <tr>
            <td>{{ ($i+1) }} </td>
            @foreach($planificaciones as $planificacion)
                <td>
                @if( isset($planificacion['productos'][$i]))
                    {{$planificacion['productos'][$i]['nombre'] }}
                @endif
                </td>
            @endforeach
        </tr>
    @endfor
    </tbody>

    {{--  Tabla de los Insumos --}}
    <thead>
    <th>
        <b>Llegada de Insumos</b>
    </th>
    @foreach($planificaciones as $planificacion )
        <th></th>
    @endforeach
    </thead>
    {{-- Busco la planificacion con mas insumos y guardo la cantidad en $trNumber --}}
    <?php
    $trNumber=0;
    foreach ($planificaciones as $planificacion){
        $numberAux = count($planificacion['insumos']);
        if($numberAux > $trNumber){
            $trNumber = $numberAux;
        }
    }
    ?>
    <tbody>
    {{-- Por Cada planificacion imprimo las td necesarias y si existe el i-esimo insumo imprimo su nombre en la td--}}
    @for($i=0;$i<$trNumber ; $i++)
        <tr>
            <td>{{$i+1}}</td>
            @foreach($planificaciones as $planificacion)
            <td>
                @if(isset($planificacion['insumos'][$i]))
                {{ $planificacion['insumos'][$i]['nombre'] }}
                @endif
            </td>
            @endforeach
        </tr>
    @endfor
    </tbody>
    {{-- Tabla de trabajadores --}}
    {{-- Busco la planificacion con mas trabajadores y guardo la cantidad en $trNumber --}}
    <?php
    $trNumber=0;
    foreach ($planificaciones as $planificacion){
        $numberAux = count($planificacion['trabajadores']);
        if($numberAux > $trNumber){
            $trNumber = $numberAux;
        }
    }
    ?>
    @if($trNumber >0) {{-- Imprimo la tabla de trabajadores solo si hay--}}
        <thead>
        <tr>
            <th>
                <b>Trabajadores</b>
            </th>
            @foreach($planificaciones as $value )
                <th> </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @for($i=0;$i<$trNumber ; $i++)
            <tr>
                <td>{{ $i+1 }}</td>
                @foreach($planificaciones as $planificacion)
                    <td>
                        @if(isset($planificacion['trabajadores'][$i]))
                            {{ $planificacion['trabajadores'][$i]}}
                        @endif
                    </td>
                @endforeach
            </tr>
        @endfor
        </tbody>
    @endif {{--// endif si hay trabajadores en alguna planificacion--}}
    @include('elementosComunes.cierreTabla')
    </form>

    {{-- Necesidad De insumos --}}
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="">Fecha Hasta</h4  >
                </div>
            </div>
            <div class="py-5">
                <div class="container">
                    <div class="row">
                        <form action="sumarizacion" method="get" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="date" name='fecha' value="{{$planificaciones[4]["fecha"]}}" class="form-control">
                            <input type="submit" value="Ver necesidad de Insumos" class="btn btn-primary" required>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
