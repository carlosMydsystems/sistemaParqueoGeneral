/*=============================================   
CREAR NOTA DE CREDITO
=============================================*/

$(".tablas").on("click", ".btnEditarDetalleCaja", function(){  

	let idDetalleCaja = $(this).attr("idDetalleCaja");

	let datos = new FormData();
    datos.append("idDetalleCaja", idDetalleCaja);
	datos.append("accion", "detalleCaja");

	$.ajax({
		url: "ajax/detalleCaja.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){ 

            $("#modalActualizarDetalleCaja").modal("show")
            $("#actualizaDetalleCajaId").val(respuesta[0]["idDetalleCaja"])
            $("#actualizarMontoEgreso").val(respuesta[0]["montoEgreso"])
            $("#actualizarConceptoEgreso").val(respuesta[0]["concepto"])
     	}

	})

})


$(".tablas").on("click",".btnEliminarDetalleCaja",function(){
    
    let idDetalleCaja = $(this).attr("idDetalleCaja");
   
    swal({
            title: '¿Está seguro de eliminar el detalle de Caja?',
            text: "¡Si no lo está puede cancelar la accíón!",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, borrar ticket!'
            }).then(function(result){
        
            if(result.value){
        
                window.location = "index.php?ruta=detalleCaja&idDetalleCaja="+idDetalleCaja;
        
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