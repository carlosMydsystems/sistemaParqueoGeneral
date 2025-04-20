<?php

class ControladorAnulacion{

	/*=============================================
	REGISTRO DE NOTA DE CREDITO
	=============================================*/

	static public function ctrCreaAnulacion(){

		if(isset($_POST["motivoAnulacion"])){

	
				$tabla = "resumenboleta";

				$datos = array("comentarioResumen" => $_POST["motivoAnulacion"],    
                                "serialResumenBoleta" => $_POST["serial"],
                                "correlativoResumenBoleta" => $_POST["correlativoAnulacion"],
                                "estacionamientoId" => $_POST["idEstacionamiento"]);
                                
				$respuesta = ModeloAnulaciones::mdlCrearAnulacion($tabla, $datos);

				if($respuesta != "error"){

					echo '<script>

					swal({

						type: "success",
						title: "¡Se ha anulado de forma correcta el comprobante!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "index.php?ruta=anulacionElectronica&idAnulacion='.$respuesta.'";

						}

					});
				

					</script>';


				}else{
				    
				    echo '<script>
				
				    alert (esta es la resepuesta '.$respuesta.');
				
				</script>';
				    
				}
			}
	}

	/*=============================================      
	BUSCAR CORRELATIVO DE ANULACION
	=============================================*/

	static public function ctrCorrelativoAnulacion($numero, $serial){

				$tabla = "resumenboleta";
				
				$respuesta = ModeloAnulaciones::mdlCorrelativoAnulacion($tabla,$numero,$serial);
				
				//$respuesta = $numero;

				return $respuesta;

	}


	/*=============================================      
	BUSCAR CORRELATIVO DE RESUMEN BOLETA
	=============================================*/

	static public function ctrCorrelativoResumenBoleta($numero, $serial){

		$tabla = "resumenboleta";
		
		$respuesta = ModeloAnulaciones::mdlCorrelativoResumenBoleta($tabla,$numero,$serial);

		return $respuesta;

}
	
	
	/*=============================================
	MOSTRAR FACTURAS
	=============================================*/

	static public function ctrMostrarComprobantes($item, $valor){  

		$tabla = "estacionamiento";

		$respuesta = ModeloAnulaciones::mdlMostrarDocumentos($tabla, $item, $valor);

		return $respuesta;
	
	}
	
}