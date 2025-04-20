<?php

require_once "conexion.php";

class ModeloDetalleCaja{	

	/*=============================================  mdlTotalDetalleCaja
	MOSTRAR ASISTENCIA ALTERNO
	=============================================*/

	static public function mdlMostrarDetallesCaja($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();   

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	
	/*=============================================  
				CREAR DETALLE DE CAJA
	=============================================*/

	static public function mdlCrearDetalleCaja($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(montoEgreso, concepto, cajaId) VALUES (:montoEgreso, :concepto, :cajaId)");

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
				ACTUALIZAR DETALLE DE CAJA
	=============================================*/

	static public function mdlActualizarDetalleCaja($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET montoEgreso = :montoEgreso, concepto = :concepto WHERE idDetalleCaja = :idDetalleCaja");
		$stmt -> bindParam(":montoEgreso", $datos["montoEgreso"], PDO::PARAM_STR);
		$stmt -> bindParam(":concepto", $datos["concepto"], PDO::PARAM_STR);
		$stmt -> bindParam(":idDetalleCaja", $datos["idDetalleCaja"], PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}
	}

    	/*=============================================
    	ELIMINAR CLIENTE
    	=============================================*/
	
		static public function mdlEliminarDetalleCaja($tabla, $datos){

			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idDetalleCaja = :idDetalleCaja");
			$stmt -> bindParam(":idDetalleCaja", $datos['idDetalleCaja'], PDO::PARAM_INT);
	
			if($stmt -> execute()){
				return "ok";
			}else{
				return "error";
			}
		}

	/*=============================================  mdlTotalDetalleCaja
	MOSTRAR TOTAL DETALLA DE CAJA
	=============================================*/

	static public function mdlTotalDetalleCaja($tabla, $item, $valor){

		if($item != null){

			$montoEgreso = "montoEgreso";

			$stmt = Conexion::conectar()->prepare("SELECT SUM($montoEgreso) AS suma FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();   

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}
	
}