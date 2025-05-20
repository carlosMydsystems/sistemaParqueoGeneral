<?php

class ControladorCaja{

	/*=============================================    
			MOSTRAR EASTACIONAMIENTO PAGADO
	=============================================*/

	static public function ctrMostrarEstacionamientoPagado($item, $valor, $item1, $valor1){

		$tabla = "	estacionamiento es INNER JOIN tipovehiculo tv ON es.tipovehiculoid = tv.idtipovehiculo
					INNER JOIN caja ca ON es.cajaId = ca.idcaja";

		$respuesta = ModeloCaja::mdlMostrarEstacionamientoPagado($tabla, $item, $valor, $item1, $valor1);

		return $respuesta;
	}

	/*=============================================     
					MOSTRAR CAJA
	=============================================*/

	static public function ctrMostrarCajaUsuario($item, $valor, $item1, $valor1){

		$tabla = "caja";
		$respuesta = ModeloCaja::mdlMostrarCajaUsuario($tabla, $item, $valor, $item1, $valor1);
		return $respuesta;
	}
	
	/*=============================================     
					MOSTRAR CAJA
	=============================================*/

	static public function ctrMostrarCaja($item, $valor){
		$tabla = "caja";
		$respuesta = ModeloCaja::mdlMostrarCaja($tabla, $item, $valor );
		return $respuesta;
	}

	/*=============================================     
					MOSTRAR CAJA
	=============================================*/

	static public function ctrMostrarDetalleCaja($item, $valor){
		$tabla = "detallecaja";
		$respuesta = ModeloCaja::mdlMostrarCaja($tabla, $item, $valor );
		return $respuesta;
	}

	/*=============================================    
			AGREGAR DETALLE DE CAJA
	=============================================*/

	static public function ctrAgregarDetalleCaja(){
		if(isset($_POST["agregarMontoEgreso"])){
            
    		$tabla = "detallecaja";
    		$datos = array("montoEgreso" => $_POST["agregarMontoEgreso"],
    			           "concepto" => $_POST["agregarConcepto"],
    			           "cajaId" => $_POST["cajaId"]);
    
    		$respuesta = ModeloCaja::mdlCrearDetalleCaja($tabla, $datos);
    	
    		if($respuesta == "ok"){
    
    			echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Detalle de la Caja ha sido guardado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    
    				if(result.value){
    				
    					window.location = "caja";
    
    				}
    
    			});
    		
    			</script>';
    
    		}
        }
	}
	
	/*=============================================      ctrEliminarDetalleCaja
			ACTUALIZAR EL DETALLE DE LA CAJA
	=============================================*/
/*
	static public function ctrActualizarDetalleCaja(){
		if(isset($_POST["actualizarMontoEgreso"])){
            
    		$tabla = "detallecaja";
    		$datos = array("montoEgreso" => $_POST["actualizarMontoEgreso"],
    			           "concepto" => $_POST["actualizarConcepto"],
    			           "idDetalleCaja" => $_POST["actualizarIdDetalleCaja"]);
    
    		$respuesta = ModeloCaja::mdlActualizarDetalleCaja($tabla, $datos);
    	
    		if($respuesta == "ok"){
    
    			echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Detalle de la Caja ha sido actualizado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    				if(result.value){
    					window.location = "caja";
    				}
    			});
    		
    			</script>';
    
    		}
        }
	}
*/
	static public function ctrEliminarDetalleCaja(){

		if(isset($_GET["idDetalleCaja"])){

			$tabla = "detallecaja";
			$item = "idDetalleCaja";
			$valor = $_GET["idDetalleCaja"];

			$respuesta = ModeloCaja::mdlEliminarDetalleCaja($tabla,$item,$valor);

			if($respuesta == "ok"){
    
    			echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Detalle de la Caja ha sido eliminado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    				if(result.value){
    					window.location = "caja";
    				}
    			});
    		
    			</script>';
    
    		}

		}

	}

	/*=============================================     
			AGREGAR DETALLE DE CAJA
	=============================================*/

	static public function ctrCerrareCaja(){
		if(isset($_POST["actualizarMontoFinal"])){
            
    		$tabla = "caja";
    		$datos = array("montoFinal" => $_POST["actualizarMontoFinal"],
    			           "Comentario" => $_POST["actualizarObservacion"],
						   "estadoCaja" => "1",
    			           "idCaja" => $_POST["cerrarCajaId"]);
    
    		$respuesta = ModeloCaja::mdlCerrarCaja($tabla, $datos);
    	
    		if($respuesta == "ok"){
    
    			echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡La Caja ha sido Cerrada correctamente! El sistema se cerrará automáticamente",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    
    				if(result.value){
    				
    					window.location = "salir";
    
    				}
    
    			});
    		
    			</script>';
    
    		}
        }
	}


	static public function ctrEliminarCaja($idCaja){
		if(isset($_GET["idCaja"])){
			$tabla = "caja";
			$item = "idCaja";
			$valor = $_GET["idCaja"];

			$respuesta = ModeloCaja::mdlEliminarCaja($tabla,$item,$valor);

			if($respuesta == "ok"){
    
    			echo '<script>
					window.location = "salir";
    			</script>';
    
    		}

	}
}
	
}
	

