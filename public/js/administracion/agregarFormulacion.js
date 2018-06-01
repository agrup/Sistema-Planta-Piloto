$(document).ready(function() {
	$('#agregarInsumo').on("click", function(){
		
		var row = $('#tbodyFormulacion:last-child');
		var newRow=row.clone();
		newRow.on("change", function(){   //cambiar el tipo de Unidad dependiendo el producto
		
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
			var id = $('option:selected', this).attr("data-id");
			var cantidad = $('input', this).val();
			console.log(cantidad);
			//var id = this.firstChild.getAttribute("data-id");
			console.log(id);			
			var row = [id, cantidad];
			dataFormulacion.push(row);
		});
		console.log(dataFormulacion);
		var input = $('<input type="hidden" name="formulacion"/>').val(dataFormulacion).appendTo('#myform');
		console.log(input.attr("name"));



	});

});