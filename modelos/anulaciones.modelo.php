<?php

require_once "conexion.php";

class ModeloAnulaciones{

	/*=============================================
	CREAR NOTA DE CREDITO
	=============================================*/
	
	static public function mdlCrearAnulacion($tabla, $datos){

		$dbh = Conexion::conectar();
		
		$stmt = $dbh->prepare("INSERT INTO $tabla (comentarioResumen,estacionamientoId,serialResumenBoleta,correlativoResumenBoleta) 
		        VALUES (:comentarioResumen,:estacionamientoId,:serialResumenBoleta,:correlativoResumenBoleta)");
        
        $stmt->bindParam(":comentarioResumen", $datos['comentarioResumen'], PDO::PARAM_STR);
		$stmt->bindParam(":estacionamientoId", $datos['estacionamientoId'], PDO::PARAM_STR);
		$stmt->bindParam(":serialResumenBoleta", $datos['serialResumenBoleta'], PDO::PARAM_STR);
		$stmt->bindParam(":correlativoResumenBoleta", $datos['correlativoResumenBoleta'] , PDO::PARAM_STR);

		if($stmt->execute()){
		    
		    $lastInsertId = $dbh -> lastInsertId();

			return $lastInsertId;

		}else{

			return "error";
		
		}
   
	    }
	    
	    
	/*=============================================     
	CORRELATIVO DE LA ANULACION
	=============================================*/
	
	static public function mdlCorrelativoAnulacion($tabla,$numero,$serial){  
	    
	    $stmt = Conexion::conectar()->prepare("SELECT correlativoResumenBoleta FROM $tabla WHERE serialResumenBoleta = :serialResumenBoleta ORDER BY correlativoResumenBoleta DESC LIMIT 1");

		$stmt -> bindParam(":serialResumenBoleta",$serial , PDO::PARAM_STR);

	    $stmt->execute();
	    
	    return $stmt -> fetch();
	    //return $stmt -> fetchAll();

	}


	/*=============================================     
	CORRELATIVO DE LA ANULACION
	=============================================*/
	
	static public function mdlCorrelativoResumenBoleta($tabla,$numero,$serial){  
	    
	  
	    
	    $stmt = Conexion::conectar()->prepare("SELECT correlativoResumenBoleta FROM $tabla WHERE serialResumenBoleta = :serialResumenBoleta ORDER BY correlativoResumenBoleta DESC LIMIT 1");

		$stmt -> bindParam(":serialResumenBoleta",$serial , PDO::PARAM_STR);

	    $stmt->execute();
	    
	    return $stmt -> fetch();
	    //return $stmt -> fetchAll();

	}
	
	/*=============================================
	MOSTRAR VEHICULOS
	=============================================*/

	static public function mdlMostrarDocumentos($tabla, $item, $valor){

		if($item != null){

			//  $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE $item = :$item AND condicion = :condicion");
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE condicion = :condicion AND estadoFacturaBoleta = :estadoFacturaBoleta");
			
			$stmt -> bindParam(":condicion", $valor["condicion"], PDO::PARAM_STR);
			$stmt -> bindParam(":estadoFacturaBoleta", $valor["estadoFacturaBoleta"], PDO::PARAM_STR);

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