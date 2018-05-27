$(document).ready(function() {
	$("#btnformulacion").click(function(){
		//alert("aSome")
		$("#tbodyformulacion").remove();
		var cantidad=$("#cantidad").val();
		var id=$("#idlote").attr("value");
		alert(id+cantidad);
		$.getJSON("/produccion/formulacion",{id,cantidad},function(result){
					
            	resultado=result;
            	console.log(resultado);
            	resultado.forEach(function(item,index) {
            		
            		//creo la tabla
            		var tbody=document.createElement("tbody");
            			tbody.setAttribute("id","tbodyformulacion");
            		var tr=document.createElement("tr");
            			tr.setAttribute("id","trformulacion");
            		var td1=document.createElement("td");
            		$('<input>').attr({type:'hidden',value: item['id'],id:"idInsumo"}).appendTo(tr);//tiene el id
            		var td2=document.createElement("td");            	 	
            		$('<input>').attr({type:'text',id:"lote"}).appendTo(td2);				
            		var td3=document.createElement("td");
            		$('<input>').attr({type:'text',placeholder:"Cantidad Teorica: "+item['cantidad'],id:"cantidad"}).appendTo(td3);            		
            		var td4=document.createElement("td");            		
            		td1.setAttribute("id",item['codigo']);//producto
            		$(td2).attr("id",index+"l");//lote
            		$(td3).attr("id",index+"c");//cantidad
            		$(td3).attr("name","cantidad");
            		
            		
            		td4.setAttribute("id",item['tipoUnidad']+index);//tu
            		tr.append(td1,td2,td3,td4);	
            		tbody.append(tr);
            		

            		$("#tformulacion").append(tbody);
		  			$("#"+item['codigo']).html(item['nombre']); 
					$("#"+item['tipoUnidad']+index).html(item['tipoUnidad']); 
		  			
		  		});	
		});
	});
});