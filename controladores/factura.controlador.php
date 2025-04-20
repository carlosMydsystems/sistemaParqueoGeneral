<?php

class ControladorFactura{
    
	/*============================================     
	MOSTRAR REGISTRO DEL ESTACIONAMIENTO
	=============================================*/ 

	static public function ctrMostrarEstacionamiento($item, $valor){

		$tabla = "estacionamiento es 
		INNER JOIN tipovehiculo tv ON es.tipovehiculoid = tv.idtipovehiculo";

		$respuesta = ModeloFactura::mdlMostrarEstacionamiento($tabla, $item, $valor);

		return $respuesta;
		
	}
	
	/*============================================     
	MOSTRAR DETALLE DEL ESTACIONAMIENTO
	=============================================*/ 

	static public function ctrMostrarDetalleEstacionamiento($item, $valor){

		$tabla = "estacionamiento es 
		INNER JOIN tipovehiculo tv ON es.tipovehiculoid = tv.idtipovehiculo";

		//$tabla = "estacionamiento";
        //$tabla = "detalleestacionamiento";
        
		$respuesta = ModeloFactura::mdlMostrarEstacionamiento($tabla, $item, $valor);
		
		//$respuesta = $item;

		return $respuesta;
		
	}
	
	/*============================================        
	MOSTRAR CORRELATIVO
	=============================================*/ 

	static public function ctrMostrarCorrelativoResumenBoleta($serial,$correlativoResumenBoleta){

		$tabla = "resumenboleta";

		$respuesta = ModeloFactura::mdlMostrarCorrelativoResumenBoleta($tabla,$serial,$correlativoResumenBoleta);

        //$respuesta = $serial;

		return $respuesta;
		
	}
	
	/*================================================           
	ACTUALIZAR ESTADO DEL REGISTRO DEL ESTACIONAMIENTO
	==================================================*/ 

	static public function ctrActualizarEstadoEstacionamiento($item, $valor,$item1, $valor1,$item2, $valor2){

		$tabla = "estacionamiento";

		$respuesta = ModeloFactura::mdlActualizarEstadoEstacionamiento($tabla,$item, $valor,$item1, $valor1,$item2, $valor2);

		return $respuesta;
		
	}

	/*================================================             
	ACTUALIZAR ESTADO DEL RESUMEN DEL ESTACIONAMIENTO
	==================================================*/ 

	static public function ctrRegistrarResumen($datos){

		$tabla = "resumenboleta";

		$respuesta = ModeloFactura::mdlRegistrarResumen($tabla, $datos);

		return $respuesta;
		
	}


}