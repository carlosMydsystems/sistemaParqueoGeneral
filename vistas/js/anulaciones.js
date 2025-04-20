/*=============================================   
CREAR NOTA DE CREDITO
=============================================*/

$(".tablas").on("click", ".btnAnulacion", function(){  

	let idEstacionamiento = $(this).attr("idEstacionamiento");
	let tipodocumento = $(this).attr("tipodocumento");
	let serial = "";
	
	 if(tipodocumento =="FACTURA"){
        
        let fecha = fechaActual().split("-");        
        serial = "RA-"+fecha[0]+fecha[1]+fecha[2];
        
    }else if(tipodocumento =="BOLETA"){
        
        let fecha = fechaActual().split("-");        
        serial = "RC-"+fecha[0]+fecha[1]+fecha[2];
        
    }
  

	let datos = new FormData();
    datos.append("serialAnulacion", serial);
    datos.append("tipodocumento", tipodocumento);
	datos.append("accion", "buscarCorrelativo");

	$.ajax({
		url: "ajax/anulaciones.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){


     	let correlativo;
     	
        if(respuesta === false){
            
            correlativo = 1;

        }else{
            
            correlativo = parseInt(respuesta['correlativoResumenBoleta']) + 1;

        }

        $("#idEstacionamiento").val(idEstacionamiento);      
	    $("#fechaAnulacion").val(fechaActual()); 
	    $("#serial").val(serial); 
	    $("#correlativoAnulacion").val(correlativo); 
	    $("#modalGenerarAnulacion").modal('show'); 

     	}

	})

})



	/*=============================================
	MOSTRAR FECHA COMPLETA ACTUAL
	=============================================*/	

    function fechaActual(){
    
    let fecha = new Date();
    let horas = fecha.getHours();
    let segundos = fecha.getSeconds();
    let minutos = fecha.getMinutes();
    let diaSemana = fecha.getDay();
    //let semana = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
    let dia = fecha.getDate();
    //let mesNombre = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','setiembre','octubre','noviembre','diciembre'];
    let mes = fecha.getMonth();
    let year = fecha.getFullYear();
    let segundosPerdidos = "00";
    
    return (year + "-" + formatoHora(mes+1) + "-" + formatoHora(dia));
}


function formatoHora(numero){
    
    if(numero<=9){
        numero = "0"+numero
    }
    return numero;
    
    
}