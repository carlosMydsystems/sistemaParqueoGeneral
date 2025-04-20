<?php

class ControladorVehiculoVip{   

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarVehiculoCliente($item, $valor){

		$tabla = "vehiculoClienteVip vc 
		INNER JOIN tipovehiculo tv ON vc.tipoVehiculoId = tv.idtipovehiculo
		INNER JOIN cliente cl ON cl.idCliente = vc.clienteId";

		$respuesta = ModeloVehiculoVip::MdlMostrarVehiculoCliente($tabla, $item, $valor);

		return $respuesta;
	}

	
	/*=============================================
    	REGISTRO DE VEHICULO DE CLIENTE
	=============================================*/

	static public function ctrCrearVehiculoCliente(){
	    
        if(isset($_POST["placaVehiculo"])){
            
    		$tabla = "vehiculoClienteVip";
    		$datos = array("placa" => $_POST["placaVehiculo"],
    			           "tipoVehiculoId" => $_POST["tarifaCliente"],
    			           "clienteId" => $_SESSION['idCliente']);
    
    		$respuesta = ModeloVehiculoVip::mdlCrearVehiculoCliente($tabla, $datos);
    	
    		if($respuesta == "ok"){
    
    			echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Cliente ha sido guardado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    
    				if(result.value){
    				
    					window.location = "index.php?ruta=vehiculosVip";
    
    				}
    
    			});
    		
    			</script>';
    
    		}
        }

	}
	
	/*=============================================   
	ACTUALIZAR VEHICULO DEL CLIENTE
	=============================================*/
	
	/*
	actualizarPlacaVehiculo
	actualizarTarifaCliente
	idVehiculoClienteVip
	
*/                         
	static public function ctrActualizarVehiculoCliente(){

        if(isset($_POST["actualizarPlacaVehiculo"])){
            
    		$tabla = "vehiculoClienteVip";    
    		if(isset($_POST["clienteVip"])){
    		    
        		$datos = array("placa" => $_POST["actualizarPlacaVehiculo"],
        			           "tipoVehiculoId" => $_POST["actualizarTarifaCliente"],
        			           "clienteVip" => $_POST["clienteVip"],
        			           "idVehiculoClienteVip" => $_POST["idVehiculoClienteVip"]);
    			           
    		}else{
    		    
    		    $datos = array("placa" => $_POST["actualizarPlacaVehiculo"],
    			               "tipoVehiculoId" => $_POST["actualizarTarifaCliente"],
    			               "idVehiculoClienteVip" => $_POST["idVehiculoClienteVip"]);
    		    
    		}
    
    		$respuesta = ModeloVehiculoVip::mdlActualizarVehiculoCliente($tabla, $datos);

    		if($respuesta == "ok"){
    
    			echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Cliente ha sido guardado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    
    				if(result.value){
    				
    					window.location = "vehiculosVip";
    
    				}
    
    			});
    		
    			</script>';
    
    		}
        }

	}

	/*=============================================   
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrEliminarVehiculoCliente(){

        if(isset($_GET["idVehiculoClienteEliminarVip"])){
            
    		$tabla = "vehiculoClienteVip";
    		$datos = array("idVehiculoClienteVip" => $_GET["idVehiculoClienteEliminarVip"]);
    
    		$respuesta = ModeloVehiculoVip::mdlEliminarVehiculoCliente($tabla, $datos);
    	
    		if($respuesta == "ok"){
    
    			echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Cliente ha sido guardado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    
    				if(result.value){
    				
    					window.location = "vehiculosVip";
    
    				}
    
    			});
    		
    			</script>';
    
    		}
        }

	}

	

}
