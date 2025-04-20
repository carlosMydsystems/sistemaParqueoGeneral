$(document).ready(function () {
    let montoTotal = parseFloat($("#montoTotal").val())
    let montoInicial = parseFloat($("#montoInicial").val())  
    let montoDetalleCaja = parseFloat($("#montoDetalleCaja").val())  
    let montoIdealCaja = montoTotal + montoInicial
    let montoFinalCaja = montoIdealCaja - montoDetalleCaja

    $("#muestraMontoTotal").html(montoTotal.toFixed(2))
    $("#montoInicialCaja").html(montoInicial.toFixed(2))
    $("#muestraMontoCaja").html(montoDetalleCaja.toFixed(2))
    $("#muestraMontoDetalleCaja").html(montoFinalCaja.toFixed(2))
});

$(".btnDetalleCaja").on("click", function () {

    let btnAgregarSalidaCaja = $(this).attr("idCaja")
    $("#envioDetalleCaja").submit()

})

$(".btnEditarDetalleCaja").on("click", function () {
    let idDetalleCaja = $(this).attr("idDetalleCaja")
    

    let datos = new FormData();
    datos.append("idDetalleCaja", idDetalleCaja);
    datos.append("accion", "mostrarDetalleCaja");

    $.ajax({
        url: "ajax/caja.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {  

            $("#modalEditarCaja").modal("show")

            $("#actualizarMontoEgreso").val(respuesta[0]["montoEgreso"]);
            $("#actualizarConcepto").val(respuesta[0]["concepto"]);
            $("#actualizarIdDetalleCaja").val(respuesta[0]["idDetalleCaja"]);

        }

    })



})   

$(".btnAgregarDetalleCaja").on("click", function () {

    $("#modalAgregarCaja").modal("show")

})

$(".btnCerrarCaja").on("click", function () {

    $("#modalCerrarCaja").modal("show")


})