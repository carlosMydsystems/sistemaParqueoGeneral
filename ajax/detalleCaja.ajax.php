<?php

require_once "../controladores/detalleCaja.controlador.php";
require_once "../modelos/detalleCaja.modelo.php";

class AjaxDetalleCaja{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idDetalleCaja;

	public function ajaxMostrarDetalleCaja(){

		$item = "idDetalleCaja";
		$valor = $this->idDetalleCaja;

		$respuesta = ControladorDetalleCaja::ctrMostrarDetallesCaja($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["accion"]) && $_POST["accion"] == "detalleCaja"){

	$categoria = new AjaxDetalleCaja();
	$categoria -> idDetalleCaja = $_POST["idDetalleCaja"];
	$categoria -> ajaxMostrarDetalleCaja();
}
