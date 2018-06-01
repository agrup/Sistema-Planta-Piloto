$(document).ready(function(){

            $("#btnguardar").click(function(){
             //armo los arreglos de productos e insumos planificados   
              var productos = Array();
              var fecha=$("#fecha");
              $("tr.trProducto").each(function(i, v){
                productos[i] = Array();
                //var idTr = $(this).id;    
                    $(this).find('.inte').each(function(ii, vv){
                        productos[i][ii] =$(this).text();
                        
                    });
               
               });
              console.log(productos);
              var insumos = Array();

              $("tr.trInsumo").each(function(i, v){
                insumos[i] = Array();
                //var idTr = $(this).id;    
                    $(this).find('.inte').each(function(ii, vv){
                        insumos[i][ii] =$(this).text();
                        
                    });
               
               });
              console.log(insumos);

              //mando los datos
                $.ajax({ 
                    url: '/planificacion/planificacionDia',
                    type: 'post',
                    data:  {fecha,productos,insumos},
                    success: function(result)
                        {
                            alert("se mando!");
                        }
                    });
            });

});


//$('.modal-box').text(result).fadeIn(700, function() 
/*{
 setTimeout(function() 
 {
 $('.modal-box').fadeOut();
  }, 2000);
    });
  }*/