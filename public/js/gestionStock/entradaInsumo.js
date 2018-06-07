$(document).ready(function(){
	$('#selectInsumo').change(function(){
		var tu=$('option:selected').data('unit');
		console.log(tu);
		$('#tuinsumo').val(tu);
	});


});