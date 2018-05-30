$(document).ready(function() {
   $("#guardar").click(function() {
         var url = "/produccion/loteNoPlanificado";
          $('#myform').attr({'action': url,'method': 'POST','header':{'Content-Type': 'application/json'}});

          //armo un JSON con los datos que voy a enviar

          var data = Array();
          $("tr.trConsumo").each(function(i, v){
                    data[i] = Array();
                    var idTr = $(this).id;
                    if(idTr !== "trhformulacion"){
                        $(this).find('.interes').each(function(ii, vv){

                           data[i][ii] =$(this).val();
                    }); 
                  }
                });

          var producto=  [
              $('#producto').val(),
              $('#cantidad').val(),
              $('#fecha').val(),
              $('#tp').val(),
              $('#asignatura').val()
          ];
          
           /*var producto = JSON.stringify({
              "producto": $('#producto').val(),
              "cantidad":$('#cantidad').val(),
              "fecha":$('#fecha').val(),data
              "tp":$('#tp').val(),

              "asignatura":$('#asignatura').val(),
              "consumo":JSON.stringify(data)
              
          });*/
         




          $('<input type="hidden" name="producto" />').val(producto).appendTo('#myform');
          $('<input type="hidden" name="consumo" />').val(data).appendTo('#myform');
        //  $("#myform").submit();

          
    });
     
  });