<?php

require_once "conexion.php";

class ModeloLogin{

	/*=============================================    
				MOSTRAR CAJA
	=============================================*/

	static public function mdlMostrarCaja($tabla, $datos){

		if($datos != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuarioId = :usuarioId AND estadoCaja = :estadoCaja");
			$stmt -> bindParam(":usuarioId", $datos['usuarioId'], PDO::PARAM_INT);
			$stmt -> bindParam(":estadoCaja", $datos['estadoCaja'], PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
	}
	/*=============================================    mdlCrearCaja
				MOSTRAR CAJA
	=============================================*/

	static public function mdlCrearCaja($tabla, $datos){

		$dbh = Conexion::conectar();
		
		$stmt = $dbh->prepare("INSERT INTO $tabla(usuarioId,fechaCaja,estadoCaja) 
		VALUES (:usuarioId,:fechaCaja,:estadoCaja)");

		$stmt->bindParam(":usuarioId", $datos["usuarioId"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaCaja", $datos["fechaCaja"], PDO::PARAM_STR);
		$stmt->bindParam(":estadoCaja", $datos["estadoCaja"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return $dbh->lastInsertId();

		} else {

			return "error";

		}

	}

}