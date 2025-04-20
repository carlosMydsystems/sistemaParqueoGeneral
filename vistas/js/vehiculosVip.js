

$(".tablas").on("click",".btnEditarVehiculoCliente",function(){
    
    let idVehiculoClienteVip = $(this).attr("idVehiculoClienteVip");  
    let actualizarPlaca = $(this).attr("actualizarPlaca");
    let tipoVehiculoId= $(this).attr("tipoVehiculoId");
    
    $("#actualizarTarifaCliente").val(tipoVehiculoId);
    $("#actualizarPlacaVehiculo").val(actualizarPlaca);
    $("#idVehiculoClienteVip").val(idVehiculoClienteVip);
    
    alert(idVehiculoClienteVip)    

})

$(".tablas").on("click",".btnEliminarVehiculoCliente",function(){
    
    let idVehiculoClienteEliminarVip = $(this).attr("idVehiculoClienteEliminarVip");  
  
    window.location = "index.php?ruta=vehiculosVip&idVehiculoClienteEliminarVip="+idVehiculoClienteEliminarVip;
    alert(idVehiculoClienteEliminarVip)    

})