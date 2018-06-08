@extends('layouts.layoutPrincipal' )
@section('section') 
 
  <div class="menuPrincipal">
         <div class="contenedoropcion">
          <div class="flextitulo"><h4 class="titulo">Planificar</h4></div>
           <div class="flexboton"> 
           <form action="/planificacion" method="get">
               <button type="submit"><img src="img/menu/calendario2.png" height="110px" width="120px"></button>
           </form>
           </div>
         </div> 

         <div class="contenedoropcion">        
               <div class="flextitulo"> <h4 class="titulo">Cargar Producción</h4></div>
                <div class="flexboton"> 
               <form action="/produccion" method="get">
                 <button><img src="img/menu/factory2.png" height="110px" width="120px"></button>  
              </form>
            </div>
         </div>
         <div class="contenedoropcion">     
                <div class="flextitulo"><h4 class="titulo">Administración</h4></div>
                <div class="flexboton"> 
                 <form action="#" method="get">
                 <button><img src="img/menu/administracion2.png" height="110px" width="120px"></button>  
          </form>     
          <li>  <a href="/productos/administracionProductos" style="font-size: 20px; color: blue" >Productos</a></li>
            <li>  <a href="/productos/administracionInsumos" style="font-size: 20px; color: blue" >Insumos</a></li>  
         </div>
         </div>
    </div>
     <div class="menuPrincipal">
           <div class="contenedoropcion">
            <div class="flexboton"> 
                <div class="flextitulo">  <h4 class="titulo">Gestion de Stock</h4></div>
                 <form action="#" method="get">
                   <button><img src="img/menu/stock1.png" height="110px" width="120px"></button>  
               </form>
               </div>
               <li>  <a href="/stock/entradaLoteInsumo" style="font-size: 20px; color: blue" >Entrada de Insumo</a></li>
           </div>
           <div class="contenedoropcion">
            <div class="flexboton"> 
                <div class="flextitulo">  <h4 class="titulo">Informes</h4></div>
                 <form action="#" method="get">
                   <button><img src="img/menu/stock2.png" height="110px" width="120px"></button> 
             </form>
             </div>
             <li>  <a href="/stock" style="font-size: 20px; color: blue" >Informe de Stock</a></li>
            <li>  <a href="/sumarizacion" style="font-size: 20px; color: blue" >Ver Necesidad de Insumos</a></li> 
           </div>
           <div class="contenedoropcion">
             <div class="flexboton"> 
                <div class="flextitulo">  <h4 class="titulo">Estadísticas</h4></div>
                <form action="#" method="get">
                   <button><img src="img/menu/informes.png" height="110px" width="120px"></button>  
             </form>
           </div>
           </div>
      </div>
       @include('alertaStock')
@endsection  

