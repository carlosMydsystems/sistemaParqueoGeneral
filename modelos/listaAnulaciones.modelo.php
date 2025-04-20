<?php

require_once "conexion.php";

class ModeloListaAnulaciones{


	/*=============================================
	MOSTRAR LISTA NOTAS DE CREDITO
	=============================================*/

	static public function ctrMostrarListaAnulaciones($tabla, $item, $valor){



		if($item != null){

			//  $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE $item = :$item AND condicion = :condicion");
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE condicion = :condicion");
			
			$stmt -> bindParam(":condicion", $valor["condicion"], PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			//$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE condicion = :condicion");
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			
			$stmt -> bindParam(":condicion", $valor["condicion"], PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}
}