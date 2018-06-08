$(document).ready(function(){

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
        let tdImgGuardar = document.createElement("td");
        let tdImgborrar = document.createElement("td");

        //Le agrego un input al td de cantidad
        $("<input>").attr({type:'text',class:'inputCant'}).appendTo(tdCant);

        //select
		let select;
		//si es producto copio el select de productos, sino el de insumos
		if(inspro == 'producto'){
            select = $("#selectProductos").clone().appendTo(tdProd);
            select.addClass('selectI');
            select.show();
		}else{
            select=$("#selectInsumos").clone().appendTo(tdProd);
            select.addClass('selectI');
            select.show();
		}

        //Imagen de guardar
        let guardar = document.createElement('img');
        guardar.src=$('img#iHGuardar').attr('src');
        guardar.setAttribute('width','30px');
        guardar.setAttribute('height','30px');
        guardar.setAttribute('class','guardar');
        tdImgGuardar.appendChild(guardar);

        //Creo la siguiente row y le agrego los td
        let newRow = document.createElement('tr');
        //La agrego en la ante-ultima row porque la ultima es la del boton agregar
        jqbutton.closest('table').find('tr:last').prev().after(newRow);
        //Agrego todos los td
        newRow.append(tdCod,tdProd,tdCant,tdTipoUnidad,tdImgGuardar,tdImgborrar);
	}

	$("#selectProductos").hide();
	$("#selectInsumos").hide();

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
        $(this).parent('td').prev('td').text(codigo);
        $(this).parent('td').next().next().text(tipoUnidad);
    });





// Adjust the width of thead cells when window resizes

});
