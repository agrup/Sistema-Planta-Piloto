$(document).ready(function(){
	$('body').on('click','.modificar',function(){

		let tr = $(this).closest('tr');
        let tdImgGuardar = $(this).closest('td');

		let tdCant =$(this).closest('td').prev().prev();

        //genero el input de cantidad con su valor anterior para ser modificado
        let valorAnterior = tdCant.text();
		tdCant.text('');
		nuevoInput = $("<input>").attr({type:'text',class:'inputCant',value: valorAnterior});
		tdCant.append(nuevoInput);


		//genero la nueva imagen
        let imgGuardar = document.createElement('img');
        imgGuardar.src= $('img#iHGuardar').attr('src');
        imgGuardar.setAttribute('width','30px');
        imgGuardar.setAttribute('height','30px');
        imgGuardar.setAttribute('class','guardar');
        //por cada td con img, se la elimino
        tr.find('td').each(function(){
            $(this).find('img').remove();
        });
        //agrego la nuevo imagen
       	tdImgGuardar.append(imgGuardar);


	});

});