$(document).ready(function() {
	$('#agregarInsumo').on("click", function(){
		
		var row = $('#tbodyFormulacion:last-child');
		var newRow=row.clone();
		newRow.on("change", function(){   //cambiar el tipo de Unidad dependiendo el producto
		
			var parent = this.closest('tr');
	
			var tu= $('option:selected', this).attr("data-unit");		
			console.log(tu);
			var i = parent
			var label = $('td:last', parent);

			label.text(tu);
		});		
		newRow.insertAfter(row);
		var cantidad = row.find("input#cantidad");
		var tu = row.find("span#tdTipoUnidad");
		tu.attr({id:cantidad});

		cantidad.removeAttr('placeholder');

	});

	$('.selectInsumo').on("change", function(){   //cambiar el tipo de Unidad dependiendo el producto
		
		var parent = this.closest('tr');
		
		var tu= $('option:selected', this).attr("data-unit");		

		var i = parent
		var label = $('td:last', parent);

		label.text(tu);
	});

	$('#guardarFormulacion').on("click", function(){
		var dataFormulacion = [];
		$('.selectInsumo').each(function(index){

			var id = $('option:selected', this).attr("data-id");
			var cantidad = $('.inputFormulacion', this).val();

			//var id = this.firstChild.getAttribute("data-id");
		
			var row = [id, cantidad];
			dataFormulacion.push(row);
		});
		console.log(dataFormulacion);
		var input = $('#inputHidden').val(dataFormulacion);




	});
	/*$('#inputTipoUnidad').on("change", function(){
		console.log(this);
		var tu = this.val();
		$('#labelTipoUnidad').text(tu);
	});*/

});