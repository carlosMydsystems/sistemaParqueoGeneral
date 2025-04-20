<?php

require_once "../controladores/inicio.controlador.php";
require_once "../modelos/inicio.modelo.php";

class AjaxInicio{

	/*=============================================
				VERIFICAR PLACA
	=============================================*/	
	public $nuevaPlaca;
	public function ajaxVerificarPlaca(){

		$valor = $this->nuevaPlaca;
		$item = "placa";
		$condicion = "PENDIENTE";
		
		$respuesta = ControladorInicio::ctrVerificarPlaca($item, $valor,$condicion);
		echo json_encode($respuesta);

    	}	

	/*=============================================   mostrarCaja
			ACTUALIZAR MONTO INICIAL DE CAJA
	=============================================*/	
	public $montoInicial, $fechaCaja,$usuarioId;

	public function ajaxRegistrarMontoInicialCaja(){

		$datos = array(	"fechaCaja"=> $this->fechaCaja,
						"usuarioId"=> $this->usuarioId,
						"montoInicial"=> $this->montoInicial);
		
		$respuesta = ControladorInicio::ctrRegistrarMontoCaja($datos);
		echo json_encode($respuesta);

    	}	
		
	/*=============================================   
			ACTUALIZAR MONTO INICIAL DE CAJA
	=============================================*/	
	public $estadoCaja;

	public function ajaxmostrarCaja(){

		$datos = array(	"usuarioId"=> $this->usuarioId,
						"estadoCaja"=> $this->estadoCaja);
		
		$respuesta = ControladorInicio::ctrMostrarCaja($datos);
		echo json_encode($respuesta);

    	}	
    }  
	
    /*=============================================
    VERIFICAR PLACA
    =============================================*/
    
    if(isset( $_POST["accion"]) && $_POST["accion"] == "verificarPlaca"){    
    
    	$valParqueo = new AjaxInicio();
    	$valParqueo -> nuevaPlaca = $_POST["nuevaPlaca"];
    
    	$valParqueo -> ajaxVerificarPlaca();
    
    }
 
	/*=============================================   
			ACTUALIZAR MONTO INICIAL DE CAJA
	=============================================*/	
     
    if(isset( $_POST["accion"]) && $_POST["accion"] == "registrarMontoInicialCaja"){    
    
    	$actualizarMontoInicioCaja = new AjaxInicio();
    	$actualizarMontoInicioCaja -> montoInicial = $_POST["montoInicial"];
		$actualizarMontoInicioCaja -> fechaCaja = $_POST["fechaCaja"];
		$actualizarMontoInicioCaja -> usuarioId = $_POST["usuarioId"];
    
    	$actualizarMontoInicioCaja -> ajaxRegistrarMontoInicialCaja();
    
    }

	/*=============================================   usuarioId
			ACTUALIZAR MONTO INICIAL DE CAJA
	=============================================*/	
     
    if(isset( $_POST["accion"]) && $_POST["accion"] == "mostrarCaja"){    
    
    	$mostrarCaja = new AjaxInicio();

		$mostrarCaja -> usuarioId = $_POST["usuarioId"];
		$mostrarCaja -> estadoCaja = $_POST["estadoCaja"];
    
    	$mostrarCaja -> ajaxmostrarCaja();
    
    }