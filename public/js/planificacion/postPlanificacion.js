
var PostPlanificacion= {

    init: function (url) {
        $("#guardar").click(function() {
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

            
            $('<input type="hidden" name="lote" />').val(lote).appendTo('#myform');
           
            $("#myform").submit();


        });
    }

};
