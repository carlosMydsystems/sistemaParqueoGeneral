<?php

require_once "conexion.php";

class ModeloReimpresion{

	/*=============================================    
	MOSTRAR ESTACIONAMIENTO
	=============================================*/

	static public function mdlMostrarReimpresion($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

	}


	/*=============================================
	BORRAR TICKET
	=============================================*/

	static public function mdlEliminarTicket($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idEstacionamiento = :idEstacionamiento");

		$stmt -> bindParam(":idEstacionamiento", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

	}

}