$(document).ready(function(){

            $("#btnguardar").click(function(event){
                event.preventDefault();
             //armo los arreglos de productos e insumos planificados   
              var productos = Array();
              var fecha=$("#fecha").val();
              console.log(fecha);
              $("tr.trProducto").each(function(i, v){
                productos[i] = Array();
                //var idTr = $(this).id;    
                    $(this).find('.inte').each(function(ii, vv){
                        productos[i][ii] =$(this).text();
                        
                    });
               
               });

              var insumos = Array();

              $("tr.trInsumo").each(function(i, v){
                insumos[i] = Array();
                //var idTr = $(this).id;    
                    $(this).find('.inte').each(function(ii, vv){
                        insumos[i][ii] =$(this).text();
                        
                    });
               
               });

              //mando los datos
                $.ajax({ 
                    url: "/planificacion/planificacionDia",
                    data:JSON.stringify({ fechaa: fecha , insumoss: insumos, productoss : productos }),
                    type: 'POST',
                    dataType : "json",
                    contentType: "application/json"
                    }).done(function (data){
                        console.log(data)
                        }

                    );
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