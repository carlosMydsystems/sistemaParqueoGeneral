$(".tablas").on("click",".btnReimprimir",function(){
    
    let idEstacionamiento = $(this).attr("idEstacionamiento");

    window.location = "index.php?ruta=imprime&idEstacionamiento="+idEstacionamiento;

})

$(".tablas").on("click",".btnAnularTicket",function(){
    
    let idEstacionamiento = $(this).attr("idEstacionamiento");
   
    swal({
        title: '¿Está seguro de borrar el registro del ticket?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, borrar ticket!'
        }).then(function(result){
    
        if(result.value){
    
            window.location = "index.php?ruta=reimpresion&idEstacionamiento="+idEstacionamiento;
    
        }
    
        })

    
 
})