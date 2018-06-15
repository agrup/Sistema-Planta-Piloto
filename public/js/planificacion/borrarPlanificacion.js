$(document).ready(function(){
	$('body').on('click','.borrar',function(){
		let tr = $(this).closest('tr');
		//
		let txt;
		let r = confirm("¿Está seguro que desea borrar esta planificación?");
		if (r === true) {
		   tr.hide();
		   tr.remove();
		}
	});
});