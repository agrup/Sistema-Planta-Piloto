
        <link rel="icon" href="favicon.ico">

    <title>PP</title>



 <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="/" id="dropdown00"> Planta Piloto</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">

         <ul class="navbar-nav mr-auto">
     
    @if(Auth::user()->hasAnyRole(['administrador','jefeProduccion']))
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle"  id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt">Planificación</span></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="/planificacion">Productos y llegada de insumos</a>
              <a class="dropdown-item" href="#">Disponibilidad de trabajadores (a futuro)</a>
            </div>
      </li>
    @endif

         <li class="nav-item active">
            <a class="nav-link" href="/produccion"><span class="glyphicon glyphicon-compressed">Produccion</span> <span class="sr-only">(current)</span></a>
          </li>
@if(Auth::user()->hasAnyRole(['administrador','jefeProduccion']))
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle"  id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt">Administracion</span></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="/productos/administracionProductos">Productos</a>
              <a class="dropdown-item" href="/productos/administracionInsumos">Insumos</a>
            </div>
          </li>

@endif

           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle"  id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt">Gestion de Stock</span></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">

              <a class="dropdown-item" href="/stock/entradaLoteInsumo" id="dropdown05">Entrada de Insumo</a>
              <a class="dropdown-item" href="/stock/controlExistencias" id="dropdown05">Control de Existencias</a>
            </div>
          </li>
 
@if(Auth::user()->hasAnyRole(['administrador','jefeProduccion']))

            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle"  id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt">Informes</span></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="/stock">Stock</a>
               <a class="dropdown-item" href="/sumarizacion">Ver Necesidad de Insumos</a>
                <a class="dropdown-item" href="#">Informe de Producción (a futuro)</a>

            </div>
          </li>
@endif


           
           <a id="path" value="" href="" style="margin-left: 10px;margin-top: 5px;font-size: 15px;" disabled="true "></a>
           </ul>

           {{-- esto es para ver el path en el nav--}}
           <script type="text/javascript">
              locationObj = location.href;  //la URL del path
              nombre=location.pathname; //nombre del directorio
              $("#path").text(nombre);
             // $("#path").attr('href',locationObj);
            </script>

 @guest
             

                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>

                @else


                
                    <div class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"> </span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
              {{--register  @if(Auth::user()->hasAnyRole('administrador'))
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @endif--}}
                    @endguest 
            
 </nav>

      
 
