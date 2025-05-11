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

	/*=============================================   
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

	/*=============================================   
				VERIFICAR ABONADO
	=============================================*/	

	public $placa;
	public function ajaxVerificarAbonado(){

		$valor = $this->placa;
		$item = "placa";
		$valor1 = 0;
		$item1 = "estado";
		
		$respuesta = ControladorInicio::ctrMostrarAbonados($item, $valor,$item1, $valor1);

		echo json_encode($respuesta);

		}

	/*=============================================   
				CAMBIAR ESTADO ABONADO
	=============================================*/	

	public $idDetalleCliente ;
	public function ajaxCambiarEstadoAbonado(){

		
		$valor2 = 1;
		$valor3 = $this->idDetalleCliente;
		$respuesta = ControladorInicio::ctrCambiarEstadoAbonado( $valor2, $valor3);

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

	/*=============================================   
			ACTUALIZAR MONTO INICIAL DE CAJA
	=============================================*/	
     
    if(isset( $_POST["accion"]) && $_POST["accion"] == "mostrarCaja"){    
    
    	$mostrarCaja = new AjaxInicio();

		$mostrarCaja -> usuarioId = $_POST["usuarioId"];
		$mostrarCaja -> estadoCaja = $_POST["estadoCaja"];
    
    	$mostrarCaja -> ajaxmostrarCaja();
    
    }

	
	/*=============================================   
			ACTUALIZAR MONTO INICIAL DE CAJA
	=============================================*/	
     
    if(isset( $_POST["accion"]) && $_POST["accion"] == "verificarAbonado"){    
    
    	$mostrarCaja = new AjaxInicio();

		$mostrarCaja -> placa = $_POST["placa"];
    
    	$mostrarCaja -> ajaxVerificarAbonado();
    
    }

	/*=============================================   
				CAMBIAR ESTADO ABONADO
	=============================================*/	
     
    if(isset( $_POST["accion"]) && $_POST["accion"] == "cambiarEstadoDetalleCliente"){    
    
    	$mostrarCaja = new AjaxInicio();

		$mostrarCaja -> idDetalleCliente = $_POST["idDetalleCliente"];
    
    	$mostrarCaja -> ajaxCambiarEstadoAbonado();
    
    }