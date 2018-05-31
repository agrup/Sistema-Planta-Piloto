$(document).ready(function(){
		$(".agregarProducto").click(function(){
			
			var td1=document.createElement("td");
			var td2=document.createElement("td");
			var td3=document.createElement("td");
			var td4=document.createElement("td");
			var td5=document.createElement("td");


			var input1=$("<input>").attr({type:'text',class:'interes'}).appendTo(td1);
			var input2=$("<input>").attr({type:'text',class:'interes'}).appendTo(td2);
			var input3=$("<input>").attr({type:'text',class:'interes'}).appendTo(td3);
			var input4=$("<input>").attr({type:'text',class:'interes'}).appendTo(td4);
			var guardar=document.createElement('img');
			guardar.src="img/guardar.png";
			guardar.setAttribute('width','30px');
			guardar.setAttribute('height','30px');
			guardar.setAttribute('class','guardar');
			td5.appendChild(guardar);
			//var agregar=$("<a></a>")appendTo(td5);
			//agregar.attr('href','#');
			//agregar.attr('class','guardar');

			row = $(this).closest('tr');
			$('.nuevaLineaProducto:last').append(td1,td2,td3,td4,td5);
			
			tbody = $(this).closest('tbody');
			var tr=document.createElement("tr");
			tr.setAttribute('class','nuevaLineaProducto');
			//$(this).remove();
			var parent=$(this).closest('tr');
			tbody.append(tr,this);
			parent.remove();
			//$('.tbodyPlanif').append();
		});
		$(".agregarInsumo").click(function(){
			
			var td1=document.createElement("td");
			var td2=document.createElement("td");
			var td3=document.createElement("td");
			var td4=document.createElement("td");
			var td5=document.createElement("td");

			var input1=$("<input>").attr({type:'text',class:'interes'}).appendTo(td1);
			var input2=$("<input>").attr({type:'text',class:'interes'}).appendTo(td2);
			var input3=$("<input>").attr({type:'text',class:'interes'}).appendTo(td3);
			//var input4=$("<input>").attr({type:'text',class:'interes'}).appendTo(td4);
			var guardar=document.createElement('img');
			guardar.src="img/guardar.png";
			guardar.setAttribute('width','30px');
			guardar.setAttribute('height','30px');
			guardar.setAttribute('class','guardar');
			td5.appendChild(guardar);

			row = $(this).closest('tr');
			$('.nuevaLineaInsumo:last').append(td1,td2,td3,td5);
			
			tbody = $(this).closest('tbody');
			var tr=document.createElement("tr");
			tr.setAttribute('class','nuevaLineaInsumo');
			//$(this).remove();
			var parent=$(this).closest('tr');
			tbody.append(tr,this);
			parent.remove();

			//$('.tbodyPlanif').append();

		});

	});
