@extends('layouts.layoutPrincipal' )
@section('section')

<body>
  <?php $fecha=$planificaciones[0]['fecha'];?>
  
@include('elementosComunes.aperturaTitulo')
          <h1 class="display-4">
            <b>Planificación Productos e Insumos</b>
          </h1>
  @include('elementosComunes.cierreTitulo')
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p class="lead">
            <b><?= $fecha; ?> </b>
          </p>
        </div>
      </div>
    </div>
  </div>
   @include('elementosComunes.aperturaTabla')
            <thead>
             <tr>
              <th>Código</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>TP</th>
             </tr>
            </thead>
            <tbody>
              @foreach($planificaciones as $value)
                @if($value['fecha']==$fecha)       
                   @foreach($value["productos"] as $v)
                    <?php     
                    $codigo[]=$v['codigo'];
                    $nombre[]=$v['nombre'];
                    $cantidad[]=$v['cantidad'].$v['tipoUnidad']; 
                            
                    ?>
                  @endforeach
                @endif
              @endforeach
            @if(isset($codigo)) 
              @foreach($codigo as $k=>$a)
                
              <tr>
                
                <td><?=$codigo[$k];?></td>
                <td><?=$nombre[$k];?></td>
                <td><?=$cantidad[$k];?></td>
              </tr>
              @endforeach
            @endif
            
            </tbody>
     @include('elementosComunes.cierreTabla')
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p class="lead">Llegada de Insumos</p>
        </div>
      </div>
    </div>
  </div>
 @include('elementosComunes.aperturaTabla')
            <thead>
              <tr>
                <th>Código</th>
                <th>Insumo</th>
                <th>Cantidad</th>
              </tr>
              <tr></tr>
            </thead>
            <tbody>
                <?php unset($codigo);unset($nombre);unset($cantidad);?>
               @foreach($planificaciones as $value)
                @if($value['fecha']==$fecha)       
                   @foreach($value["insumos"] as $v)
                    <?php     
                    $codigo[]=$v['codigo'];
                    $nombre[]=$v['nombre'];
                    $cantidad[]=$v['cantidad'].$v['tipoUnidad']; 
                            
                    ?>
                  @endforeach
                @endif
              @endforeach
            @if(isset($codigo)) 
              @foreach($codigo as $k=>$a)
                
              <tr>
                
                <td><?=$codigo[$k];?></td>
                <td><?=$nombre[$k];?></td>
                <td><?=$cantidad[$k];?></td>
              </tr>
              @endforeach
           @endif
            </tbody>
  @include('elementosComunes.cierreTabla')


</body>
@endsection 