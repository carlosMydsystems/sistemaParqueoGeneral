<?php

require_once "controladores/usuarios.controlador.php";
require_once "controladores/reimpresion.controlador.php";  
require_once "controladores/plantilla.controlador.php";
require_once "controladores/inicio.controlador.php";
require_once "controladores/pago.controlador.php";
require_once "controladores/cliente.controlador.php";
require_once "controladores/vehiculosVip.controlador.php";  
require_once "controladores/detalleCaja.controlador.php";
require_once "controladores/factura.controlador.php";
require_once "controladores/anulaciones.controlador.php";
require_once "controladores/listaAnulaciones.controlador.php";    
require_once "controladores/anulacionElectronica.controlador.php";    
require_once "controladores/imprime.controlador.php";  
require_once "controladores/envioFallido.controlador.php";  
require_once "controladores/reimpresionDocumento.controlador.php";  
require_once "controladores/login.controlador.php";  
require_once "controladores/caja.controlador.php";  

require_once "modelos/inicio.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/reimpresion.modelo.php";
require_once "modelos/pago.modelo.php";
require_once "modelos/cliente.modelo.php";
require_once "modelos/vehiculosVip.modelo.php";  
require_once "modelos/detalleCaja.modelo.php";
require_once "modelos/factura.modelo.php";
require_once "modelos/anulaciones.modelo.php";
require_once "modelos/listaAnulaciones.modelo.php";
require_once "modelos/anulacionElectronica.modelo.php";
require_once "modelos/imprime.modelo.php";
require_once "modelos/envioFallido.modelo.php";
require_once "modelos/reimpresionDocumento.modelo.php";
require_once "modelos/login.modelo.php";
require_once "modelos/caja.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();