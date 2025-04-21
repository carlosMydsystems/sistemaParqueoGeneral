<?php

require_once "conexion.php";

class ModeloInicio{	

	/*=============================================     
	MOSTRAR ASISTENCIA ALTERNO
	=============================================*/

	static public function mdlMostrarTarifas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();   

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
	}

	/*=============================================     
	MOSTRAR ASISTENCIA ALTERNO
	=============================================*/

	static public function mdlMostrarCaja($tabla, $datos){

		if($datos != null){

			$stmt = Conexion::conectar()->prepare("	SELECT * FROM $tabla 
															WHERE 
															usuarioId = :usuarioId 
															AND 
															estadoCaja = :estadoCaja");
			$stmt -> bindParam(":estadoCaja", $datos["estadoCaja"], PDO::PARAM_STR);
			$stmt -> bindParam(":usuarioId", $datos["usuarioId"], PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();   

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
	}
	
	/*=============================================
	MOSTRAR VERIFICAR PLACA
	=============================================*/

	static public function mdlVerificarPlaca($tabla, $item, $valor,$condicion){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND condicion = :condicion");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":condicion", $condicion, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
	}
	
	/*=============================================  
	REGISTRAR VEHICULO
	=============================================*/


	static public function mdlRegistroVehiculo($tabla, $datos){

	    $dbh = Conexion::conectar();
	
        $stmt = $dbh -> prepare("INSERT INTO $tabla(placa,condicion,tipovehiculoid,clienteVip,numerodocumento,fechaingreso) VALUES (:placa,:condicion,:tipovehiculoid,:clienteVip,:numerodocumento,:fechaingreso)");
        
		$stmt -> bindParam(":placa", $datos["nuevaPlaca"], PDO::PARAM_STR);
	    $stmt -> bindParam(":condicion", $datos["condicion"], PDO::PARAM_STR);
	    $stmt -> bindParam(":tipovehiculoid", $datos["tarifa"], PDO::PARAM_INT);
	    $stmt -> bindParam(":clienteVip", $datos["clienteVip"], PDO::PARAM_INT);
	    $stmt -> bindParam(":numerodocumento", $datos["numerodocumento"], PDO::PARAM_INT);
	    $stmt -> bindParam(":fechaingreso", $datos["horaIngreso"], PDO::PARAM_STR);

		if($stmt->execute()){
		    
    		return $dbh->lastInsertId();
    	    
		}else{
			return "error";
		}   
	}

	static public function mdlRegistrarMontoCaja($tabla, $datos){

		$dbc = Conexion::conectar();
		$stmt = $dbc->prepare(query: "INSERT INTO $tabla(montoInicial,fechaCaja,usuarioId ) VALUES (:montoInicial,:fechaCaja,:usuarioId)");

		$stmt->bindParam(":montoInicial", $datos["montoInicial"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaCaja", $datos["fechaCaja"], PDO::PARAM_STR);
		$stmt->bindParam(":usuarioId", $datos["usuarioId"], PDO::PARAM_STR);

		if($stmt->execute()){
			return $dbc->lastInsertId();	
		}else{
			return "error";
		}
	}

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarMontoInicialCaja($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET montoInicial = :montoInicial WHERE idCaja = :idCaja");
		$stmt -> bindParam(":montoInicial", $datos["montoInicial"], PDO::PARAM_STR);
		$stmt -> bindParam(":idCaja", $datos["idCaja"], PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}
	}

}