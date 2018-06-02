$(document).ready(function() {



	$('#trFormulacion').hide();
	$('#agregarInsumo').on("click", function(){		
		var row = $('#trFormulacion');
		console.log(row);

		var newRow=row.clone();
		newRow.on("change", function(){   //cambiar el tipo de Unidad dependiendo el producto

		$(newRow).show();
		newRow.addClass('trFormulacion');
		$('input', newRow).addClass('inputFormulacion');

		$('select', newRow).addClass('selectFormulacion');
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

		var b = true;
		
		var inputs = $('.inputFormulacion');
		
		inputs.each(function(){			
			if ($(this).val()=="") {
				b = false;			
			}
		});
		var selects = $('.selectFormulacion');
		
		selects.each(function(){
			console.log($('option:selected', this).val());
			if($('option:selected', this).val()==null){
				b = false;			
			}
			
		});
		

		if(b){
			$('.trFormulacion').each(function(index){
				
				
				var id = $('option:selected', this).attr("data-id");
				var cantidad = $('input#cantidad', this).val();
				console.log(cantidad);
				console.log('22222222222222')
				console.log(id);			
				var row = [id, cantidad];
				dataFormulacion.push(row);
			});
			console.log(dataFormulacion);
			$('#inputHidden').val(dataFormulacion);
			//console.log(input.attr("name"));
		}else{
			alert("Por Favor complete el formulario")
		}	


	$('#myForm').on('submit', function(){
		event.preventDefault();			
		if($('#inputHidden').val()=="")
			alert("No se ha guardado la formulación");
		
		var inputs = $('.inputFormulacion');
		/*inputs.each(function(){
			console.log(this);
			console.log($(this).val());
			if ($(this).val()=="") {
				
			}
		});*/
		this.submit();
	});


	});
	/*$('#inputTipoUnidad').on("change", function(){
		console.log(this);
		var tu = this.val();
		$('#labelTipoUnidad').text(tu);
	});*/


});