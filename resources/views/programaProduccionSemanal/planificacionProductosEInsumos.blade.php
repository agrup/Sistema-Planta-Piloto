@extends('layouts.layoutPrincipal' )
@section('section')
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <img  src="{{asset('img/modificar.png') }}" width="20" height="20" class="modificar" id="iHModificar" style="display: none; cursor: pointer">
    <img src="{{asset('img/borrar.png') }}" width="30" height="30" style="display: none; cursor: pointer" class="borrar" id="iHBorrar" hidden />
    <img src="{{asset('img/guardar.png') }}" width="30" height="30" style="display: none; cursor: pointer" class="guardar" id="iHGuardar" hidden />


    <?php
        $fecha= $planificaciones[0]['fecha'];
        setlocale(LC_TIME, 'spanish');
        Carbon\Carbon::setUtf8(true);

        $fechaC = Carbon\Carbon::createFromFormat('Y-m-d',$planificaciones[0]['fecha']);
        $fechaActual=$fechaC->formatLocalized('%A %d de %B de %Y');
    ?>
   


    @include('elementosComunes.aperturaTitulo')
        Planificación Productos e Insumos  
    @include('elementosComunes.cierreTitulo')

    @include('elementosComunes.aperturaTitulo')
    <h4 style="text-align: center">
    <b>Fecha Actual: {{ $fechaActual}}</b>
    <input type="hidden" id="fecha" value="{{$fecha}}">
    </h4>
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTitulo')
    <h4>
        Productos
    </h4>
    @include('elementosComunes.cierreTitulo')
    <div class="py-5"  >
        <div class="container">
            <div class="row">

                <div class="col-md-11">
                    <table class="table table-striped" id="tablaProd">
    <thead>
    <tr>
        <th>Código</th>
        <th>Producto</th>
        <th>Cantidad</th>       
        <th>Tipo Unidad</th>
        <th>Estado</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($planificaciones as $value)
        @if($value['fecha']==$fecha)
            @foreach($value["productos"] as $v)
                <?php
                $codigo[]=$v['codigo'];
                $nombre[]=$v['nombre'];
                $cantidad[]=$v['cantidad'];
                $tipoUnidad[]=$v['tipoUnidad'];
                $id[]=$v["movimiento_id"];
                $prodID[]=$v['id'];
                $estado[]=$v['estado'];
                $tp[]=$v['tipoTP'];
                ?>
            @endforeach
        @endif
    @endforeach
    <tr hidden>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td></tr>
    @if(isset($codigo))
        @foreach($codigo as $k=>$a)
            @if($estado[$k]=="pendiente")
                <tr data-tipo="pendiente">
                    {{--<td class="inte" hidden>{{$prodID[$k]}}</td>--}}
                    <td><span class="interes" hidden>{{$prodID[$k]}}</span><?=$codigo[$k];?></td>
                    <td><?=$nombre[$k];?></td>
                    <td><span class="interes"><?=$cantidad[$k];?></span></td>
                    <td><?=$tipoUnidad[$k];?></td>
                    <td> Pendiente </td>
                    <td>
                        <img  src="{{asset('img/modificar.png') }}" width="20" height="20" style="cursor: pointer;"  class="modificar" />
                    </td>
                    <td>
                        <img src="{{asset('img/borrar.png') }}" width="30" height="30" style="cursor: pointer;" class="borrar" />
                    </td>
                </tr>
            @elseif ($estado[$k]=="incumplida")
                <tr style="background-color: #ffb3b3" data-tipo="verga">
                    <td><?=$codigo[$k];?></td>
                    <td><?=$nombre[$k];?></td>
                    <td><?=$cantidad[$k];?></td>
                    <td><?=$tipoUnidad[$k];?></td>
                    <td> Incumplida </td>
                    <td></td>
                    <td></td>
                </tr>
            @else
                <tr style="background-color: lightgreen">
                    <td><?=$codigo[$k];?></td>
                    <td><?=$nombre[$k];?></td>
                    <td><?=$cantidad[$k];?></td>
                    <td><?=$tipoUnidad[$k];?></td>
                    <td> Cumplida </td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
        @endforeach
    @endif
    <tr>
        <td>
            <img src="{{asset('img/agregar.png') }}" width="30" height="30" style="cursor: pointer;"class="agregarProducto"/>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
    @include('elementosComunes.cierreTabla')
    @include('elementosComunes.aperturaTitulo')
    <h3>
        Llegada de Insumos
    </h3>
    @include('elementosComunes.cierreTitulo')
    <div class="py-5"  >
        <div class="container">
            <div class="row">

                <div class="col-md-11">
                    <table class="table table-striped" id="tablaIns">
    <thead>
    <tr>
        <th>Código</th>
        <th>Insumo</th>
        <th>Cantidad</th>
        <th>Tipo Unidad</th>
        <th>Estado</th>
        <th></th>
        <th></th>

    </tr>
    </thead>
    <tbody>
    <?php unset($codigo);unset($nombre);unset($cantidad);unset($estado);unset($tipoUnidad);unset($prodID)?>
    @foreach($planificaciones as $value)
        @if($value['fecha']==$fecha)
            @foreach($value["insumos"] as $v)
                <?php
                $codigo[]=$v['codigo'];
                $nombre[]=$v['nombre'];
                $cantidad[]=$v['cantidad'];
                $id[]=$v["movimiento_id"];
                $tipoUnidad[]=$v['tipoUnidad'];
                $estado[]=$v['estado'];
                $prodID[]=$v['id'];
                ?>
            @endforeach
        @endif
    @endforeach
    <tr hidden>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @if(isset($codigo))
        @foreach($codigo as $k=>$a)
             @if($estado[$k]=="pendiente")
                 <tr data-tipo="pendiente">
                     {{--<td>{{$prodID[$k]}}</td>--}}
                     <td><span hidden class="interesIns" >{{$prodID[$k]}}</span><?=$codigo[$k];?></td>
                     <td><?=$nombre[$k];?></td>
                     <td><span class="interesIns"><?=$cantidad[$k];?></span></td>
                     <td><?=$tipoUnidad[$k];?></td>
                     <td> Pendiente </td>
                     <td><img  src="{{asset('img/modificar.png') }}" width="20" height="20" style="cursor: pointer;"  class="modificar" /></td>
                     <td><img src="{{asset('img/borrar.png') }}" width="30" height="30" style="cursor: pointer;" class="borrar" /></td>
                 </tr>
            @elseif ($estado[$k]=="incumplida")
                 <tr style="background-color:#ffb3b3">
                     <td ><?=$codigo[$k];?></td>
                     <td ><?=$nombre[$k];?></td>
                     <td ><?=$cantidad[$k];?></td>
                     <td><?=$tipoUnidad[$k];?></td>
                     <td> Incumplida </td>
                     <td></td>
                     <td></td>
                 </tr>
            @else
                 <tr style="background-color: lightgreen">
                     <td ><?=$codigo[$k];?></td>
                     <td ><?=$nombre[$k];?></td>
                     <td ><?=$cantidad[$k];?></td>
                     <td ><?=$tipoUnidad[$k];?></td>
                     <td> Cumplida </td>
                     <td></td>
                     <td></td>
                 </tr>
            @endif
        @endforeach
    @endif
    <tr>
        <td>
            <img  src="{{asset('img/agregar.png') }}" width="30" height="30" style="cursor: pointer;" class="agregarInsumo" />
        </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
    </tr>
    </tbody>
    @include('elementosComunes.cierreTabla')
    <div id="imgmodificar">
    <img src="{{asset('img/modificar.png') }}" width="20" height="20" style="cursor: pointer;" hidden="true"  />
    </div>
     <div id="imgborrar">
    <img src="{{asset('img/borrar.png') }}" width="30" height="30" style="cursor: pointer;" hidden="true" />
    </div>
    <select id="selectProductos" >
        <option disabled="true" selected="true">--Selecc.Producto--</option>
    @foreach($productos as $producto)
        <option value='{{$producto['nombre']}}' data-codigo='{{$producto['codigo']}}' data-tu="{{$producto['tipoUnidad']}}" data-id="{{$producto['id']}}"> {{$producto['nombre']}} </option>
    @endforeach
    </select>

     <select id="selectInsumos" >
        <option disabled="true" selected="true">--Selecc.Insumos--</option>
    @foreach($insumos as $insumo)
        <option value='{{$insumo['nombre']}}' data-codigo='{{$insumo['codigo']}}' data-tu="{{$insumo['tipoUnidad']}}" data-id="{{$insumo['id']}}"> {{$insumo['nombre']}} </option>
    @endforeach
    </select>
    <form>
        @csrf
        <button class="btn btn-primary" id="btnguardar"> Guardar y Salir</button>
    </form>
    </body>
@endsection
@section('script')
{{--<script type="text/javascript" src="{{asset('js/planificacion/addPlanificacion.js')}}"></script>--}}
      {{--<script type="text/javascript" src="{{asset('js/planificacion/guardarPlanificacion.js')}}"></script>--}}
       {{--<script type="text/javascript" src="{{asset('js/planificacion/modificarPlanificacion.js')}}"></script>--}}
       {{--<script type="text/javascript" src="{{asset('js/planificacion/borrarPlanificacion.js')}}"></script>--}}
      {{-- <script type="text/javascript" src="{{asset('js/planificacion/postPlanificacion.js')}}"></script>--}}
       <script type="text/javascript" src="{{asset('js/planificacion/planificacion.js')}}"></script>


@endsection