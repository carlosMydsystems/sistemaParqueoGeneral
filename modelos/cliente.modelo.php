<?php

require_once "conexion.php";

class ModeloCliente{
    
    /*=============================================   
	MOSTRAR CLIENTES
	=============================================*/

	static public function MdlMostrarClientes($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
	}
  


	/*=============================================
	REGISTRO DE CLIENTE
	=============================================*/

	static public function mdlCrearCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ruc, razonSocial, direccionFiscal) VALUES (:ruc, :razonSocial, :direccionFiscal)");

		$stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt->bindParam(":razonSocial", $datos["razonSocial"], PDO::PARAM_STR);
		$stmt->bindParam(":direccionFiscal", $datos["direccionFiscal"], PDO::PARAM_STR);
	

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}


	}

	
	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ruc = :ruc, razonSocial = :razonSocial, direccionFiscal = :direccionFiscal WHERE idCliente = :idCliente");
		$stmt -> bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt -> bindParam(":razonSocial", $datos["razonSocial"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccionFiscal", $datos["direccionFiscal"], PDO::PARAM_STR);
		$stmt -> bindParam(":idCliente", $datos["idCliente"], PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}
	}
	
    	/*=============================================
    	ELIMINAR CLIENTE
    	=============================================*/
	
		static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idCliente = :idCliente");
		$stmt -> bindParam(":idCliente", $datos['idCliente'], PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}
	}
}

