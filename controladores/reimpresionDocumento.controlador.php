<?php

class ControladorReimpresionDocumentos{



	/*=============================================    
	MOSTRAR VEHICULOS PARA REIMPRESION DE DOCUMENTOS
	=============================================*/

	static public function ctrMostrarReimpresionDocumentos($item, $valor,$item1, $valor1){

		$tabla = "estacionamiento es INNER JOIN tipovehiculo tv ON es.tipovehiculoid = tv.idtipovehiculo";

		$respuesta = ModeloReimpresionDocumento::mdlMostrarReimpresionDocumento($tabla, $item, $valor, $item1, $valor1);

		return $respuesta;
	}
	


}
	


