<?php

require_once "../controladores/pago.controlador.php";
require_once "../modelos/pago.modelo.php";

class AjaxPago
{

	/*=============================================
		  MOSTRAR PARQUEO
	=============================================*/
	public $idEstacionamiento;
	public function ajaxMostrarParqueo()
	{

		$valor = $this->idEstacionamiento;
		$item = "idEstacionamiento";

		$respuesta = ControladorPago::ctrVerificarPago($item, $valor);

		//echo $respuesta;

		echo json_encode($respuesta);

	}

	/*=============================================        
		  ACTUALIZAR PAGO DEL PARQUEO
		  =============================================*/
	public $rucCliente;
	public $razonSocialCliente;

	public $direccionFiscalCliente;

	public $monto;

	public $dniCliente;

	public $subtotal;

	public $igv;

	public $numerodocumento;

	public $fechaHoraSalidaVehicular;

	public $cantidadHoras;
	public $tipoPago;
	public $cajaId;


	public function ajaxActualizarPagoParqueo()
	{

		$valor = array(
			"rucCliente" => $this->rucCliente,
			"razonSocialCliente" => $this->razonSocialCliente,
			"direccionFiscalCliente" => $this->direccionFiscalCliente,
			"monto" => $this->monto,
			"idEstacionamiento" => $this->idEstacionamiento,
			"dniCliente" => $this->dniCliente,
			"subtotal" => $this->subtotal,
			"igv" => $this->igv,
			"tipoDocumento" => $this->tipoDocumento,
			"numerodocumento" => $this->numerodocumento,
			"serial" => $this->tipoDocumento,
			"fechaHoraSalidaVehicular" => $this->fechaHoraSalidaVehicular,
			"cantidadHoras" => $this->cantidadHoras,
			"tipoPago" => $this->tipoPago,
			"cajaId" => $this->cajaId,
			"condicion" => "PAGADO"
		);

		$respuesta = ControladorPago::ctrActualizarPagoParqueo($valor);

		echo json_encode($respuesta);

	}


	/*=============================================
		  MOSTRAR CORRELATIVO
		  =============================================*/
	public $tipoDocumento;
	public function ajaxMostrarCorrelativo()
	{

		$tipo = $this->tipoDocumento;
		$numero = "numerodocumento";

		$respuesta = ControladorPago::ctrMostrarCorrelativo($tipo, $numero);

		//echo $respuesta;

		echo json_encode($respuesta);

	}

}


/*=============================================
MOSTRAR PARQUEO 
=============================================*/

if (isset($_POST["accion"]) && $_POST["accion"] == "mostrarParqueo") {

	$valParqueo = new AjaxPago();
	$valParqueo->idEstacionamiento = $_POST["idEstacionamiento"];
	$valParqueo->ajaxMostrarParqueo();

}

/*=============================================
ACTUALIZAR PAGO PARQUEO
=============================================*/

if (isset($_POST["accion"]) && $_POST["accion"] == "actualizarPagoParqueo") {

	$valParqueo = new AjaxPago();
	$valParqueo->rucCliente = $_POST["rucCliente"];
	$valParqueo->razonSocialCliente = $_POST["razonSocialCliente"];
	$valParqueo->direccionFiscalCliente = $_POST["direccionFiscalCliente"];
	$valParqueo->monto = $_POST["monto"];
	$valParqueo->subtotal = $_POST["subtotal"];
	$valParqueo->igv = $_POST["igv"];
	$valParqueo->idEstacionamiento = $_POST["idEstacionamiento"];
	$valParqueo->dniCliente = $_POST["dniCliente"];
	$valParqueo->tipoDocumento = $_POST["tipoDocumento"];
	$valParqueo->numerodocumento = $_POST["numerodocumento"];
	$valParqueo->fechaHoraSalidaVehicular = $_POST["fechaHoraSalidaVehicular"];
	$valParqueo->cantidadHoras = $_POST["cantidadHoras"];
	$valParqueo->tipoPago = $_POST["tipoPago"];  
	$valParqueo->cajaId = $_POST["cajaId"];
	$valParqueo->ajaxActualizarPagoParqueo();

}


/*=============================================
MOSTRAR CORRELATIVO
=============================================*/

if (isset($_POST["accion"]) && $_POST["accion"] == "mostrarCorrelativo") {

	$valParqueo = new AjaxPago();

	$valParqueo->tipoDocumento = $_POST["tipoDocumento"];
	$valParqueo->ajaxMostrarCorrelativo();

}









