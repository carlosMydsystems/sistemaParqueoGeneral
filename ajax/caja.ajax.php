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

}


/*=============================================
			MOSTRAR DETALLE CAJA
=============================================*/

if (isset($_POST["accion"]) && $_POST["accion"] == "mostrarDetalleCaja") {

	$actualizarCaja = new AjaxCaja();
	$actualizarCaja->idDetalleCaja = $_POST["idDetalleCaja"];

	$actualizarCaja->ajaxMostrarDetalleCaja();

}









