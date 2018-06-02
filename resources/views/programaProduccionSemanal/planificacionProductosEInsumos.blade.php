@extends('layouts.layoutPrincipal' )
@section('section')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
                $cantidad[]=$v['cantidad'].$v['tipoUnidad'];
                $id[]=$v["movimiento_id"];
                $estado[]=$v['estado'];
                $tp[]=$v['tipoTP'];
                ?>
            @endforeach
        @endif
    @endforeach
    @if(isset($codigo))
        @foreach($codigo as $k=>$a)

            <tr id="{{$k}}" class="trProducto">

                @if($estado[$k]=="pendiente")

                    <td class="inte" id="codigo"><?=$codigo[$k];?></td>
                    <td class="inte" id="nombre"><?=$nombre[$k];?></td>
                    <td class="inte" id="cantidad"><?=$cantidad[$k];?></td>
                    <td class="inte" id="tp"><?=$tp[$k];?></td>
                    <td><img  src="{{asset('img/modificar.png') }}" width="20" height="20" style="cursor: pointer;"  class="modificar" /></td>
                    <td><img src="{{asset('img/borrar.png') }}" width="30" height="30" style="cursor: pointer;" class="borrar" /></td>
                @elseif ($estado[$k]=="incumplida")
                   <td id="codigo"><?=$codigo[$k];?></td>
                   <td id="nombre"><?=$nombre[$k];?></td>
                   <td id="cantidad"><?=$cantidad[$k];?></td>
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
    <tr class="nuevaLineaProducto"> </tr>
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
        <th></th>
        <th></th>

    </tr>
    <tr></tr>
    </thead>
    <tbody>
    <?php unset($codigo);unset($nombre);unset($cantidad);unset($estado);?>
    @foreach($planificaciones as $value)
        @if($value['fecha']==$fecha)
            @foreach($value["insumos"] as $v)
                <?php
                $codigo[]=$v['codigo'];
                $nombre[]=$v['nombre'];
                $cantidad[]=$v['cantidad'].$v['tipoUnidad'];
                $id[]=$v["movimiento_id"];
                $estado[]=$v['estado'];
                ?>
            @endforeach
        @endif
    @endforeach
    @if(isset($codigo))
        @foreach($codigo as $k=>$a)

            <tr id="insumo{{$k}}" class="trInsumo">

                <td class="inte"><?=$codigo[$k];?></td>
                <td class="inte"><?=$nombre[$k];?></td>
                <td class="inte"><?=$cantidad[$k];?></td>
               
                 @if($estado[$k]=="pendiente")
                    <td><img  src="{{asset('img/modificar.png') }}" width="20" height="20" style="cursor: pointer;"  class="modificar" /></td>
                    <td><img src="{{asset('img/borrar.png') }}" width="30" height="30" style="cursor: pointer;" class="borrar" /></td>
                @elseif ($estado[$k]=="incumplida")

                   <script type="text/javascript"> 
                    
                      $('#insumo'+'{{$k}}').css("background-color","#ffb3b3");
                   </script>
                   <td></td>
                   <td></td> 
                @else

                   <script type="text/javascript">

                      $('#insumo'+'{{$k}}').css("background-color","lightgreen");
                   </script>
                   <td></td>
                   <td></td> 
                @endif
            </tr>

        @endforeach

    @endif
    <tr><td><img  src="{{asset('img/agregar.png') }}" width="30" height="30" style="cursor: pointer;" class="agregarInsumo" /></td></tr>
     <tr class="nuevaLineaInsumo">
           
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
        <option value='{{$producto['nombre']}}' data-codigo='{{$producto['codigo']}}'> {{$producto['nombre']}} </option>
    @endforeach
    </select>

     <select id="selectInsumos" >
        <option disabled="true" selected="true">--Selecc.Insumos--</option>
    @foreach($insumos as $insumo)
        <option value='{{$insumo['nombre']}}' data-codigo='{{$insumo['codigo']}}'> {{$insumo['nombre']}} </option>
    @endforeach
    </select>


    <form>
        @csrf
        <button class="btn btn-primary" id="btnguardar"> Guardar </button>
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