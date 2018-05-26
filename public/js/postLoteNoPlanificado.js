$(document).ready(function() {
   $("#guardar").click(function() {
          var url = "/produccion/loteNoPlanificado";
          $('#myform').attr({'action': url,'method': 'POST'});

          //armo un JSON con los datos que voy a enviar
          var data = JSON.stringify({
              "producto": $('#producto').val(),
              "cantidad":$('#cantidad').val(),
              "fecha":$('#fecha').val(),
              "tp":$('#tp').val(),
              "asignatura":$('#asignatura').val(),
              "consumo":["id":$('#idInsumo').val(),"lote":$('#lote'),"cantidad":$('#cantidad')]
          })
          $('<input type="hidden" name="json"/>').val(data).appendTo('#myform');
          $("#myform").submit();
    });
     
  });