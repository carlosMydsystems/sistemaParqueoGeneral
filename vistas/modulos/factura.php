<?php

$idEstacionamiento = $_GET['idEstacionamiento'];

$ambiente = true;

if($ambiente){

    $urlBitzlink = "http://testing.bizlinks.com.pe/integrador21/ws/invoker?wsdl";

}else{

    $urlBitzlink = "https://integrador.bizlinks.com.pe/integrador21/ws/invoker?wsdl";

}

    /** Se obtiene el correlativo del resumen de la boleta */

    $serial = "RC-".fechaActualModificada();
    $correlativoResumenBoleta = "correlativoResumenBoleta";

    $obtenerCorrelativo = new ControladorFactura();
    $correlativoResumen =  $obtenerCorrelativo -> ctrMostrarCorrelativoResumenBoleta($serial,$correlativoResumenBoleta);

    $longitudCorrelativo = 3-strlen($correlativoResumen);

    if($longitudCorrelativo == 3){
        $correlativoResumen = "1";
    }else{
        $correlativoResumen = intval($correlativoResumen) + 1;
    }

    $longitudCorrelativo = 3-strlen($correlativoResumen);

    $correlativoResumenPrevio = $correlativoResumen;
    
    if($longitudCorrelativo >= 0 ){
        for($i=0; $i<$longitudCorrelativo;$i++){
            $correlativoResumen = "0".$correlativoResumen;
        }
    }

    // autenticacion del sistema de Bitzlink
    
    $options = array(
        'login' => 'crainvest',
        'password' => '20606258969'
    );

  //$client = new SoapClient($urlBitzlink,  $options);

        $item = "idEstacionamiento";
        $valor = $idEstacionamiento;

        $factura = ControladorFactura::ctrMostrarEstacionamiento($item, $valor);
    
         foreach ($factura as $key => $value){
         
            $id = $value["idEstacionamiento"];
            $condicion = $value["condicion"];
            $fechapago = $value["fechapago"];
            $fechapagosimplificado = explode(" ",$fechapago)[0];
            $monto = $value["montoPago"];
            $subtotal = $value["subtotalPago"];
            $igv = $value["igvPago"];
            $tipodocumento = $value["tipodocumento"];
            $numerodocumento = $value["numerodocumento"];
            $longitueNumeroDocumento = 8-strlen($numerodocumento);
            
            // Coloca en el formato 00000XXX

            if($longitueNumeroDocumento >= 0 ){
                for($i=0; $i<$longitueNumeroDocumento;$i++){
                    $numerodocumento = "0".$numerodocumento;
                }
            }

            $serial = $value["serial"];
            $ruc = $value["ruc"];
            $razonsocial = $value["razonsocial"];
            $razonsocial = str_replace("&","&amp;",$razonsocial);
            $direccionfiscal = $value["direccionfiscal"];
            $tipovehiculoid = $value["tipovehiculoid"];
            $clienteVip = $value["clienteVip"];
            $estadoFacturaBoleta = $value["estadoFacturaBoleta"];
            $placa = $value["placa"];
            $serieNumero = $serial."-".$numerodocumento;
            $rucAdquiriente = $ruc;
            $nombretipovehiculo = $value["nombretipovehiculo"];
            $tarifavehiculo = $value["tarifavehiculo"];

            }

            // valida si es Factura o Boleta

            if($tipodocumento == "FACTURA"){
                $typeDocument = "01";
                $tipoDocumentoAdquiriente = "6";
            }else if($tipodocumento == "BOLETA"){
                $typeDocument = "03";
                $tipoDocumentoAdquiriente = "1";
            }

            $datorequest ='
                <SignOnLineCmd declare-sunat="0" declare-direct-sunat="1" publish="1" output="PDF">
                <parametros/>
                <parameter value="20606258969" name="idEmisor"/>
                <parameter value="'.$typeDocument.'" name="tipoDocumento"/>
                <documento>
                    <correoEmisor>-</correoEmisor>
                    <version>2.0</version>
                    <versionUBL>2.1</versionUBL>
                    <correoAdquiriente>-</correoAdquiriente>
                    <numeroDocumentoEmisor>20606258969</numeroDocumentoEmisor>
                    <tipoDocumentoEmisor>6</tipoDocumentoEmisor>
                    <tipoDocumento>'.$typeDocument.'</tipoDocumento>
                    <razonSocialEmisor>CRA INVESTMENT SOCIEDAD ANONIMA CERRADA</razonSocialEmisor>
                    <nombreComercialEmisor>-</nombreComercialEmisor>
                    <serieNumero>'.$serieNumero.'</serieNumero>
                    <fechaEmision>'.$fechapagosimplificado.'</fechaEmision>
                    <ubigeoEmisor>150801</ubigeoEmisor>
                    <direccionEmisor>CAL.GERMAN SCHEREIBER NRO. 133</direccionEmisor>
                    <urbanizacion>-</urbanizacion>
                    <provinciaEmisor>LIMA</provinciaEmisor>
                    <departamentoEmisor>LIMA</departamentoEmisor>
                    <distritoEmisor>SAN ISIDRO</distritoEmisor>
                    <paisEmisor>PE</paisEmisor>
                    <numeroDocumentoAdquiriente>'.$rucAdquiriente.'</numeroDocumentoAdquiriente>
                    <tipoDocumentoAdquiriente>'.$tipoDocumentoAdquiriente.'</tipoDocumentoAdquiriente>
                    <razonSocialAdquiriente>'.$razonsocial.'</razonSocialAdquiriente>
                    <direccionAdquiriente>'.$direccionfiscal.'</direccionAdquiriente>
                    <tipoMoneda>PEN</tipoMoneda>
                    <totalValorVentaNetoOpGravadas>'.$subtotal.'</totalValorVentaNetoOpGravadas>
                    <tipoOperacion>0101</tipoOperacion>
                    <coTipoEmision>RE</coTipoEmision>
                    <totalIgv>'.$igv.'</totalIgv>
                    <totalVenta>'.$monto.'</totalVenta>
                    <codigoLeyenda_1>1000</codigoLeyenda_1>
                    <textoLeyenda_1>Monto en Letras</textoLeyenda_1>
                    <codigoLocalAnexoEmisor>0000</codigoLocalAnexoEmisor>
                    <totalImpuestos>'.$igv.'</totalImpuestos>
                    <inHabilitado>1</inHabilitado>';

        $item = "idEstacionamiento";
        $valor = $idEstacionamiento;

        $factura = ControladorFactura::ctrMostrarDetalleEstacionamiento($item, $valor);
        $detallerequest1 = ""; 
    
         foreach ($factura as $key => $value){
             /*
             $detallerequest='
                    <item>
                        <indicador>D</indicador>
                        <numeroOrdenItem>'.($key+1).'</numeroOrdenItem>
                        <codigoProducto>-</codigoProducto>
                        <descripcion>Parqueo del '.$value["fechaHoraIngreso"].' al '.$value["fechaHoraSalida"].'</descripcion>
                        <cantidad>'.$value["cantidadHoras"].'</cantidad>
                        <unidadMedida>ZZ</unidadMedida>
                        <importeTotalSinImpuesto>'.$value["subtotalPago"].'</importeTotalSinImpuesto>
                        <importeUnitarioSinImpuesto>'.$value["montoNeto"].'</importeUnitarioSinImpuesto>
                        <importeUnitarioConImpuesto>'.$value["monto"].'</importeUnitarioConImpuesto>
                        <codigoImporteUnitarioConImpuesto>01</codigoImporteUnitarioConImpuesto>
                        <importeIgv>'.$value["igv"].'</importeIgv>
                        <codigoRazonExoneracion>10</codigoRazonExoneracion>
                        <montoBaseIgv>'.$value["montoNeto"].'</montoBaseIgv>
                        <tasaIgv>18.00</tasaIgv>
                        <importeTotalImpuestos>'.$value["montoPago"].'</importeTotalImpuestos>
                    </item>';
            
            $detallerequest1 = $detallerequest1.$detallerequest;
*/
         }
      
            $footerrequest = '
                        <inHabilitado>1</inHabilitado>
                    </documento>
                </SignOnLineCmd>';

            $datorequest = $datorequest.$detallerequest1.$footerrequest;
            /*
            $respuestaSOAP = $client->invoke(['command' => $datorequest]);  // Hace el envio de la peticion
            $xmlrespuesta = simplexml_load_string($respuestaSOAP->return);  // Recibe la repuseta del servidor

            // var_dump($xmlrespuesta);

            if($xmlrespuesta->genericInvokeResponse->xmlResult->document->messages->descriptionDetail == null){

                $respuesta2 = "El documento se firmó de forma correcta";

            }else{

                $respuesta2 = $xmlrespuesta->genericInvokeResponse->xmlResult->document->messages->descriptionDetail->__toString();
                
            }

            $respuesta1 = $xmlrespuesta->genericInvokeResponse->xmlResult->document->status->__toString();

            if($respuesta1 == "ERROR"){

                // se hace la actualización del estado del registro de la factura

                $item = "idEstacionamiento";
                $valor = $idEstacionamiento;
                $item1 = "estadoFacturaBoleta";
                $valor1 = "2";
                $item2 = "observacionFacturaBoleta";
                $valor2 = $respuesta2;

                $actualizarEstadoFactura = ControladorFactura::ctrActualizarEstadoEstacionamiento($item, $valor,$item1, $valor1,$item2, $valor2);


            }else if($respuesta1 = "SIGNED"){ 
                

                // Generacion de la nueva trama de la declaracion del documento

                if($tipodocumento == "FACTURA"){

                    $item = "idEstacionamiento";
                    $valor = $idEstacionamiento;
                    $item1 = "estadoFacturaBoleta";
                    $valor1 = "3";
                    $item2 = "observacionFacturaBoleta";
                    $valor2 = $respuesta2;

                    $actualizarEstadoFactura = ControladorFactura::ctrActualizarEstadoEstacionamiento($item, $valor,$item1, $valor1,$item2, $valor2);
   
                }else{

                    $item = "idEstacionamiento";
                    $valor = $idEstacionamiento;
                    $item1 = "estadoFacturaBoleta";
                    $valor1 = "1";
                    $item2 = "observacionFacturaBoleta";
                    $valor2 = $respuesta2;

                    $actualizarEstadoFactura = ControladorFactura::ctrActualizarEstadoEstacionamiento($item, $valor,$item1, $valor1,$item2, $valor2);
   
                }

            }
*/

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      GESTION DE COMPROBANTES
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Gestiin de facturas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
          
          <?php


