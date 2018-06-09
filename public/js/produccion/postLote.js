
var PostLote= {

    init: function (url) {

        $('body').on('change','#selectLote',function(){
            let stock = $('option:selected', this).attr('name');
            $(this).parent('td').next().next().next().text(stock);
        });

        $("#guardar").click(function(e) {
            e.preventDefault();
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

            var lote=  [
                $('#producto').val(),
                $('#cantidad').val(),
                $('#fecha').val(),
                $('#tp').val(),
                $('#asignatura').val()
            ];




            
            $('<input type="hidden" name="lote" />').val(lote).appendTo('#myform');
            $('<input type="hidden" name="consumo" />').val(data).appendTo('#myform');
            $("#myform").submit();


        });
    }

};


     
