$(document).ready(function() {
	$("#btnBuscar").click(function() {
		
		$.post("demo_test_post.asp",
    	{
	        codigo: $("#codigo").val(),
	        nombre: $("#nombre").val(),
	        categoria: $("#categoria").val(), 
	        alarma: $("#alarma").val()

    	},
	    function(data, status){
	    	var tbody =  $("#tbodyResultados");
	    	for (var i = 0; i < data.lenght; i++) {
    			var tr=document.createElement("tr");
        		tr.setAttribute("id","tr"+[i]);
	    		for (var j = 0; j < data[i].lenght; j++) {
	    			
	    		}	
	    	}

	        alert("Data: " + data + "\nStatus: " + status);
	    });
	 });
});