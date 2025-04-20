<?php

class ControladorListaAnulaciones{

	/*=============================================
	MOSTRAR FACTURAS
	=============================================*/

	static public function ctrMostrarListaAnulaciones($item, $valor){  


        $tabla = "anulaciones an 
        INNER JOIN estacionamiento es ON an.estacionamientoId = es.idEstacionamiento";

        //$tabla = "anulaciones";
        

		$respuesta = ModeloListaAnulaciones::ctrMostrarListaAnulaciones($tabla, $item, $valor);

		return $respuesta;
	
	}
}