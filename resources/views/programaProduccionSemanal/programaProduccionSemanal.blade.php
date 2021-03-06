@extends('layouts.layoutPrincipal' )
@section('section')
    @include('elementosComunes.aperturaTitulo')
       Planificación Semanal   
    @include('elementosComunes.cierreTitulo')
    
    {{--  Input y boton para ir a una semana específica  --}}
    <div class="rowFlex">
        <div class="flechita">
            <form action="calendarioAnt" method="GET" enctype="multipart/form-data" > {{csrf_field()}}
                <input   type="hidden" name="fecha" value="{{$planificaciones[0]['fecha']}}">
                <input type="submit" class="btn btn-primary"  value="<<">
            </form>
        </div>
        <div class="inputFecha">
            <form action="planificacion" method="POST" enctype="multipart/form-data"  >
                {{csrf_field()}}
                <input  type="date" name="fecha" value="{{$planificaciones[0]['fecha']}}" >
                <input  class="btn btn-secondary"  type="submit" value="Ir a semana">
            </form> 
        </div>
        <div  class="inputFecha"> 
               <form action="planificacion/verificar/{{$planificaciones[4]['fecha']}}" method="GET" enctype="multipart/form-data"  >
                {{csrf_field()}}
                <input  type="date" name="fecha" value="{{$planificaciones[4]['fecha']}}" hidden="true">
                <input  class="btn btn-secondary"  type="submit" value="Verificar semana">
            </form>  
        </div>
        <div class="flechita">
            <form action="calendarioSig" method="GET" enctype="multipart/form-data"  >
                {{csrf_field()}}
                <input  type="hidden" name="fecha" value="{{$planificaciones[0]['fecha']}}">
                <input type="submit" class="btn btn-primary" value=">>">
            </form>
        </div>
    </div>

    <!-- <form action="planificacion" method="POST" enctype="multipart/form-data"  class="form-horizontal">
        {{csrf_field()}}
        <div class="form-group">
            <input class="col-sm-2 control-label"  type="date" name="fecha" value="{{$planificaciones[0]['fecha']}}" >
            <input  class="btn btn-secondary"  type="submit" value="Ir a semana">
        </div>
    </form> -->

    {{-- Flechas anterior y siguiente semana --}}
    <!-- <div class="py-5">
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
    </div> -->

    {{-- Tabla de contenidos, el form es para los botones de cada dia --}}
    <form action="/planificacion/planificacionDia" method="get" enctype="multipart/form-data">
        {{csrf_field()}}
    @include('elementosComunes.aperturaTabla')
        {{-- Header de la tabla --}}
    <thead>
    <tr>
        <th>
        </th>
        {{--  Botones de cada dia --}}
        @foreach($planificaciones as $planificacion)
                <th> <input type="submit" class="btn btn-primary" name="fecha" value={{date('d-m-Y',strtotime($planificacion["fecha"]))}}></th>
        @endforeach
    </tr>
    {{-- fila de los titulos de los dias: Lunes - Martes, etc --}}
    <tr>
        <th ><b>Producción</b></th>
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
                    <span title="{{$planificacion['productos'][$i]['cantidad']}} {{ $planificacion['productos'][$i]['tipoUnidad']}}">{{$planificacion['productos'][$i]['nombre'] }}</span>
                @endif
                </td>
            @endforeach
        </tr>
    @endfor
    </tbody>
      @include('elementosComunes.cierreTabla')
   
 @include('elementosComunes.aperturaTabla')
    {{--  Tabla de los Insumos --}}
    <thead>
       <tr>
        <th >
            <span style="color: #e9ecef">--</span><b>Insumos</b><span style="color: #e9ecef">--</span>
        </th>
        {{--  Botones de cada dia --}}
        @foreach($planificaciones as $planificacion)
                <th class="diassemana"> {{$planificacion['diaSemana']}}</th>
        @endforeach
    </tr>
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
                    <span title="{{$planificacion['insumos'][$i]['cantidad']}} {{ $planificacion['insumos'][$i]['tipoUnidad']}}"> {{ $planificacion['insumos'][$i]['nombre'] }} </span>
                @endif
            </td>
            @endforeach
        </tr>
    @endfor
    </tbody>

       

        @include('elementosComunes.cierreTabla')
 

    </form>
    <div>
             <form action="/" method="get">
                 <button  class="btn btn-secondary" >Volver al Menú</button>  
             </form>
         </div>


@endsection

