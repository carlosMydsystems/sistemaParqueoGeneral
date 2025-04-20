<?php

class ControladorDetalleCaja{
    
	/*============================================   
	MOSTRAR TARIFAS 
	=============================================*/   

	static public function ctrTotalDetalleCaja($item, $valor){

		$tabla = "caja ca INNER JOIN detallecaja dc ON  ca.idCaja = dc.cajaId";

		$respuesta = ModeloDetalleCaja::mdlTotalDetalleCaja($tabla, $item, $valor);

		return $respuesta;
		
	}

	/*============================================   
	MOSTRAR TARIFAS 
	=============================================*/   

	static public function ctrMostrarDetallesCaja($item, $valor){

		$tabla = "detalleCaja";

		$respuesta = ModeloDetalleCaja::mdlMostrarDetallesCaja($tabla, $item, $valor);

		return $respuesta;
		
	}
	
    /*============================================      ctrActualizarDetalleCaja
            CREAR DETALLE DE LA CAJA 
    =============================================*/ 
    
    static public function ctrCrearDetalleCaja(){
    
        if(isset($_POST["montoEgreso"])){ 
            $tabla = "detalleCaja";
 
            $datos = array( "montoEgreso" => $_POST["montoEgreso"],
                            "concepto" => $_POST["conceptoEgreso"],
                            "cajaId" => $_POST["cajaId"]); 
 
            $respuesta = ModeloDetalleCaja::mdlCrearDetalleCaja($tabla, $datos);

            if($respuesta == "ok"){

                echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Detalle de la caja ha sido guardado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    
    				if(result.value){
    				
    					window.location = "detalleCaja";
    
    				}
    
    			});
    		
    			</script>';
    
    		}

        }
    
    }
    	
    /*============================================        ctrEliminarDetalleCaja
            CREAR DETALLE DE LA CAJA 
    =============================================*/ 
    
    static public function ctrActualizarDetalleCaja(){
    
        if(isset($_POST["actualizarMontoEgreso"])){ 
            $tabla = "detalleCaja";
 
            $datos = array( "montoEgreso" => $_POST["actualizarMontoEgreso"],
                            "concepto" => $_POST["actualizarConceptoEgreso"],
                            "idDetalleCaja" => $_POST["actualizaDetalleCajaId"]); 
 
            $respuesta = ModeloDetalleCaja::mdlActualizarDetalleCaja($tabla, $datos);

            if($respuesta == "ok"){

                echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Detalle de la caja ha sido guardado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    
    				if(result.value){
    				
    					window.location = "detalleCaja";
    
    				}
    
    			});
    		
    			</script>';
    
    		}

        }
    
    }


    /*=============================================   ctrEliminarCliente
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrEliminarDetalleCaja(){

        if(isset($_GET["idDetalleCaja"])){
            
    		$tabla = "detalleCaja";
    		$datos = array("idDetalleCaja" => $_GET["idDetalleCaja"]);
    
    		$respuesta = ModeloDetalleCaja::mdlEliminarDetalleCaja($tabla, $datos);
    	
    		if($respuesta == "ok"){
    
    			echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Detalle de caja ha sido eliminado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    
    				if(result.value){
    				
    					window.location = "detalleCaja";
    
    				}
    
    			});
    		
    			</script>';
    
    		}
        }

	}

}
	


