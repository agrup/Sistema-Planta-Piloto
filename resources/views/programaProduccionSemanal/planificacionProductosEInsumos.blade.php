@extends('layouts.layoutPrincipal' )
@section('section')
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <img  src="{{asset('img/modificar.png') }}" width="20" height="20" class="modificar" id="iHModificar" style="display: none; cursor: pointer">
    <img src="{{asset('img/borrar.png') }}" width="30" height="30" style="display: none; cursor: pointer" class="borrar" id="iHBorrar" hidden />
    <img src="{{asset('img/guardar.png') }}" width="30" height="30" style="display: none; cursor: pointer" class="guardar" id="iHGuardar" hidden />

    
    <?php $fecha=$planificaciones[0]['fecha'];?>

    @include('elementosComunes.aperturaTitulo')

        Planificación Productos e Insumos
    
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTitulo')
    <h4 style="text-align: center">
    <b>Fecha Actual: <?= date("d-m-Y",strtotime($fecha)); ?></b>
    <input type="hidden" id="fecha" value="{{$fecha}}">
    </h4>
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTitulo')
    <h4>
        Productos
    </h4>
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTabla')
    <thead>
    <tr>
        <th>Código</th>
        <th>Producto</th>
        <th>Cantidad</th>       
        <th>Tipo Unidad</th>
        <th>TP</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody class="tbodyPlanif">
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
    <tr hidden></tr>
    @if(isset($codigo))
        @foreach($codigo as $k=>$a)

            <tr id="{{$k}}" class="trProducto">
             
                @if($estado[$k]=="pendiente")
                    <td class="inte" hidden>{{$prodID[$k]}}</td>
                    <td id="codigo"><?=$codigo[$k];?></td>
                    <td id="nombre"><?=$nombre[$k];?></td>
                    <td class="inte" id="cantidad"><?=$cantidad[$k];?></td>
                    <td id="tu"><?=$tipoUnidad[$k];?></td>
                                                    
                    @if ($tp[$k]==false)
                        <td class="inte" id="tp">No</td>
                    @else
                        <td class="inte" id="tp">Si</td>
                    @endif
                    <td><img  src="{{asset('img/modificar.png') }}" width="20" height="20" style="cursor: pointer;"  class="modificar" /></td>
                    <td><img src="{{asset('img/borrar.png') }}" width="30" height="30" style="cursor: pointer;" class="borrar" /></td>
                @elseif ($estado[$k]=="incumplida")
                   <td id="codigo"><?=$codigo[$k];?></td>
                   <td id="nombre"><?=$nombre[$k];?></td>
                   <td id="cantidad"><?=$cantidad[$k];?></td>
                   <td><?=$tipoUnidad[$k];?></td>
                    <td ><?=$tp[$k];?></td>
                   <td></td> 
                   <script type="text/javascript">
                      $('#'+'{{$k}}').css("background-color","#ffb3b3")
                   </script>
                   <td></td>
                   <td></td> 
                @else
                   <td  id="codigo"><?=$codigo[$k];?></td>
                    <td id="nombre"><?=$nombre[$k];?></td>
                    <td id="cantidad"><?=$cantidad[$k];?></td>
                    <td  id="tu"><?=$tipoUnidad[$k];?></td>
                     <td ><?=$tp[$k];?></td>
                    <td></td>
                   <script type="text/javascript">
                      $('#'+'{{$k}}').css("background-color","lightgreen")
                   </script>
                   <td></td>
                   <td></td> 
                @endif
            </tr>
        @endforeach
        
    @endif
    {{--<tr class="trProducto"> </tr>--}}
     <tr><td><img src="{{asset('img/agregar.png') }}" width="30" height="30" style="cursor: pointer;"class="agregarProducto"/></td></tr>
    </tbody>
    @include('elementosComunes.cierreTabla')
    @include('elementosComunes.aperturaTitulo')
    <h3>
        Llegada de Insumos
    </h3>
    @include('elementosComunes.cierreTitulo')
    @include('elementosComunes.aperturaTabla')
    <thead>
    <tr>
        <th>Código</th>
        <th>Insumo</th>
        <th>Cantidad</th>
        <th>Tipo Unidad</th>
        <th></th>
        <th></th>

    </tr>
    <tr></tr>
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
    <tr hidden></tr>
    @if(isset($codigo))
        @foreach($codigo as $k=>$a)

            <tr id="insumo{{$k}}" class="trInsumo">

              
               
                 @if($estado[$k]=="pendiente")
                     <td hidden class="inte">{{$prodID[$k]}}</td>
                     <td ><?=$codigo[$k];?></td>
                    <td ><?=$nombre[$k];?></td>
                    <td class="inte"><?=$cantidad[$k];?></td>
                    <td id="tu"><?=$tipoUnidad[$k];?></td>
                    <td><img  src="{{asset('img/modificar.png') }}" width="20" height="20" style="cursor: pointer;"  class="modificar" /></td>
                    <td><img src="{{asset('img/borrar.png') }}" width="30" height="30" style="cursor: pointer;" class="borrar" /></td>
                @elseif ($estado[$k]=="incumplida")
                      <td ><?=$codigo[$k];?></td>
                    <td ><?=$nombre[$k];?></td>
                    <td ><?=$cantidad[$k];?></td>
                    <td><?=$tipoUnidad[$k];?></td>
                   <script type="text/javascript"> 
                    
                      $('#insumo'+'{{$k}}').css("background-color","#ffb3b3");
                   </script>
                   <td></td>
                   <td></td> 
                @else
                    <td ><?=$codigo[$k];?></td>
                    <td ><?=$nombre[$k];?></td>
                    <td ><?=$cantidad[$k];?></td>
                    <td ><?=$tipoUnidad[$k];?></td>
                   <script type="text/javascript">

                      $('#insumo'+'{{$k}}').css("background-color","lightgreen");
                   </script>
                   <td></td>
                   <td></td> 
                @endif
            </tr>

        @endforeach

    @endif
    <tr>
        <td>
            <img  src="{{asset('img/agregar.png') }}" width="30" height="30" style="cursor: pointer;" class="agregarInsumo" />
        </td>
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
     <select id="selecttp" >
        <option>NO</option>
         <option>SI</option>
    </select>  
    <form>
        @csrf
        <button class="btn btn-primary" id="btnguardar"> Guardar y Salir</button>
    </form>
    </body>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('js/planificacion/addPlanificacion.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/planificacion/guardarPlanificacion.js')}}"></script>
       <script type="text/javascript" src="{{asset('js/planificacion/modificarPlanificacion.js')}}"></script>
       <script type="text/javascript" src="{{asset('js/planificacion/borrarPlanificacion.js')}}"></script>
       <script type="text/javascript" src="{{asset('js/planificacion/postPlanificacion.js')}}"></script>
@endsection