?>
   <script type="text/javascript">

            
            function Imprime(){
                window.print();
            }
            
            function fechaActual() { 
                let fecha = new Date(); 
                
                let day = fecha.getDate();
                
                let month = fecha.getMonth() +1;
                
                if ((day >= 0)&&(day <= 9)){ 
                    day="0"+day; 
                }
                
                if ((month >= 0)&&(month <= 9)){ 
                    month="0"+month; 
                }
         
                let  fechaActual1 = fecha.getFullYear() + "-" + month + "-" + day;

                return fechaActual;

            }
                
            
            function mostrar(){ 
                fechaActual(); 
                var  hora = dia.getHours(); 
                var  minutos = dia.getMinutes(); 
                var  segundos = dia.getSeconds();
                
                if ((hora >= 0)&&(hora <= 9)){ 
                    hora="0"+hora; 
                }
                
                if ((minutos >= 0)&&(minutos <= 9)){ 
                    minutos="0"+minutos; 
                }
                
                if ((segundos >= 0)&&(segundos <= 9)){ 
                    segundos="0"+segundos; 
                }
             
                document.getElementById("horaIngreso").value = hora; 
                document.getElementById("minutoIngreso").value = minutos; 
                document.getElementById("fecha").value = fecha; 
                window.setTimeout("mostrar()",1000); 
            }

