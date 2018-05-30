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
		    	tbody.empty();
		    	for (var i = 0; i < data.lenght; i++) {
	    			var tr=document.createElement("tr");
	        		tr.setAttribute("id","tr"+i);
		    		for (var j = 0; j < data[i].lenght; j++) {
		    			var td=document.createElement("td");	    			
		    			td.innerHTML = data[i][j];
		    			tr.appendChild(td);        			
		    		}	
		    		tbody.append(tr);
		    	}
		        //alert("Data: " + data + "\nStatus: " + status);
		});
	});
	
});