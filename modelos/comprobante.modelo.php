<?php

require_once "conexion.php";

class ModeloComprobante{	

	/*=============================================
	MOSTRAR ASISTENCIA ALTERNO
	=============================================*/

	static public function mdlMostrarEstacionamiento($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();   

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}
	
	/*=============================================        
	MOSTRAR CORRELATIVO
	=============================================*/

	static public function mdlMostrarCorrelativoResumenBoleta($tabla,$serial,$correlativoResumenBoleta){

		$stmt = Conexion::conectar()->prepare("SELECT correlativoResumenBoleta FROM $tabla WHERE serialResumenBoleta = :serialResumenBoleta ORDER BY $correlativoResumenBoleta DESC LIMIT 1");

		$stmt -> bindParam(":serialResumenBoleta",$serial , PDO::PARAM_STR);
		
		$stmt -> execute();

		return $stmt -> fetch();   

	}	

	/*================================================        
	ACTUALIZAR ESTADO DEL REGISTRO DEL ESTACIONAMIENTO
	==================================================*/
	
	static public function mdlActualizarEstadoEstacionamiento($tabla,$item, $valor,$item1, $valor1,$item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1, $item2 = :$item2 WHERE $item = :$item");

		$stmt -> bindParam(":".$item,$valor , PDO::PARAM_INT);
		$stmt -> bindParam(":".$item1,$valor1 , PDO::PARAM_INT);
		$stmt -> bindParam(":".$item2,$valor2 , PDO::PARAM_STR);
		
		if($stmt -> execute()){
			return "Ok";
		}else{
			return "Error";
		}

	
	}	

	/*=============================================    
	MOSTRAR ASISTENCIA ALTERNO
	=============================================*/

	static public function mdlRegistrarResumen($tabla, $datos){

	
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(serialResumenBoleta,correlativoResumenBoleta,estadoResumen,comentarioResumen) VALUES (:serialResumenBoleta,:correlativoResumenBoleta,:estadoResumen,:comentarioResumen)");
        
		$stmt -> bindParam(":serialResumenBoleta", $datos["serialResumenBoleta"], PDO::PARAM_STR);
	    $stmt -> bindParam(":correlativoResumenBoleta", $datos["correlativoResumenBoleta"], PDO::PARAM_STR);
	    $stmt -> bindParam(":estadoResumen", $datos["estadoResumen"], PDO::PARAM_STR);
	    $stmt -> bindParam(":comentarioResumen", $datos["comentarioResumen"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}   

	}

	
}

