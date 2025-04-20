<?php

class ControladorReimpresion{



	/*=============================================    ctrEliminarTicket
	MOSTRAR VEHICULOS PARA REIMPRESION
	=============================================*/

	static public function ctrMostrarReimpresion($item, $valor){

		$tabla = "estacionamiento es INNER JOIN tipovehiculo tv ON es.tipovehiculoid = tv.idtipovehiculo";

		$respuesta = ModeloReimpresion::mdlMostrarReimpresion($tabla, $item, $valor);

		return $respuesta;
	}
	
	/*=============================================
	BORRAR TICKET DEL PARQUEO
	=============================================*/

	static public function ctrEliminarTicket(){

		if(isset($_GET["idEstacionamiento"])){

			$tabla ="estacionamiento";
			$datos = $_GET["idEstacionamiento"];

			$respuesta = ModeloReimpresion::mdlEliminarTicket($tabla, $datos);

			if($respuesta == "ok"){

				$url_path = 'https://www.mydsystems.com/AdministracionSanAndres/BackUp/eliminarRegistroBackUp.php?tabla='.$tabla.
                '&idEstacionamiento='.$datos.''; 

                $result = file_get_contents( 
                        $url_path, false, null); 

				echo'<script>

				swal({
					  type: "success",
					  title: "El Ticket ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "reimpresion";

								}
							})

				</script>';

			}		

		}

	}


}
	


