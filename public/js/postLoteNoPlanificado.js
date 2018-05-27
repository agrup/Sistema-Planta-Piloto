$(document).ready(function() {
   $("#guardar").click(function() {
         var url = "/produccion/loteNoPlanificado";
          $('#myform').attr({'action': url,'method': 'POST','header':{'Content-Type': 'application/json'}});

          //armo un JSON con los datos que voy a enviar

          var data = Array();
          $("tr").each(function(i, v){
                    data[i] = Array();
                    $(this).children('td').each(function(ii, vv){
                        
                        //alert(data);
                        if($(this).has(':input').length>0){

                         data[i][ii] =$(this).children('input[type=text]').val();
                          //  alert(data);
                        }
                        else{
                          data[i][ii] = $(this).text();
                         
                        }
                       // alert("ok");
                    }); 

                })
           var producto = JSON.stringify({
              "producto": $('#producto').val(),
              "cantidad":$('#cantidad').val(),
              "fecha":$('#fecha').val(),
              "tp":$('#tp').val(),
              "asignatura":$('#asignatura').val(),
              "consumo":JSON.stringify(data);
              
          })
         
         //var consumo=JSON.stringify(data);


          $('<input type="hidden" name="producto"/>').val(producto).appendTo('#myform');
         // $('<input type="hidden" name="consumo"/>').val(consumo).appendTo('#myform');
          $("#myform").submit();
          
    });
     
  });