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
		$("#trformulacion").remove(); //saco la grilla
		$("td").remove();
	}
      //alert(id+cantidad);
		//para pedir la formulacion
  		 $.getJSON("/produccion/formulacion",{id,cantidad},function(result){

			
            	let formulacion=result;
            	console.log(formulacion);
            	formulacion.forEach(function(ing,index) {
            		
            		//creo la tabla
            	
            		var tr=document.createElement("tr");
            			tr.setAttribute("id","trformulacion");
					tr.setAttribute('class','trConsumo');
            		var td1=document.createElement("td");
            		var inputID= $('<input>').attr({type:'hidden',value: ing['id'],id:"idInsumo"}).appendTo(tr);//tiene el id
					inputID.addClass('interes');
            		var td2=document.createElement("td");            	 	
            		var selectLote=$('<select></select>').attr({id:"selectLote"}).appendTo(td2);
            		$('<option selected="selected" disabled></option>').text("-Selecccione un Lote-").appendTo(selectLote);
                    selectLote.addClass('interes');
            		var td3=document.createElement("td");
            		var inputCant =$('<input>').attr({type:'text',placeholder:"Teorica Total: "+ing['cantidad'],id:"cantidad"}).appendTo(td3);            	inputCant.addClass('interes');
            		var td4=document.createElement("td");
            		var td5=document.createElement("td");               		
            		var agregarLote=$("<button>").attr({type:"button",value:"agregarLote"}).appendTo(td5);
            		agregarLote.addClass("btn btn-primary");
            		agregarLote.text("Agregar Lote");
            		
            		var tdStock=document.createElement("td");//td que contiene el stock
            		tdStock.setAttribute('id','tdstock');
            		  // $( '<button type="button" id="agregarLote">Agregar Lote</button>').appendTo( 
					//	td5 ).trigger( 'create' );

            		td1.setAttribute("id",ing['codigo']);//producto
            		$(td2).attr("id",index+"l");//lote
            		$(td3).attr("id",index+"c");//cantidad
            		$(td3).attr("name","cantidad");
            		
            		
            		td4.setAttribute("id",ing['tipoUnidad']+index);//tu
            		tr.append(td1,td2,td3,td4,tdStock,td5);	

            		$("#tbodyformulacion").append(tr);
		  			$("#"+ing['codigo']).html(ing['nombre']);
					$("#"+ing['tipoUnidad']+index).html(ing['tipoUnidad']);

					//Agrego las opciones al select de lotes
					
					ing['lotes'].forEach(function(lote,index) {
						let option=$('<option></option>').text(lote['id']);
						option.attr("value",lote['id']);
                        // se guarda en data-stock la cantidad en stock para ser mostrada luego de seleccionar el lote
                        option.data('stock',lote['stock']);
						selectLote.append(option);
						
					});
					
					

		  		});
            	//$("#alert").html(insumo.codigo);
            });
  		 
		  		
		});


	$("#selectProducto").change(function(){   //cambiar el tipo de Unidad dependiendo el producto
		//$('option:selected', this).attr('mytag');
		var tu=$('option:selected', this).attr("name");
		console.log(tu);
		$("#tipoUnidad").attr({value:tu});

	});

	

	$('body').on('change','#selectLote',function(){
		var stock=$('option:selected', this).data('stock');
		$(this).parent('td').next().next().next().text(stock);
	});
		
});// post a /produccion/lotenoplanificado