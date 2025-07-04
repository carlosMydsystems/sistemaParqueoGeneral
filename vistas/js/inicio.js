$(document).ready(function () {
    setInterval(actualizarHora, 1000)
    let cajaDuplicada = $("#cajaDuplicada").val();
    let usuarioId = $("#usuarioId").val();

    if (cajaDuplicada == "No") {
        $('#modalIngresarMontoCaja').modal({ backdrop: 'static', keyboard: false })

        let datos = new FormData();
        datos.append("usuarioId", usuarioId);
        datos.append("estadoCaja", "0");
        datos.append("accion", "mostrarCaja");

        $.ajax({
            url: "ajax/inicio.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta != "error") {
                    $("#idCajaInicial").val(respuesta["idCaja"])
                }
            }
        })
    }
});

$("#btnSeleccionCliente").on("click", function () {
    $("#modalSeleccionarVehiculoCliente").modal("show");
})

$("#tarifa").on("change",function(){

    let tipoPlana = $("#tarifa>option:selected").attr("tipoPlana")
    $("#tarifaPlana").val(tipoPlana)
})

$("#nuevaPlaca").on("input", function () {
   let placa = $("#nuevaPlaca").val()
   if(placa.length == 7){
    let datos = new FormData();
    datos.append("placa",placa);
    datos.append("accion","verificarAbonado")

    $.ajax({
        url: "ajax/inicio.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta != false) {

                const fechaInicial = moment(respuesta['fechaInicioCliente'])
                let hoy = moment(Date.now())
                const diferencia = 30 - hoy.diff(fechaInicial,'days')
                if(diferencia>=0){
                    swal({
                        type: "success",
                        title: "¡El Vehiculo es un abonado! le falta " + diferencia + " días",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){
                        if(result.value){
                            window.location = "inicio";
                        }
                    });
                }else{


                    let datos = new FormData();
                    datos.append("idDetalleCliente", respuesta['idDetalleCliente']);
                    datos.append("accion", "cambiarEstadoDetalleCliente");
            
                    $.ajax({
                        url: "ajax/inicio.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (respuesta) {
                            if (respuesta != "error") {
                                alert(respuesta)
                            }
                        }
                    })

                }
            }
        }
    })

   }
})


$(".btnSeleccionarVehiculoCliente").on("click", function () {

    let idVehiculoClienteeleccionarVip = $(this).attr("idVehiculoClienteeleccionarVip");
    let idtipovehiculo = $(this).attr("idtipovehiculo");

    $("#nuevaPlaca").val(idVehiculoClienteeleccionarVip);
    $("#tarifa").val(idtipovehiculo);
    $("#clienteVip").val("1");
    $("#modalSeleccionarVehiculoCliente").modal("hide");

})

$("#btnGuardarMontoCaja").on("click", function () {


    let montoCajaInicial = $("#montoCaja").val();
    let usuarioId = $("#usuarioId").val()

    let fecha = new Date()
    let dia = fecha.getDate()
    let mes = fecha.getMonth() + 1
    let year = fecha.getFullYear()
    let fechahoraComleta = year + "-" + mes + "-" + dia
    let datos = new FormData();
    datos.append("montoInicial", montoCajaInicial);
    datos.append("fechaCaja", fechahoraComleta);
    datos.append("usuarioId", usuarioId);
    datos.append("accion", "registrarMontoInicialCaja");

    $.ajax({
        url: "ajax/inicio.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta != "error") {

                $("#modalIngresarMontoCaja").modal("hide");

            } else {


            }
        }

    })

})
/*
$("#btnSalir").on("click", function () {
    window.location = "index.php?ruta=salir"
})

*/
function actualizarHora() {

    let fecha = new Date();
    let horas = fecha.getHours();
    let segundos = fecha.getSeconds();
    let minutos = fecha.getMinutes();
    let diaSemana = fecha.getDay();
    let semana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
    let dia = fecha.getDate();
    let mesNombre = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'setiembre', 'octubre', 'noviembre', 'diciembre'];
    let mes = fecha.getMonth();
    let year = fecha.getFullYear();
    let segundosPerdidos = "00";

    $("#horas").html(formatoHora(horas));
    $("#minutos").html(formatoHora(minutos));
    $("#segundos").html(formatoHora(segundos));
    $("#diaSemana").html(semana[diaSemana]);
    $("#dia").html(dia);
    $("#mes").html(mesNombre[mes]);
    $("#year").html(year);

    let horaIngreso = year + "-" + formatoHora(mes + 1) + "-" + formatoHora(dia) + " " + formatoHora(horas) + ":" + formatoHora(minutos) + ":" + formatoHora(segundosPerdidos);
    let horaIngresoSinSegundos = year + "-" + formatoHora(mes + 1) + "-" + formatoHora(dia) + " " + formatoHora(horas) + ":" + formatoHora(minutos) + ":00";

    $("#horaIngreso").val(horaIngreso);
    $("#horaSalida").val(horaIngresoSinSegundos);

}
function formatoHora(numero) {

    if (numero <= 9) {
        numero = "0" + numero
    }
    return numero;

}

/*=============================================   btnSalir
VERIFICAR PLACA
=============================================*/
$(".btnIngresar").click(function () {

    let nuevaPlaca = $("#nuevaPlaca").val();
    if (nuevaPlaca != "") {

        if (nuevaPlaca.length == 7 || nuevaPlaca.length == 6) {

            let datos = new FormData();
            datos.append("nuevaPlaca", nuevaPlaca);
            datos.append("accion", "verificarPlaca");

            $.ajax({
                url: "ajax/inicio.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    if (!respuesta) {

                        $("#formIngresoVehiculo").submit();

                    } else {

                        alert("La placa se encuentra duplicada");

                    }
                }

            })
        } else {

            alert("Por favor ingrese una placa válida");

        }





    }



});
let enviando = false; //Obligaremos a entrar el if en el primer submit

function checkSubmit() {
    if (!enviando) {
        enviando = true;
        return true;
    } else {
        //Si llega hasta aca significa que pulsaron 2 veces el boton submit
        alert("El formulario ya se esta enviando");
        return false;
    }
}


/*=============================================     
VERIFICAR PLACA
=============================================*/
$("#btnSalir").click(function () {

    let idCaja = $("#idCajaInicial").val();
    window.location = "index.php?ruta=inicio&idCaja="+idCaja;

});
