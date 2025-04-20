
/*=============================================
INGRESO DEL CODIGO DE BARRAS
=============================================*/

$(document).on('keypress', function (e) {
	if (e.which == 13) {

		$(".btnBoletaFactura").hide();
		$("#btnAcumular").hide();
		$("#bloque").show();

		let idEstacionamiento = $("#idEstacionamiento").val();
		let datos = new FormData();
		datos.append("idEstacionamiento", idEstacionamiento);
		datos.append("accion", "mostrarParqueo");

		if (idEstacionamiento != undefined) {
			$.ajax({
				url: "ajax/pago.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {

					if (respuesta['0']['placa'] == undefined) {

						$("#placaVehiculo").html("");
						$("#fechaHoraIngresoVehicular").html("");
						$("#idEstacionamiento").val("");
						alert("El codigo ingresado no existe");

					} else if (respuesta['0']['condicion'] == "PAGADO") {

						$("#placaVehiculo").html("");
						$("#fechaHoraIngresoVehicular").html("");
						$("#idEstacionamiento").val("");
						alert("El vehiculo ya se encuentra en estado Pagado");  

					} else {

						let startTime = new Date(respuesta['0']['fechaingreso']);
						let endTime = new Date(fechaCompletaActual());
						let condicion = respuesta['0']['condicion'];

						$(".btnBoletaFactura").hide();
						$("#condicion").val(condicion);

						if (respuesta['0']['plana'] == "No") { // PAGO ORDINARIO

							let horas = parseFloat(calculaHorasOrdinario(startTime, endTime)).toFixed(2);
							let tarifa = parseFloat(respuesta['0']['tarifavehiculo']).toFixed(2);
							let pago = parseFloat(horas * tarifa).toFixed(2);
							let subtotal = pago / 1.18;
							let igv = pago - subtotal;

							$("#subtotal").val(subtotal.toFixed(2));
							$("#igv").val(igv.toFixed(2));
							$("#monto").val(pago);
							$("#cantidadHoras").val(horas);
							$("#placaVehiculo").html(respuesta['0']['placa']);
							$("#fechaHoraIngresoVehicular").html(respuesta['0']['fechaingreso']);
							$("#fechaHoraSalidaVehicular").html(fechaCompletaActual());
							$("#montoDetalle").html(pago);


							$(".btnBoletaFactura").show();

						} else if (respuesta['0']['plana'] == "Si" && respuesta['0']['tipocobro'] == "Horas") {

							$("#placaVehiculo").html(respuesta['0']['placa']);
							$("#fechaHoraIngresoVehicular").html(respuesta['0']['fechaingreso']);
							$("#fechaHoraSalidaVehicular").html(fechaCompletaActual());
							let horaActual = fechaCompletaActual().split(" ")[1];
							let pago = parseFloat(respuesta['0']['tarifavehiculo']).toFixed(2);
							let subtotal = pago / 1.18;
							let igv = pago - subtotal;
							/*
							  if(horaActual.split(":")[0] >= 20){
								  
								  let horaLimite = new Date(fechaCompletaActual().split(" ")[0] + " 20:00:00");
								  let pago = calculaPagoOrdinario(horaLimite, endTime,5.00) 
								  pago = parseFloat(pago) + parseFloat(respuesta['tarifavehiculo']);
								  let subtotal = pago/1.18;
			 
								  $("#subtotal").val();
								  $("#igv").val(pago);
								  
							  }else{
								  
								  $("#monto").val(respuesta['0']['tarifavehiculo']);
								  
							 }

							*/

							$("#subtotal").val(subtotal.toFixed(2));
							$("#igv").val(igv.toFixed(2));
							$("#monto").val(pago);
							$("#montoDetalle").html(pago);
							$("#cantidadHoras").val("1");
							$(".btnBoletaFactura").show();

						} else if (respuesta['0']['plana'] == "Si" && respuesta['0']['tipocobro'] == "Mensual") {

							$("#fechaHoraIngresoVehicular").html(respuesta['0']['fechaingreso']);
							$("#fechaHoraSalidaVehicular").html(fechaCompletaActual());
							$("#mesAbonado").show();
							$(".btnBoletaFactura").show();
							$("#placaVehiculo").html(respuesta['placa']);

							let pago = parseFloat(respuesta['0']['tarifavehiculo']).toFixed(2);
							let subtotal = pago / 1.18;
							let igv = pago - subtotal;

							$("#subtotal").val(subtotal.toFixed(2));
							$("#igv").val(igv.toFixed(2));
							$("#monto").val(pago);
							$("#montoDetalle").html(pago);
							$("#cantidadHoras").val("1");

						} else if (respuesta['0']['plana'] == "Noche") {

						}

						if (respuesta['0']['condicion'] == "ACUMULADO") {
							$("#btnAcumular").show();
							$("#muestraDetalleEstacionamiento").show();
							$("#muestraClienteNormalEstacionamiento").hide();
							$("#mostrarBtnPagar").hide();

							let MontoAcumulado = 0;
							let MontoNetoAcumulado = 0;
							let IgvAcumulado = 0;
							let horasTotales = 0;

							for (i = 0; i < respuesta.length; i++) {

								if (respuesta[i]['estadoAcumulado'] == "1") {

									MontoAcumulado = parseFloat(MontoAcumulado) + parseFloat(respuesta[i]['monto']);
									MontoNetoAcumulado = parseFloat(MontoNetoAcumulado) + parseFloat(respuesta[i]['montoNeto']);
									IgvAcumulado = parseFloat(IgvAcumulado) + parseFloat(respuesta[i]['igv']);
									horasTotales = parseFloat(horasTotales) + parseFloat(respuesta[i]['cantidadHoras']);

								} else {

									let startTime = new Date(respuesta[i]['fechaingreso']);
									let endTime = new Date(fechaCompletaActual());

									let horas = parseFloat(calculaHorasOrdinario(startTime, endTime)).toFixed(2);
									let tarifa = parseFloat(respuesta['0']['tarifavehiculo']).toFixed(2);
									let pago = parseFloat(horas * tarifa).toFixed(2);
									let subtotal = parseFloat(pago / 1.18).toFixed(2);
									let igv = pago - subtotal;

									MontoAcumulado = parseFloat(MontoAcumulado) + parseFloat(pago);
									MontoNetoAcumulado = parseFloat(MontoNetoAcumulado) + parseFloat(subtotal);
									IgvAcumulado = parseFloat(IgvAcumulado) + parseFloat(igv);
									horasTotales = parseFloat(horasTotales) + parseFloat(horas);

								}
							}

							$("#subtotal").val(MontoNetoAcumulado.toFixed(2));
							$("#igv").val(IgvAcumulado.toFixed(2));
							$("#monto").val(MontoAcumulado.toFixed(2));
							$("#cantidadHoras").val(horasTotales.toFixed(2));

						} else {


						}
					}
				}
			})
		}
	}
});

