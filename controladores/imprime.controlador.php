<?php

class ControladorImpresion{
    

    
    /*============================================     
	MOSTRAR CLIENTES 
	=============================================*/ 

	static public function ctrMostrarVehiculo($item, $valor){

		$tabla = "estacionamiento";

		$respuesta = ModeloImpresion::MdlMostrarVehiculo($tabla, $item, $valor);

		return $respuesta;
		
	}

}	