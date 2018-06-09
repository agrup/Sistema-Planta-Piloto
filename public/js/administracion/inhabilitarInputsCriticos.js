$(document).ready(function() {
	$('#alarma').on('change', function(){
		let selectAlarma = $(this).val();
		if(selectAlarma==1){
			$('#alarmaAmarilla').prop('disabled', false);
			$('#alarmaRoja').prop('disabled', false);
		}else{
			if(selectAlarma==0){
				$('#alarmaAmarilla').prop('disabled', true);
				$('#alarmaRoja').prop('disabled', true);
			}
		}
	});
	
});