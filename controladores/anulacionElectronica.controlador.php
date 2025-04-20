<?php

class ControladorAnulacionElectronica{

		/*=============================================
    	MOSTRAR ANULACIONES
    	=============================================*/
    
    	static public function ctrMostrarAnulaciones($item, $valor){  
    
            $tabla = "resumenboleta rb INNER JOIN estacionamiento es ON rb.estacionamientoId = es.idEstacionamiento";
    
    		$respuesta = ModeloAnulacionesEletronicas::mdlMostrarAnulaciones($tabla, $item, $valor);
    
    		return $respuesta;
    	
    	}
	
	
}