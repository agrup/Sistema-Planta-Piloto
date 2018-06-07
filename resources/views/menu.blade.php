@extends('layouts.layoutPrincipal' )
@section('section') 
 
  <div class="menuPrincipal">
         <div class="contenedoropcion">
           <form action="/planificacion" method="get">
                <h4 class="titulo">Planificación</h4>
               <button type="submit"><img src="img/menu/calendario2.png" height="110px" width="110px"></button>
           </form>
         </div> 

         <div class="contenedoropcion">
           <form action="/produccion" method="get">
                <h4 class="titulo">Producción</h4>
                 <button><img src="img/menu/factory2.png" height="110px" width="110px"></button>  
          </form>
         </div>
         <div class="contenedoropcion">
           <form action="/planificacion" method="get">
                <h4 class="titulo">Administración</h4>
                 <button><img src="img/menu/administracion2.png" height="110px" width="110px"></button>  
          </form>
         </div>
         </div>
     <div class="menuPrincipal">
           <div class="contenedoropcion">
             <form action="/planificacion" method="get">
                  <h4 class="titulo">Stock</h4>
                   <button><img src="img/menu/stock1.png" height="110px" width="110px"></button>  
               </form>
           </div>
           <div class="contenedoropcion">
             <form action="/planificacion" method="get">
                  <h4 class="titulo">Informes</h4>
                   <button><img src="img/menu/stock2.png" height="110px" width="110px"></button>  
             </form>
           </div>
           <div class="contenedoropcion">
             <form action="#" method="get">
                  <h4 class="titulo">Estadísticas</h4>
                   <button><img src="img/menu/informes.png" height="110px" width="110px"></button>  
             </form>
           </div>
      </div>

@endsection  