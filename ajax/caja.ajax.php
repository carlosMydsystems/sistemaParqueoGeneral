<?php

require_once "../controladores/caja.controlador.php";
require_once "../modelos/caja.modelo.php";

class AjaxCaja
{

	public $idDetalleCaja;

	/*=============================================   
				MOSTRAR DETALLE CAJA
	=============================================*/
	public function ajaxMostrarDetalleCaja()
	{

		$item = "idDetalleCaja";
		$idDetalleCaja = $this->idDetalleCaja;

		$respuesta = ControladorCaja::ctrMostrarDetalleCaja($item, $idDetalleCaja);
		echo json_encode($respuesta);

	}

	
	public $idCaja;

	/*=============================================   
				MOSTRAR DETALLE CAJA
	=============================================*/
	public function ajaxEliminarCaja()
	{

		$idCaja = $this->idCaja;
		ControladorCaja::ctrEliminarCaja($idCaja);

	}

}


/*=============================================
			MOSTRAR DETALLE CAJA
=============================================*/

if (isset($_POST["accion"]) && $_POST["accion"] == "mostrarDetalleCaja") {

	$actualizarCaja = new AjaxCaja();
	$actualizarCaja->idDetalleCaja = $_POST["idDetalleCaja"];

	$actualizarCaja->ajaxMostrarDetalleCaja();

}


/*=============================================
			MOSTRAR DETALLE CAJA
=============================================*/

if (isset($_POST["accion"]) && $_POST["accion"] == "eliminarCaja") {

	$actualizarCaja = new AjaxCaja();
	$actualizarCaja->idCaja = $_POST["idCaja"];

	$actualizarCaja->ajaxEliminarCaja();

}








