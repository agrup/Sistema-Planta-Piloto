$(document).ready(function() {

    $("#selectProductos").hide();
    $("#selectInsumos").hide();
    // ==== DATATABLES ====
   var tablaProd = $('table#tablaProd').DataTable({
        "bPaginate": false,
        //"bLengthChange": false,
        "bFilter": false,
        "bSort" : false,
        "bInfo": false,
        // "bAutoWidth": true,
        "scrollY":        "9.5rem",
        "scrollCollapse": true,
        "oLanguage": {"sZeroRecords": "", "sEmptyTable": ""},
        "columnDefs": [
        { "width": "16%", "targets": 0 }
        ],
       "columns": [
           {"data":"codigo"},
           {"data":"producto"},
           {"data":"cantidad"},
           {"data":"tipoUnidad"},
           {"data":"estado"},
           {"data":"editarTick"},
           {"data":"borrar"},
       ],
    });

   var tablaIns = $('table#tablaIns').DataTable({
       "bPaginate": false,
       //"bLengthChange": false,
       "bFilter": false,
       "bSort" : false,
       "bInfo": false,
       // "bAutoWidth": true,
       "scrollY":        "9.5rem",
       "scrollCollapse": true,
       "oLanguage": {"sZeroRecords": "", "sEmptyTable": ""},
       "columnDefs": [
           { "width": "16%", "targets": 0 }
       ],
       "columns": [
           {"data":"codigo"},
           {"data":"producto"},
           {"data":"cantidad"},
           {"data":"tipoUnidad"},
           {"data":"estado"},
           {"data":"editarTick"},
           {"data":"borrar"},
       ],
   });

    // ==== BOTONES AGREGAR FILA ====
    /*
        * Funcion que crea una fila, recibe el obj jQuery para poder ubicar la tabla,
        * y un parametro string que puede ser 'producto' o 'insumo', utilizado para decidir
        * que select utilizar
        * */
    function crearFila(jqbutton, inspro){
        //creo los td
        //let tdHiddenID=document.createElement('td');
        let tdCod = document.createElement("td");
        let tdProd = document.createElement("td");
        let tdCant = document.createElement("td");
        let tdTipoUnidad = document.createElement("td");
        let tdEstado = document.createElement('td');
        let tdImgGuardar = document.createElement("td");
        let tdImgborrar = document.createElement("td");

        //Le agrego un input al td de cantidad
        $("<input>").attr({type:'text',class:'inputCant'}).appendTo(tdCant);
        //Imagen de guardar
        let guardar = document.createElement('img');
        guardar.src=$('img#iHGuardar').attr('src');
        guardar.setAttribute('width','30px');
        guardar.setAttribute('height','30px');
        //select
        let select;
        //si es producto copio el select de productos, sino el de insumos
        if(inspro == 'producto'){
            select = $("#selectProductos").clone().appendTo(tdProd);
            select.addClass('selectI');
            select.show();
            guardar.setAttribute('class','guardar');
            tdImgGuardar.appendChild(guardar);
        }else{
            select=$("#selectInsumos").clone().appendTo(tdProd);
            select.addClass('selectIns');
            select.show();
            guardar.setAttribute('class','guardarIns');
            tdImgGuardar.appendChild(guardar);
        }



        //Estado pendiente
        tdEstado.innerHTML ='Pendiente';
        //Creo la siguiente row y le agrego los td
        let newRow = document.createElement('tr');
        //La agrego en la ante-ultima row porque la ultima es la del boton agregar
        jqbutton.closest('table').find('tr:last').prev().after(newRow);
        //Agrego todos los td
        newRow.append(tdCod,tdProd,tdCant,tdTipoUnidad,tdEstado,tdImgGuardar,tdImgborrar);
    }

    $(".agregarProducto").click(function(){
        crearFila($(this),'producto')
    });
    $(".agregarInsumo").click(function(){
        crearFila($(this),'insumo')
    });

    //cuando seleccion el producto/insumo pongo automaticamente el id, codigo y tu
    $("body").on('change','select.selectI',function(){
        //guardo id, codigo y tipo unidad guardados en data del select
        let id = $('option:selected', this).data('id');
        let codigo=$('option:selected', this).data('codigo');
        let tipoUnidad=$('option:selected',this).data('tu');

        //actualizo los valores de los td correspondientes
        //$(this).parent('td').prev('td').prev('td').text(id);
        let str = '<span hidden class=\"interes\">'+id/*+'<\span>'*/ ;
        let strCodigo = codigo;
        //console.log(str.concat(strCodigo));
        $(this).parent('td').prev('td').html(strCodigo.concat(str));
        //$(this).parent('td').prev('td').text(codigo);
        $(this).parent('td').next().next().text(tipoUnidad);
    });

    $("body").on('change','select.selectIns',function(){
        //guardo id, codigo y tipo unidad guardados en data del select
        let id = $('option:selected', this).data('id');
        let codigo=$('option:selected', this).data('codigo');
        let tipoUnidad=$('option:selected',this).data('tu');

        //actualizo los valores de los td correspondientes
        //$(this).parent('td').prev('td').prev('td').text(id);
        let str = '<span hidden class=\"interesIns\">'+id/*+'<\span>'*/ ;
        let strCodigo = codigo;
        //console.log(str.concat(strCodigo));
        $(this).parent('td').prev('td').html(strCodigo.concat(str));
        //$(this).parent('td').prev('td').text(codigo);
        $(this).parent('td').next().next().text(tipoUnidad);
    });

    // ==== BOTON TICK DE LA FILA CREADA ====
    $('body').on('click','.guardar',function(){
        let tr = $(this).closest('tr');
        let thisTd = $(this).closest('td');
        //convierto a texto el select de producto y la cantidad
        tr.each(function(){
            $(this).find('input').each(function(){
                //console.log($(this).val());
                let value = $(this).val(); //guardo el valor del input y escribo el td
                let td = $(this).closest('td');
                //creo un span hidden con clase interes con el id adentro
                let span = $('<span class="interes">'+value+'</span>');
                $(this).remove();
                td.append(span);
            });
            $(this).find('select').each(function(){
                //console.log($(this).val());
                let value = $(this).val(); //guardo el valor del select y escribo el td
                let td = $(this).closest('td');
                td.text(value);
                $(this).remove();
            });
        });
        //agrego las imagenes editar y borrar
        let tdimg1 = thisTd;
        let tdimg2 = thisTd.next();

        //editar
        let img1 = document.createElement('img');
        img1.src = $('img#iHModificar').attr('src');
        img1.setAttribute('width','20px');
        img1.setAttribute('height','20px');
        img1.setAttribute('class','modificar');
        tdimg1.append(img1);
        //borrar
        let img2 = document.createElement('img');
        img2.src = $('img#iHBorrar').attr('src');
        img2.setAttribute('width','30px');
        img2.setAttribute('height','30px');
        img2.setAttribute('class','borrar');
        tdimg2.append(img2);
        $(this).remove();
    });

    $('body').on('click','.guardarIns',function(){
        let tr = $(this).closest('tr');
        let thisTd = $(this).closest('td');
        //convierto a texto el select de producto y la cantidad
        tr.each(function(){
            $(this).find('input').each(function(){
                //console.log($(this).val());
                let value = $(this).val(); //guardo el valor del input y escribo el td
                let td = $(this).closest('td');
                //creo un span hidden con clase interes con el id adentro
                let span = $('<span class="interesIns">'+value+'</span>');
                $(this).remove();
                td.append(span);
            });
            $(this).find('select').each(function(){
                //console.log($(this).val());
                let value = $(this).val(); //guardo el valor del select y escribo el td
                let td = $(this).closest('td');
                td.text(value);
                $(this).remove();
            });
        });
        //agrego las imagenes editar y borrar
        let tdimg1 = thisTd;
        let tdimg2 = thisTd.next();

        //editar
        let img1 = document.createElement('img');
        img1.src = $('img#iHModificar').attr('src');
        img1.setAttribute('width','20px');
        img1.setAttribute('height','20px');
        img1.setAttribute('class','modificar');
        tdimg1.append(img1);
        //borrar
        let img2 = document.createElement('img');
        img2.src = $('img#iHBorrar').attr('src');
        img2.setAttribute('width','30px');
        img2.setAttribute('height','30px');
        img2.setAttribute('class','borrar');
        tdimg2.append(img2);
        $(this).remove();
    })

    // ==== BOTON MODIFICAR ====
    $('body').on('click','.modificar',function(){
        let tr = $(this).closest('tr');
        let tdImgGuardar = $(this).closest('td');
        let tdCant =$(this).closest('td').prev().prev().prev();
        //genero el input de cantidad con su valor anterior para ser modificado
        let valorAnterior = tdCant.text();
        tdCant.text('');
        nuevoInput = $("<input>").attr({type:'text',class:'inputCant',value: valorAnterior});
        tdCant.append(nuevoInput);
        //genero la nueva imagen
        let imgGuardar = document.createElement('img');
        imgGuardar.src= $('img#iHGuardar').attr('src');
        imgGuardar.setAttribute('width','30px');
        imgGuardar.setAttribute('height','30px');
        imgGuardar.setAttribute('class','guardar');
        //por cada td con img en la row, se la elimino
        tr.find('td').each(function(){
            $(this).find('img').remove();
        });
        //agrego la nuevo imagen
        tdImgGuardar.append(imgGuardar);
    });
    // ==== BOTON BORRAR ====
    $('body').on('click','.borrar',function(){
        let tr = $(this).closest('tr');
        let r = confirm("¿Está seguro que desea borrar esta planificación?");
        if (r === true) {
            tr.hide();
            tr.remove();
        }
    });
    // ==== POST PLANIFICACION ====
    $("#btnguardar").click(function (event) {
        event.preventDefault();
        let fecha = $("#fecha").val();
        let productos = [];
        let insumos=[];

        $('body').find('span.interes').each(function (index) {
            productos.push($(this).text());
        });
        $('body').find('span.interesIns').each(function (index) {
            insumos.push($(this).text());
        });
        console.log(productos,insumos,fecha);
        $.ajax({
            url: "/planificacion/planificacionDia",
            data:JSON.stringify({ fechaa: fecha , insumoss: insumos, productoss : productos }),
            type: 'POST',
            dataType : "json",
            contentType: "application/json"
        }).done(function (data){
                console.log(data);
                //alert('Planificacion Guardada Satisfactoriamente');
                //window.location.replace("/planificacion")

            }

        );
    });



});
