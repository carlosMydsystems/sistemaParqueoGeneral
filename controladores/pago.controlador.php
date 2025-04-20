<?php

class ControladorPago{
    
	/*============================================   
	VERIFICAR PAGOS
	=============================================*/ 

	static public function ctrVerificarPago($item, $valor){

		$tabla = "estacionamiento es 
		INNER JOIN tipovehiculo tv ON es.tipovehiculoid = tv.idtipovehiculo
		INNER JOIN detalleestacionamiento de ON de.estacionamientoId = es.idEstacionamiento";

		$respuesta = ModeloPago::mdlMostrarPago($tabla, $item, $valor);

		return $respuesta;
		
	}
	
    /*============================================   
    REGISTRAR VEHICULO
    =============================================*/ 
    
    static public function ctrRegistroVehiculo(){
    
        if(isset($_POST["accion"]) && $_POST["accion"]=="registrarVehiculo"){
            $tabla = "estacionamiento";
            $datos = array("nuevaPlaca" => $_POST["nuevaPlaca"],
                           "condicion" => $_POST["condicion"],
                           "horaIngreso" => $_POST["horaIngreso"],
                           "tarifa" => $_POST["tarifa"]);
            
            $respuesta = ModeloInicio::mdlRegistroVehiculo($tabla, $datos);

            if($respuesta == "ok"){
            
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡Se ha registrado el vehiculo correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            alert('.$datos['nuevaPlaca'].')
                        }
                    });
                    </script>';
            }
            return $respuesta;
        }
    
    }
    
    /*============================================     
	MOSTRAR CLIENTES 
	=============================================*/ 

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "cliente";

		$respuesta = ModeloPago::mdlMostrarPago($tabla, $item, $valor);

		return $respuesta;
		
	}
	
	
	/*============================================     
	MOSTRAR CORRELATIVO 
	=============================================*/ 

	static public function ctrMostrarCorrelativo($item, $valor){

		$tabla = "estacionamiento";

		$respuesta = ModeloPago::mdlMostrarCorrelativo($tabla, $item, $valor);

		return $respuesta;
		
	}

	
	 /*============================================   
	ACTUALIZAR PAGO DE PARQUEO 
	=============================================*/ 

	static public function ctrActualizarPagoParqueo($valor){

		$tabla = "estacionamiento";
		$respuesta = ModeloPago::mdlActualizarPagoParqueo($tabla,$valor);
	
		return $respuesta;
		
	}

	
	 /*============================================        
	MOSTRAR ID DETALLE ESTACIONAMIENTO ACUMULADO DE PARQUEO 
	=============================================*/ 

	static public function ctrMostrarIdDetalleEstacionamientoAcumulado($idEstacionamiento, $numero){

		$tabla = "detalleestacionamiento de 
		INNER JOIN estacionamiento es ON de.estacionamientoId = es.idEstacionamiento
		INNER JOIN tipovehiculo tv ON tv.idtipovehiculo = es.tipovehiculoid";
		$respuesta = ModeloPago::mdlMostrarIdDetalleEstacionamientoAcumulado($tabla,$idEstacionamiento, $numero);
		
		//return $tabla;
		
		return $respuesta;
		
	}
	
	/*============================================   
	ACTUALIZAR PAGO DE PARQUEO 
	=============================================*/ 


/*
	static public function ctrActualizarPagoParqueoAcumulado($valor){

		$tabla = "estacionamiento";
		$respuesta = ModeloPago::mdlActualizarPagoParqueoAcumulado($tabla,$valor);

		return $respuesta;
		
	}
*/
}
	


