$(document).ready(function() {
	$('#agregarInsumo').on("click", function(){
		
		var row = $('#tbodyFormulacion:last-child');
		var newRow=row.clone();
		$('.selectInsumo').on("change", function(){   //cambiar el tipo de Unidad dependiendo el producto
		
			var parent = this.closest('tr');
			console.log(parent);		
			var tu= $('option:selected', this).attr("data-unit");		
			console.log(tu);
			var i = parent
			var label = $('td:last', parent);
			console.log(label);
			label.text(tu);
		});		
		newRow.insertAfter(row);
		var cantidad = row.find("input#cantidad");
		var tu = row.find("span#tdTipoUnidad");
		tu.attr({id:cantidad});
		console.log(cantidad);
		cantidad.removeAttr('placeholder');

	});

	$('.selectInsumo').on("change", function(){   //cambiar el tipo de Unidad dependiendo el producto
		
		var parent = this.closest('tr');
		console.log(parent);		
		var tu= $('option:selected', this).attr("data-unit");		
		console.log(tu);
		var i = parent
		var label = $('td:last', parent);
		console.log(label);
		label.text(tu);
	});

	$('#guardarFormulacion').on("click", function(){
		var dataFormulacion = [];
		$('tbody tr').each(function(index){
			console.log(this);
			var id = this.firstChild.getAttribute("data-id");
			console.log(id);
			//var id = this.find('td:option:selected', this).attr("data-id");
			
			//var cantidad = this.find('td:input', this).val();		
			var row = [id, cantidad];
			dataFormulacion[index] = row;
		});
		
		var input = $('<input type="hidden" name="formulacion"/>').val(dataFormulacion).appendTo('#myform');
		console.log(input.attr("name"));



	});

});