/*=============================================
CALCULO DEL PAGO ORDINARIO
=============================================*/

function calculaPagoOrdinario(startDate, endDate, tarifa) {

	let pago = 0.00;
	let minutos = (endDate.getTime() - startDate.getTime()) / 60000;
	let minutosExtras = minutos % 60;
	horasReales = (minutos - minutosExtras) / 60;

	if (minutosExtras > 10) {

		pago = (horasReales + 1) * tarifa

	} else {

		if (horasReales == 0) {

			pago = (horasReales + 1) * tarifa;

		} else {

			pago = horasReales * tarifa;

		}

	}

	return pago;

}

/*=============================================
CALCULO DE LAS HORAS ORDINARIO
=============================================*/

function calculaHorasOrdinario(startDate, endDate) {

	let minutos = (endDate.getTime() - startDate.getTime()) / 60000;
	let minutosExtras = minutos % 60;
	horasReales = (minutos - minutosExtras) / 60;

	if (minutosExtras > 10) {

		horasReales = (horasReales + 1)

	} else {

		if (horasReales == 0) {

			horasReales = (horasReales + 1);

		} else {

			horasReales = horasReales;

		}

	}

	return horasReales;

}


/*=============================================
MOSTRAR FECHA COMPLETA ACTUAL
=============================================*/

function fechaCompletaActual() {

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

	return (year + "-" + formatoHora(mes + 1) + "-" + formatoHora(dia) + " " + formatoHora(horas) + ":" + formatoHora(minutos) + ":" + segundosPerdidos);
}


/*=============================================
BOTON DE CAMBIO DE BOLETA A FACTURA
=============================================*/

$(".btnBoletaFactura").on("click", function () {

	let estadoAcumulado = $(".btnBoletaFactura").attr("estadoBoleta");
	let monto = $("#monto").val();
	if (estadoAcumulado == 0) {

		$(".btnBoletaFactura").attr("estadoBoleta", "1");
		$(".btnBoletaFactura").removeClass('btn-success');
		$(".btnBoletaFactura").addClass('btn-warning');
		$(".btnBoletaFactura").html('FACTURA');
		$("#clientes").show();
		$("#campoFactura").show();
		$("#TipoDocumento").val("FACTURA");
		$("#datosFactura").show();
		$("#datosBoleta").hide();
		$("#contadorRepetido").show();
		$("#contador").show();

	} else {

		$(".btnBoletaFactura").attr("estadoBoleta", "0");
		$(".btnBoletaFactura").removeClass('btn-warning');
		$(".btnBoletaFactura").addClass('btn-success');
		$(".btnBoletaFactura").html('BOLETA');
		$("#clientes").hide();
		$("#campoFactura").hide();
		$("#TipoDocumento").val("BOLETA");
		$("#datosFactura").hide();
		$("#datosBoleta").show();
		$("#contadorRepetido").show();
		$("#contador").show();

	}

	$("#monto").val(monto);


})

