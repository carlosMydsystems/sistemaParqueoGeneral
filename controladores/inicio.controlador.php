<?php
class ControladorInicio{
    
	/*============================================   
	MOSTRAR TARIFAS 
	=============================================*/ 

	static public function ctrMostrarTarifas($item, $valor){

		$tabla = "tipovehiculo";
		$respuesta = ModeloInicio::mdlMostrarTarifas($tabla, $item, $valor);
		return $respuesta;
		
	}
	
	/*============================================   
	                MOSTRAR CAJA 
	=============================================*/ 

	static public function ctrMostrarCaja($datos){

		$tabla = "caja";
		$respuesta = ModeloInicio::mdlMostrarCaja($tabla,  $datos);
		return $respuesta;
		
	}
	

	/*============================================    
	VERIFICAR PLACA
	=============================================*/ 

	static public function ctrVerificarPlaca($item, $valor,$condicion){

		$tabla = "estacionamiento";
		$respuesta = ModeloInicio::mdlVerificarPlaca($tabla, $item, $valor,$condicion); 
		return $respuesta;

	}
	
	/*============================================    
	VERIFICAR PLACA
	=============================================*/ 

	static public function ctrRegistrarMontoCaja($datos){

		$tabla = "caja";

		$respuesta = ModeloInicio::mdlRegistrarMontoCaja($tabla, $datos); 

		return $respuesta;

	}
    /*============================================   
    MOSTRAR TARIFAS 
    =============================================*/   
    
    static public function ctrRegistroVehiculo(){
    
        if(isset($_POST["accion"]) && $_POST["accion"]=="registrarVehiculo"){ 
            
            $tabla = "estacionamiento";

            $nuevaPlaca = str_replace(" ","%20",$_POST["nuevaPlaca"]);

                $datos = array("nuevaPlaca" => $nuevaPlaca,
                           "condicion" => $_POST["condicion"],
                           "horaIngreso" => $_POST["horaIngreso"],
                           "tarifa" => $_POST["tarifa"],
                           "numerodocumento" => $_POST["numerodocumento"]);
            
            $respuesta = ModeloInicio::mdlRegistroVehiculo($tabla, $datos);
      
            if($respuesta != "error"){

                $horaIngreso = str_replace(' ','%20',$_POST["horaIngreso"]); 
                #$respuesta = explode(":",$respuesta);

                $url_path = 'http://localhost/AdministracionSanAndres/BackUp/registroBackUp.php?tabla='.$tabla.
                '&nuevaPlaca='.$nuevaPlaca.'&condicion='.$_POST["condicion"].'&horaIngreso='.$horaIngreso .
                '&tipovehiculoid='.$_POST["tarifa"].'&lastIdEstacionamiento='.$respuesta.''; 

                $data = array('tabla' => 'tablita'); 

                $options = array( 
                    'https' => array( 
                    'method' => 'GET', 
                    'content' => http_build_query($data)) 
                ); 
                
                // Create a context stream with 
                // the specified options 
                $stream = stream_context_create($options); 
                
                // The data is stored in the  
                // result variable 
                $result = file_get_contents( 
                        $url_path, false, null); 
                
                echo '<script>
                swal({
                type: "success",
                title: "¡Se ha registrado el vehiculo correctamente!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                
                }).then(function(result){
                
                if(result.value){
      
                 window.location = "index.php?ruta=imprime&idEstacionamiento='.$respuesta.'";

                }
                });

                </script>';
            }
            return $respuesta;
        }
    
    }

    /*=============================================   
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrActualizarMontoInicialCaja(){

        if(isset($_POST["montoCajaInicial"])){
            
    		$tabla = "caja";
    		$datos = array("montoInicial" => $_POST["montoCajaInicial"],
    			           "idCaja" => $_POST["idCajaInicial"]);
    
    		$respuesta = ModeloInicio::mdlActualizarMontoInicialCaja($tabla, $datos);
    	
    		if($respuesta == "ok"){
    
    			echo '<script>
    
    			swal({
    
    				type: "success",
    				title: "¡El Monto Inicial de la caja ha sido guardado correctamente!",
    				showConfirmButton: true,
    				confirmButtonText: "Cerrar"
    
    			}).then(function(result){
    
    				if(result.value){
    				
    					window.location = "inicio";
    
    				}
    
    			});
    		
    			</script>';
    
    		}
        }

	}

	/*============================================   
	MOSTRAR TARIFAS 
	=============================================*/ 

	static public function ctrMostrarAbonados($item, $valor, $item1, $valor1){

		$tabla = "cliente cl INNER JOIN detallecliente dcl ON cl.idCliente = dcl.clienteId INNER JOIN tipovehiculo tv ON dcl.tipoVehiculoId = tv.idtipovehiculo";
		$respuesta = ModeloInicio::mdlMostrarAbonados($tabla, $item, $valor,$item1, $valor1);
		return $respuesta;
		
	}
	
    /*=============================================   
				REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCambiarEstadoAbonado( $valor,  $valor1){

    		$tabla = "detallecliente";
    
    		$respuesta = ModeloInicio::mdlCambiarEstadoAbonados($tabla, $valor, $valor1);
			return $respuesta;

	}


}

	