</script>  

        <div >
                <div class="ticket" style="text-align:center">   

                    <h5 >Estacionamiento San Andres</h5>
                    <h5 >CRA INVESTMENT SOCIEDAD ANONIMA CERRADA</h5>
                    <h5 >RUC 20606258969</h5>
                    <h6>
                        Jiron Huallaga 839
                        <br>Cercado de Lima
                    </h6>
                    
                    <h5><?php echo $tipodocumento." DE VENTA ELECTRÓNICA"?></h5>
                    <h4><?php echo $serieNumero; ?></h4>
     
                    <h5>&nbsp;CLIENTE : <?php echo $razonsocial?></h5>
                    <h5>&nbsp;RUC / DNI :<?php echo $ruc?></h5>
                    <h5>&nbsp;DIRECCION : <?php echo $direccionfiscal?></h5>
  
                    <h5>&nbsp;FECHA DE EMISION : <?php echo $fechapagosimplificado?></h5>
                    <h4>&nbsp;PLACA            : <?php echo $placa?></h4>
                    <h4>&nbsp;TARIFA           : S/ <?php echo $tarifavehiculo?> hora o fracción</h4>
                    <br>
                    <?php
        $item = "idEstacionamiento";
        $valor = $idEstacionamiento;

        $factura = ControladorFactura::ctrMostrarDetalleEstacionamiento($item, $valor);
    
         foreach ($factura as $key => $value){
           echo '<h5>'.'de '.explode(" ",$value["fechaingreso"])[1].' al '.explode(" ",$value["fechapago"])[1].' monto S/ '.$value["montoPago"].'</h5>';

         }
                  ?>  
  
                    <h5>&nbsp;SUBTOTAL : S/ <?php echo $subtotal?></h5>
                    <h5>&nbsp;IGV : S/ <?php echo $igv?></h5>
                    <h5>&nbsp;TOTAL : S/ <?php echo $monto?></h5>
                    <span class="centered" style="font-size: 15px;" >Condiciones:</span>
                    <span class="centered" style="font-size: 9px; line-height:0px;" >
                        <br>- Ingresa la <?php echo $tipodocumento;?> de venta electronica en 
                        <br>- www.bitzlink.com
                    </span>
                    
                </div>
                <br>
            <center>
                
                 <button id="btnPrint" class="hidden-print" onclick="Imprime()">Imprimir Comprobante</button> 
                
            </center>
        </div>  
        
        
        

      </div>
      
      <div>
 
      </div>

    </div>

  </section>

</div>


<!--=====================================
ENVIAR A FACTURAR ELECTRONICAMENTE
======================================-->
<?php

    function fechaActual(){

        date_default_timezone_set("America/Lima");

        $hoy = date("Y-m-d");

        return $hoy;

    }
    function fechaActualModificada(){

        date_default_timezone_set("America/Lima");
        $serial = date("Ymd");
       
        return $serial;

    }
  
?>
