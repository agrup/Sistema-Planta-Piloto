$(document).ready(function() {


	
	$('body').on('click', "button[value='agregarLote']", function(){
	
		var row = $(this).closest('tr');

		var newRow=row.clone();
		newRow.insertAfter(row);
		$(this).remove();
		//le quito el palceholder a la anterior
		var cantidad=row.find("input#cantidad");
		console.log(cantidad);
		cantidad.removeAttr('placeholder');

		//var tbody=	$(this).closest('tbody');
		//tbody.append(newRow);

	});
	
});