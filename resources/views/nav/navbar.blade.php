
        <link rel="icon" href="favicon.ico">

    <title>PP</title>



 <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="/" id="dropdown00"> Planta Piloto</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
         
		
			  <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle"  id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt">Planificación</span></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="/planificacion">Productos y llegada de insumos</a>
              <a class="dropdown-item" href="#">Disponibilidad de trabajadores</a>
            </div>
          </li>

         <li class="nav-item active">
            <a class="nav-link" href="/produccion"><span class="glyphicon glyphicon-compressed">Produccion</span> <span class="sr-only">(current)</span></a>
          </li>


            @guest
                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
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
                    </li>
                    @endguest

        </ul>

      </div>
      <?php $url= url()->current(); 
  $url=str_replace("http://127.0.0.1:8000","Home",$url);
  $arregloNav=explode("/",$url);
  ?>
    @foreach( $arregloNav as $nav )
    <a href="#" data-place="home" id="home" class="navbar-brand" >->{{$nav}}</a>
   
    @endforeach
    </nav>
