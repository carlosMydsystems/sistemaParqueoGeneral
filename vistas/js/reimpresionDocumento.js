$(".tablas").on("click",".btnReimprimirDocumento",function(){
    
    let idEstacionamiento = $(this).attr("idEstacionamiento");
    window.location = "index.php?ruta=reimprimeDocumento&idEstacionamiento="+idEstacionamiento;

})

