$(".tablas").on("click", ".btnEditarCliente", function(){
    
    let idCliente = $(this).attr("idCliente");
    let rucCliente = $(this).attr("rucCliente");
    let razonSocialCliente = $(this).attr("razonSocialCliente");
    let direccionFiscalCliente = $(this).attr("direccionFiscalCliente");

    $("#actualizarRuc").val(rucCliente);
    $("#actualizarRazonSocial").val(razonSocialCliente);
    $("#actualizarDireccionFiscal").val(direccionFiscalCliente);
    $("#idCliente").val(idCliente);

})   

$(".tablas").on("click", ".btnEliminarCliente", function(){
    
    let idCliente = $(this).attr("idCliente");

    window.location = "index.php?ruta=cliente&eliminarIdCliente="+idCliente;
    

}) 

    $(".tablas").on("click", ".btnVehiculos", function(){
    
    let idCliente = $(this).attr("idCliente");
    window.location = "index.php?ruta=vehiculosVip&idCliente="+idCliente;
 

})

$("#Soap").on("click", function(){
    
    let username="piro";
    let password="20551684157";
    $.ajax({
    type: "POST",
    url: "http://testing.bizlinks.com.pe/integrador21/ws/invoker?wsdl",
    dataType: 'xml',
    headers: {
    "Authorization": "Basic " + btoa(username + ":" + password)
    },
    success: function (result){
    console.log(result)
    }
    });
  
    
});




