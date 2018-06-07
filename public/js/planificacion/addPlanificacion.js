$(document).ready(function(){
	$("#selectProductos").hide();
	$("#selectInsumos").hide();
	$("#selecttp").hide();

		$(".agregarProducto").click(function(){

			//creo los td
			let tdHiddenID=document.createElement('td');
			var tdCod=document.createElement("td");
			var tdProd=document.createElement("td");
			var tdCant=document.createElement("td");
			var tdTP=document.createElement("td");
			var tdImgGuardar=document.createElement("td");
			let tdTipoUnidad = document.createElement("td");
			//les pongo id
			tdCod.setAttribute('id','codigo');
			tdProd.setAttribute('id','nombre');
			tdCant.setAttribute('id','cantidad');
			tdTP.setAttribute('id','tp');
			tdTipoUnidad.setAttribute('id','tu');
			//Les pongo clase a los que hagan falta
			//tdCod.setAttribute('class','inte');
			//tdProd.setAttribute('class','inte');
			tdCant.setAttribute('class','inte');
			tdTP.setAttribute('class','inte');
            tdHiddenID.setAttribute('hidden',true);
            tdHiddenID.setAttribute('class','inte');

			//Le agrego un input al td de cantidad
			$("<input>").attr({type:'text',class:'interes'}).appendTo(tdCant);

			//SELECT tipo tp
			var selectTP=$("<select>").attr({type:'text',class:'interes',id:'selecttp'}).appendTo(tdTP);
			$("<option value='No'>No</option>").appendTo(selectTP);
			$("<option value='Si'>Si</option>").appendTo(selectTP);
			
			//select de los productos
			var selectProd=$("#selectProductos").clone().appendTo(tdProd);
			selectProd.attr('id','productos');
			selectProd.addClass('interes');
			selectProd.show();
			
			//Imagen de guardar
			var guardar=document.createElement('img');
			guardar.src=$('img#iHGuardar').attr('src');
			guardar.setAttribute('width','30px');
			guardar.setAttribute('height','30px');
			guardar.setAttribute('class','guardar');
			tdImgGuardar.appendChild(guardar);

			//Creo la siguiente row y le agrego los td
			let newRow = document.createElement('tr');
			newRow.setAttribute('class','trProducto');
			//La agrego en la ante-ultima row porque la ultima es la del boton agregar
            $(this).closest('table').find('tr:last').prev().after(newRow);
			newRow.append(tdHiddenID,tdCod,tdProd,tdCant,tdTipoUnidad,tdTP,tdImgGuardar);
			
			/*tbody = $(this).closest('tbody');
			var tr=document.createElement("tr");
			tr.setAttribute('class','trProducto');
			//$(this).remove(div)ove();
			var parent=$(this).closest('tr');
			//console.log($(this).closest('tr'));
			tbody.append(tr,this);
			parent.remove();*/
			//$('.tbodyPlanif').append();
		});
		$(".agregarInsumo").click(function(){

            let tdHiddenID=document.createElement('td');
			var tdCodigo=document.createElement("td");
			var tdProdNombre=document.createElement("td");
			var tdCant=document.createElement("td");
			var tdTipoUnidad=document.createElement("td");
			var tdImgGuardar=document.createElement("td");
			tdCodigo.setAttribute('id','codigo');
			tdProdNombre.setAttribute('id','nombre');
			tdCant.setAttribute('id','cantidad');
			tdTipoUnidad.setAttribute('id','tu');
			//tdCodigo.setAttribute('class','inte');
			//tdProdNombre.setAttribute('class','inte');
			tdCant.setAttribute('class','inte');
			tdHiddenID.setAttribute('hidden',true);
			tdHiddenID.setAttribute('class','inte');
			
			//var input1=$("<input>").attr({type:'text',class:'interes'}).appendTo(tdCodigo);
			var input3=$("<input>").attr({type:'text',class:'interes'}).appendTo(tdCant);
			//select de los Insumos
			var select=$("#selectInsumos").clone().appendTo(tdProdNombre);
			select.attr('id','insumos');
			select.addClass('interes');
			select.show();
			//var input4=$("<input>").attr({type:'text',class:'interes'}).appendTo(tdTipoUnidad);
			var guardar=document.createElement('img');
			guardar.src=$('img#iHGuardar').attr('src');
			guardar.setAttribute('width','30px');
			guardar.setAttribute('height','30px');
			guardar.setAttribute('class','guardar');
			tdImgGuardar.appendChild(guardar);


            //Creo la siguiente row y le agrego los td
            let newRow = document.createElement('tr');
            newRow.setAttribute('class','trInsumo');
            //La agrego en la ante-ultima row porque la ultima es la del boton agregar
            $(this).closest('table').find('tr:last').prev().after(newRow);
			newRow.append(tdHiddenID,tdCodigo,tdProdNombre,tdCant,tdTipoUnidad,tdImgGuardar);
			
			/*tbody = $(this).closest('tbody');
			var tr=document.createElement("tr");
			tr.setAttribute('class','trInsumo');
			//$(this).remove();
			var parent=$(this).closest('tr');
			tbody.append(tr,this);
			parent.remove();*/

			//$('.tbodyPlanif').append();

		});
		//cuando seleccionoel producto pongo automaticamente el id, codigo y tu
		$("body").on('change','#productos',function(){   //cambiar el codigo dependiendo el producto
			//guardo id, codigo y tipo unidad guardados en data del select
			let id = $('option:selected', this).data('id');
			let codigo=$('option:selected', this).data('codigo');
            let tipoUnidad=$('option:selected',this).data('tu');

            //actualizo los valores de los td correspondientes
            $(this).parent('td').prev('td').prev('td').text(id);
            $(this).parent('td').prev('td').text(codigo);
            $(this).parent('td').next().next().text(tipoUnidad);

	});
    	//cuando seleccione el insumo pongo automaticamente el id, codigo y tu
		$("body").on('change','#insumos',function(){   //cambiar el codigo dependiendo el insumo
		//$('option:selected', this).attr('mytag');
            //guardo id, codigo y tipo unidad guardados en data del select
            let id = $('option:selected', this).data('id');
			let codigo=$('option:selected', this).data('codigo');
            let tipoUnidad=$('option:selected',this).data('tu');
            //actualizo los valores de los td correspondientes
            $(this).parent('td').prev('td').prev('td').text(id);
            $(this).parent('td').prev('td').text(codigo);
            $(this).parent('td').next().next().text(tipoUnidad);

	});
	});
