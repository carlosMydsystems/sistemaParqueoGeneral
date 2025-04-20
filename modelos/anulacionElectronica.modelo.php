<?php

require_once "conexion.php";

class ModeloAnulacionesEletronicas{

	
	/*=============================================
	MOSTRAR ANULACIONES
	=============================================*/

	static public function mdlMostrarAnulaciones($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE $item = :$item");
		
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

	}

}