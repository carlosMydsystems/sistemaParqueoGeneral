<?php

class ControladorCliente{   

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarCliente($item, $valor){

		$tabla = "cliente";

		$respuesta = ModeloCliente::MdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;
	}

	
	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearCliente(){
	    
        if(isset($_POST["ruc"])){
            
    		$tabla = "cliente";
    		$datos = array("ruc" => $_POST["ruc"],
    			           "razonSocial" => $_POST["razonSocial"],
    			           "direccionFiscal" => $_POST["direccionFiscal"]);
    
    		$respuesta = ModeloCliente::mdlCrearCliente($tabla, $datos);
    	
    		if($respuesta == "ok"){
    
    			echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Cliente ha sido guardado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    
    				if(result.value){
    				
    					window.location = "cliente";
    
    				}
    
    			});
    		
    			</script>';
    
    		}
        }

	}
	
	/*=============================================   
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrActualizarCliente(){

        if(isset($_POST["actualizarRuc"])){
            
    		$tabla = "cliente";
    		$datos = array("ruc" => $_POST["actualizarRuc"],
    			           "razonSocial" => $_POST["actualizarRazonSocial"],
    			           "idCliente" => $_POST["idCliente"],
    			           "direccionFiscal" => $_POST["actualizarDireccionFiscal"]);
    
    		$respuesta = ModeloCliente::mdlActualizarCliente($tabla, $datos);
    	
    		if($respuesta == "ok"){
    
    			echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Cliente ha sido guardado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    
    				if(result.value){
    				
    					window.location = "cliente";
    
    				}
    
    			});
    		
    			</script>';
    
    		}
        }

	}

	/*=============================================   ctrEliminarCliente
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrEliminarCliente(){

        if(isset($_GET["eliminarIdCliente"])){
            
    		$tabla = "cliente";
    		$datos = array("idCliente" => $_GET["eliminarIdCliente"]);
    
    		$respuesta = ModeloCliente::mdlEliminarCliente($tabla, $datos);
    	
    		if($respuesta == "ok"){
    
    			echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Cliente ha sido guardado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    
    				if(result.value){
    				
    					window.location = "cliente";
    
    				}
    
    			});
    		
    			</script>';
    
    		}
        }

	}

	

}
