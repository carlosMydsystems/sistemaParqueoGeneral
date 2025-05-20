<?php

require_once "conexion.php";

class ModeloPago
{

	/*=============================================
	   MOSTRAR ASISTENCIA ALTERNO
	   =============================================*/

	static public function mdlMostrarPago($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll();

		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();

			return $stmt->fetchAll();

		}

	}

	/*=============================================    
	   MOSTRAR ASISTENCIA ALTERNO
	   =============================================*/

	static public function mdlPagarParqueo($tabla, $datos)
	{


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(placa,condicion,fechaingreso,tipovehiculoid) VALUES (:placa,:condicion,:fechaingreso,:tipovehiculoid)");

		$stmt->bindParam(":placa", $datos["nuevaPlaca"], PDO::PARAM_STR);
		$stmt->bindParam(":condicion", $datos["condicion"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaingreso", $datos["horaIngreso"], PDO::PARAM_STR);
		$stmt->bindParam(":tipovehiculoid", $datos["tarifa"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";

		} else {

			return "error";

		}

	}

	/*=============================================     
	   MOSTRAR CORRELATIVO
	   =============================================*/

	static public function mdlMostrarCorrelativo($tabla, $tipo, $numero)
	{

		$stmt = Conexion::conectar()->prepare("SELECT numerodocumento FROM $tabla WHERE tipodocumento = :tipoDocumento ORDER BY $numero DESC LIMIT 1");

		$stmt->bindParam(":tipoDocumento", $tipo, PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetch();
	}

	
	/*=============================================    
	   MOSTRAR CORRELATIVO
	   =============================================*/

	static public function mdlMostrarCorrelativoResumen($tabla, $item, $valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tipoCorrelativoId = :tipoCorrelativoId ORDER BY $item DESC LIMIT 1");

			$stmt->bindParam(":tipoCorrelativoId" , $valor, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch();
	}

	/*=============================================       
	MOSTRAR CORRELATIVO
	=============================================*/

	static public function mdlMostrarIdDetalleEstacionamientoAcumulado($tabla, $idEstacionamiento, $numero)
	{


		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estacionamientoId = :estacionamientoId AND estadoAcumulado = :estadoAcumulado");

		$stmt->bindParam(":estacionamientoId", $idEstacionamiento, PDO::PARAM_INT);
		$stmt->bindParam(":estadoAcumulado", $numero, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetchAll();

	}

	/*=============================================   
	   ACTUALIZAR PAGO 
	   =============================================*/

	static public function mdlActualizarPagoParqueo($tabla, $datos)
	{

		$dbh = Conexion::conectar();

		$stmt = $dbh->prepare("UPDATE $tabla SET condicion = :condicion, ruc = :ruc, tipoPago = :tipoPago,  
         montoPago = :montoPago, razonsocial = :razonsocial, direccionfiscal = :direccionfiscal, igvPago = :igvPago, 
         subtotalPago = :subtotalPago, tipoDocumento = :tipoDocumento, numerodocumento = :numerodocumento, serial = :serial, 
		 fechapago = :fechapago, cajaId = :cajaId, resumenId =:idResumenBoleta
         WHERE idEstacionamiento = :idEstacionamiento");

		if ($datos["tipoDocumento"] == "FACTURA") {
			$Cliente = $datos["razonSocialCliente"];
			$serial = "F001";
			$ruc = $datos["rucCliente"];
		} else {
			$Cliente = "CLIENTE";
			$serial = "B001";
			$ruc = $datos["dniCliente"]; 
		}
		$aux = 12;

		$stmt->bindParam(":serial", $serial, PDO::PARAM_STR);
		$stmt->bindParam(":razonsocial", $Cliente, PDO::PARAM_STR);
		$stmt->bindParam(":ruc", $ruc, PDO::PARAM_STR);
		$stmt->bindParam(":condicion", $datos["condicion"], PDO::PARAM_STR);
		$stmt->bindParam(":direccionfiscal", $datos["direccionFiscalCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":montoPago", $datos["monto"], PDO::PARAM_STR);
		$stmt->bindParam(":igvPago", $datos["igv"], PDO::PARAM_STR);
		$stmt->bindParam(":subtotalPago", $datos["subtotal"], PDO::PARAM_STR);
		$stmt->bindParam(":idEstacionamiento", $datos["idEstacionamiento"], PDO::PARAM_INT);
		$stmt->bindParam(":tipoDocumento", $datos["tipoDocumento"], PDO::PARAM_STR);
		$stmt->bindParam(":numerodocumento", $datos["numerodocumento"], PDO::PARAM_STR);
		$stmt->bindParam(":fechapago", $datos["fechaHoraSalidaVehicular"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoPago", $datos["tipoPago"], PDO::PARAM_STR); 
		$stmt->bindParam(":cajaId", $datos["cajaId"], PDO::PARAM_INT); 
		$stmt->bindParam(":idResumenBoleta", $datos["idResumenBoleta"], PDO::PARAM_INT); 

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
	}
}
