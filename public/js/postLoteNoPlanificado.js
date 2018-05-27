$(document).ready(function() {
   $("#guardar").click(function() {
         var url = "/produccion/loteNoPlanificado";
          $('#myform').attr({'action': url,'method': 'POST','header':{'Content-Type': 'application/json'}});

          //armo un JSON con los datos que voy a enviar

          var data = Array();
          $("tr").each(function(i, v){
                    data[i] = Array();
                    var a=$(this).children('input[type=hidden]').attr("class");
                    alert(a);
                    if(a=="interes"){
                      alert("s")
                      data[i]=$(this).children('input[type=hidden]').val();
                     }

                    
                    //alert($(".interes").val());
                    if( a !="trhformulacion"){
                               
                      $(this).children('td').each(function(ii, vv){
                         // alert("s");
                         
                        /*  if($(this).has(':input').length>0){

                           data[i][ii] =$(this).children('input[type=text]').val();
                            //  alert(data);  
                          }
                          else {
                            data[i][ii] = $(this).text();
                           
                          }*/
                          data[i][ii] =$(".interes").val();
                         // alert("ok");
                    }); 
                  }
                })

          var producto=  [$('#producto').val(),$('#cantidad').val(),$('#fecha').val(),$('#tp').val(),$('#asignatura').val(),
          ];
          
           /*var producto = JSON.stringify({
              "producto": $('#producto').val(),
              "cantidad":$('#cantidad').val(),
              "fecha":$('#fecha').val(),data
              "tp":$('#tp').val(),
              "asignatura":$('#asignatura').val(),
              "consumo":JSON.stringify(data),
              
          });*/
         
         
        


          $('<input type="hidden" name="producto" />').val(producto).appendTo('#myform');
          $('<input type="hidden" name="consumo" />').val(data).appendTo('#myform');
        //  $("#myform").submit();
          
    });
     
  });