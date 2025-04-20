<?php

class ControladorEnvioFallido{



	/*=============================================
	MOSTRAR VEHICULOS PARA REIMPRESION
	=============================================*/

	static public function ctrMostrarEstacionamientoEstado($item, $valor, $valor1){

		$tabla = "estacionamiento es INNER JOIN tipovehiculo tv ON es.tipovehiculoid = tv.idtipovehiculo";
		$estado = "3";

		$respuesta = ModeloEnvioFallido::mdlMostrarEstacionamientoEstado($tabla, $item, $valor, $valor1);

		return $respuesta;
	}

}
	


