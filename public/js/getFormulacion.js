$(document).ready(function(){
	var resultado;
	$("#theadformulacion").hide();
	$("#trhformulacion").hide();
	$("#thinsumo").hide();
	$("#thlote").hide();
	$("#thcantidad").hide();
	$("#thtu").hide();


	$("#btnformulacion").click(function(){
		
		var cantidad=$("#cantidad").val();
		var id=$(":selected").attr('value');
		$("#theadformulacion").show();
		$("#trhformulacion").show();
		$("#thinsumo").show();
		$("#thlote").show();
		$("#thcantidad").show();
		$("#thtu").show();
		
	if($("#trformulacion").length>0){
		$("#trformulacion").remove();
		$("td").remove();
	}
      
		//para pedir la formulacion
  		 $.getJSON("/produccion/formulacion",{id,cantidad},function(result){

			
            	resultado=result;
            	console.log(resultado);
            	resultado.forEach(function(item,index) {
            		
            		//creo la tabla
            	
            		var tr=document.createElement("tr");
            			tr.setAttribute("id","trformulacion");
            		var td1=document.createElement("td");
            		$('<input>').attr({type:'hidden',value: item['id']}).appendTo(tr);//tiene el id
            		var td2=document.createElement("td");            	 	
            		$('<input>').attr({type:'text'}).appendTo(td2);				
            		var td3=document.createElement("td");
            		$('<input>').attr({type:'text',placeholder:"Cantidad Teorica: "+item['cantidad']}).appendTo(td3);            		
            		var td4=document.createElement("td");            		
            		td1.setAttribute("id",item['codigo']);//producto
            		$(td2).attr("id",index+"l");//lote
            		$(td3).attr("id",index+"c");//cantidad
            		$(td3).attr("name","cantidad");
            		td4.setAttribute("id",item['tipoUnidad']+index);//tu
            		tr.append(td1,td2,td3,td4);
            		$("#tbodyformulacion").append(tr);
		  			$("#"+item['codigo']).html(item['nombre']); 
					$("#"+item['tipoUnidad']+index).html(item['tipoUnidad']); 
		  			
		  		});
            	//$("#alert").html(insumo.codigo);
            });
  		 
		  		
		});


	$("#selectProducto").change(function(){
		$('option:selected', this).attr('mytag');
		var tu=$('option:selected', this).attr("name");
		console.log(tu);
		$("#tipoUnidad").attr({value:tu});	

	});
		
});// post a /produccion/lotenoplanificado