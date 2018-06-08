$(document).ready(function(){

            $("#btnguardar").click(function(event) {
                event.preventDefault();
                let fecha = $("#fecha").val();
                //armo los arreglos de productos e insumos planificados
                let productos = [];
                let insumos = [];

                //busco en cada tbody
                $('body').find('tbody').each(function (index) {
                    console.log('por cada tbody');
                    //si es el primero es productos
                    if (index === 0) {
                        console.log('index0');
                        $(this).find('tr').each(function (j, trr) {
                           if($(this).data('tipo')!=='pendiente'){
                               let codigoTd = $(this).first();
                               let codigo = codigoTd.text();
                               let cant = codigoTd.next().next().text();
                               if(codigo!=='' && cant!==''){
                                   productos.push([codigo,cant]);
                               }

                           }
                        })
                    }
                    //si es el segundo es insumos
                    if(index===1){
                        $(this).find('tr').each(function (j, trr) {
                            if($(this).data('tipo')!=='pendiente'){
                                let codigoTd = $(this).first();
                                console.log(codigoTd.text());
                                let codigo = codigoTd.text();
                                let cant = codigoTd.next().next().text();
                                if(codigo!=='' && cant!==''){
                                    insumos.push([codigo,cant]);
                                }
                            }
                        })
                    }
                });
                console.log(productos,insumos);

              /*$("table#ta").each(function(i, v){
               // if($(this).has('td.inte')=="true){
                  productos[i] = Array();
                  //var idTr = $(this).id;

                      $(this).find('.inte').each(function(ii, vv){
                          productos[i][ii] =$(this).text();
                          
                      });

               //   }
               
               });

              var insumos = Array();

              $("tr.trInsumo").each(function(i, v){
                insumos[i] = Array();
                //var idTr = $(this).id;    
                    $(this).find('.inte').each(function(ii, vv){
                        insumos[i][ii] =$(this).text();
                        
                    });
               
               });*/

              //mando los datos
               /* $.ajax({
                    url: "/planificacion/planificacionDia",
                    data:JSON.stringify({ fechaa: fecha , insumoss: insumos, productoss : productos }),
                    type: 'POST',
                    dataType : "json",
                    contentType: "application/json"
                    }).done(function (data){
                        alert('Planificacion Guardada Satisfactoriamente');
                        window.location.replace("/planificacion")
                        
                        }

                    );*/
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