<?php

require_once "conexion.php";

class ModeloReimpresionDocumento{

	/*=============================================    
	MOSTRAR ESTACIONAMIENTO
	=============================================*/

	static public function mdlMostrarReimpresionDocumento($tabla, $item, $valor, $item1, $valor1){

		$fechaInicial = $valor1. " 00:00:00";
		$fechaFinal = $valor1. " 23:59:59";

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ($item1 >= :fInicial AND $item1 <= :fFinal)");

			//$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":fInicial", $fechaInicial, PDO::PARAM_STR);
			$stmt -> bindParam(":fFinal", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

	}

}