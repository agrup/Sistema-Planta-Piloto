$(document).ready(function(){
	var lugar=$("#home").data("place");
	if(lugar=="home"){
		$("#dropdown00").css('color','#ff4d4d');
	}
		
});


$('.btn-expand-collapse').click(function(e) {
				$('.navbar-primary').toggleClass('collapsed');
});