<?php

require_once "conexion.php";

class ModeloEnvioFallido{

	/*=============================================
	MOSTRAR Alumnos
	=============================================*/

	static public function mdlMostrarEstacionamientoEstado($tabla, $item, $valor, $valor1){

		if($item != null){


			// SELECT * FROM estacionamiento WHERE estadoFacturaBoleta <> "0" AND estadoFacturaBoleta <> "3"

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estadoFacturaBoleta <> :estadoFacturaBoleta1 AND estadoFacturaBoleta <> :estadoFacturaBoleta");

			$stmt -> bindParam(":estadoFacturaBoleta1", $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":estadoFacturaBoleta", $valor1, PDO::PARAM_STR);
			//$stmt -> bindParam(":estadoFacturaBoleta", $estado, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

	}

}