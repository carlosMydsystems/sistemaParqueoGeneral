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

	/*===================================== 
				CREAR CAJA
	=======================================*/

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



	/*===================================== 
				CREAR CAJA
	=======================================*/

	static public function mdlRegistrarResumen($tabla, $datos){

		$dbh = Conexion::conectar();
		
		$stmt = $dbh->prepare("INSERT INTO $tabla(correlativo,fechaEnvio,estadoCorrelativo,tipoCorrelativoId) 
		VALUES (:correlativo,:fechaEnvio,:estadoCorrelativo,:tipoCorrelativoId)");

		$stmt->bindParam(":correlativo", $datos["correlativo"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaEnvio", $datos["fechaEnvio"], PDO::PARAM_STR);
		$stmt->bindParam(":estadoCorrelativo", $datos["estadoCorrelativo"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoCorrelativoId", $datos["tipoCorrelativoId"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return $dbh->lastInsertId();
		} else {
			return "error";
		}
	}

}