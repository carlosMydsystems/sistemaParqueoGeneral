<?php

require_once "conexion.php";

class ModeloVehiculoVip{
    
    /*=============================================   
	MOSTRAR CLIENTES
	=============================================*/

	static public function MdlMostrarVehiculoCliente($tabla, $item, $valor){

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
	REGISTRO DE VEHICULO DEL CLIENTE
	=============================================*/

	static public function mdlCrearVehiculoCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(placa, tipoVehiculoId, clienteId) VALUES (:placa, :tipoVehiculoId, :clienteId)");

		$stmt->bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoVehiculoId", $datos["tipoVehiculoId"], PDO::PARAM_STR);
		$stmt->bindParam(":clienteId", $datos["clienteId"], PDO::PARAM_STR);
	

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

	}

	
	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarVehiculoCliente($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET placa = :placa, tipoVehiculoId = :tipoVehiculoId WHERE idVehiculoClienteVip = :idVehiculoClienteVip");

		$stmt -> bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipoVehiculoId", $datos["tipoVehiculoId"], PDO::PARAM_STR);
		$stmt -> bindParam(":idVehiculoClienteVip", $datos["idVehiculoClienteVip"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

	}
	
    	/*=============================================
    	ELIMINAR CLIENTE
    	=============================================*/
	
		static public function mdlEliminarVehiculoCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idVehiculoClienteVip = :idVehiculoClienteVip");

		$stmt -> bindParam(":idVehiculoClienteVip", $datos['idVehiculoClienteVip'], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


	}
	
	

}