/*=============================================
BOTON DE SELECCION DEL CLIENTE
=============================================*/

$(".tablas").on("click", ".btnSeleccionarCliente", function () {

	let idCliente = $(this).attr("idCliente");
	let razonSocial = $(this).attr("razonSocialCliente");
	let ruc = $(this).attr("rucCliente");
	let direccionFiscal = $(this).attr("direccionFiscalCliente");

	$("#rucCliente").val(ruc);
	$("#razonSocialCliente").val(razonSocial);
	$("#direccionFiscalCliente").val(direccionFiscal);
	$("#modalMostrarCliente").modal("hide");

})

/*=============================================
BOTON DE PARA REGISTRAR EL PAGO
=============================================*/
let validaClick = false;
let contador = 0;
let contadorIngreso = 0;
$("#contadorRepetido").val(contador);
$("#contador").val(contadorIngreso);
$("#btnPagar").on("click", function () {

	if (validaClick) {

		contador++;

	} else {
		contadorIngreso++;

		validaClick = true;

		let rucCliente = $("#rucCliente").val();
		rucCliente = rucCliente.trim();
		let razonSocialCliente = $("#razonSocialCliente").val();
		let direccionFiscalCliente = $("#direccionFiscalCliente").val();
		let tipoDocumento = $(".btnBoletaFactura").html();
		

		if (rucCliente.length != 11 && tipoDocumento == "FACTURA") {

			alert("Por favor verifique el numero de Ruc")

		} else {


			let datos = new FormData();

			datos.append("tipoDocumento", tipoDocumento);
			datos.append("accion", "mostrarCorrelativo");

			$.ajax({
				url: "ajax/pago.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {

					let numAux = respuesta['numerodocumento'];

					if (numAux == undefined) {numAux = "0";}

					let numeroDocumento = parseInt(numAux) + 1;
					let longitudString = numeroDocumento.lenght;
					let monto = $("#monto").val();
					let idEstacionamiento = $("#idEstacionamiento").val();
					let subtotal = $("#subtotal").val();
					let igv = $("#igv").val();
					let tipoDocumento = $(".btnBoletaFactura").html();
					let placaVehiculo = $("#placaVehiculo").html();
					let fechaHoraIngresoVehicular = $("#fechaHoraIngresoVehicular").html();
					let fechaHoraSalidaVehicular = $("#fechaHoraSalidaVehicular").html();
					let dniCliente = $("#dniCliente").val();
					let cantidadHoras = $("#cantidadHoras").val();
					let variableSesion = $("#variableSesion").val();
					let tipoPago = $("#tipoPago").val();

					/** Validaciones de datos  **/

					if (tipoDocumento == "BOLETA") {

						if (dniCliente.length < 8) {

							dniCliente = "12345678"

						}
						if (direccionFiscalCliente.length <= 0) {

							direccionFiscalCliente = "-"
						}
					}

					let cajaId = $("#cajaId").val()

					let datos = new FormData();
					datos.append("rucCliente", rucCliente);
					datos.append("dniCliente", dniCliente);
					datos.append("razonSocialCliente", razonSocialCliente);
					datos.append("direccionFiscalCliente", direccionFiscalCliente);
					datos.append("monto", monto);
					datos.append("idEstacionamiento", idEstacionamiento);
					datos.append("subtotal", subtotal);
					datos.append("igv", igv);
					datos.append("tipoDocumento", tipoDocumento);
					datos.append("numerodocumento", numeroDocumento);
					datos.append("fechaHoraSalidaVehicular", fechaHoraSalidaVehicular);
					datos.append("cantidadHoras", cantidadHoras);
					datos.append("tipoPago", tipoPago);   
					datos.append("cajaId", cajaId); 
					datos.append("accion", "actualizarPagoParqueo");

					$.ajax({
						url: "ajax/pago.ajax.php",
						method: "POST",
						data: datos,
						cache: false,
						contentType: false,
						processData: false,
						dataType: "json",
						success: function (respuesta) {

							window.location = "index.php?ruta=factura&idEstacionamiento=" + idEstacionamiento;

						}

					})

				}

			})
		}
	}
	$("#contadorRepetido").val(contador);
	$("#contador").val(contadorIngreso);
})


function formatoHora(numero) {

	if (numero <= 9) {
		numero = "0" + numero
	}
	return numero;


}





