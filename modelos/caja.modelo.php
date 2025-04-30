<?php

require_once "conexion.php";

class ModeloCaja{

	/*=============================================      
					MOSTRAR CAJA
	=============================================*/

	static public function mdlMostrarEstacionamientoPagado($tabla, $item, $valor, $item1, $valor1){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item1 = :$item1 ");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetch();

		}
	}

	/*=============================================      
					MOSTRAR CAJA
	=============================================*/

	static public function mdlMostrarCajaUsuario($tabla, $item, $valor, $item1, $valor1){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item1 = :$item1 ");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetch();

		}
	}

	
	/*=============================================       
					MOSTRAR CAJA
	=============================================*/

	static public function mdlMostrarCaja($tabla, $item, $valor){

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
			REGISTRO DE DETALLE DE CAJA
	=============================================*/

	static public function mdlCrearDetalleCaja($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(montoEgreso, concepto, cajaId) 
													  VALUES (:montoEgreso, :concepto, :cajaId)");

		$stmt->bindParam(":montoEgreso", $datos["montoEgreso"], PDO::PARAM_STR);
		$stmt->bindParam(":concepto", $datos["concepto"], PDO::PARAM_STR);
		$stmt->bindParam(":cajaId", $datos["cajaId"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}


	}
	/*=============================================      
		   ACTUALIZACION DE DETALLE DE CAJA
	=============================================*/

	static public function mdlCerrarCaja($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET montoFinal =:montoFinal, Comentario=:Comentario 
													  ,estadoCaja=:estadoCaja 
													  WHERE idCaja =:idCaja");

		$stmt->bindParam(":montoFinal", $datos["montoFinal"], PDO::PARAM_STR);
		$stmt->bindParam(":Comentario", $datos["Comentario"], PDO::PARAM_STR);
		$stmt->bindParam(":idCaja", $datos["idCaja"], PDO::PARAM_STR);
		$stmt->bindParam(":estadoCaja", $datos["estadoCaja"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

	}

	/*=============================================      
		   ACTUALIZACION DE DETALLE DE CAJA
	=============================================*/

	static public function mdlEliminarDetalleCaja($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";	
		}else{
			return "error";
		}
	}

	/*=============================================      
		   			ELIMINAR CAJA
	=============================================*/

	static public function mdlEliminarCaja($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";	
		}else{
			return "error";
		}
	}


}