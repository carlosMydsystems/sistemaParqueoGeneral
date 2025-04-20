<?php


?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      GESTION DE FACTURAS
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Gestión de facturas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
          
          
        

      </div>

    </div>

  </section>

</div>


<!--=====================================
ENVIAR A FACTURAR ELECTRONICAMENTE
======================================-->
<?php

$options = array(
     'login' => 'piro',
     'password' => '20551684157',
     'trace' => 1
);

$rucEmisor = "20477784764";
$correoAdquiriente = "-";
$razonSocialEmisor = "ESTACION DE SERVICIOS YOLITA S.A.C.";
$serieNumero = "F006-90001407";
$correoEmisor = "-";
$rucAdquiriente = "20600261844";
$razonSocialAdquiriente = "FACTORIA PANANA S.A.C.";
$totalVenta = "181.98";
$totalIgv = "154.22";
$totalImpuestos = "27.76";


$client = new SoapClient("http://testing.bizlinks.com.pe/integrador21/ws/invoker?wsdl",  $options);

$datorequest ='<SignOnLineCmd declare-sunat="0" declare-direct-sunat="1" publish="1" output="PDF">
 
    <parametros/>
    <parameter value="'.$rucEmisor.'" name="idEmisor"/>
    <parameter value="01" name="tipoDocumento"/>
    <documento>
    <correoEmisor>'.$correoEmisor.'</correoEmisor>
    <version>2.0</version>
    <versionUBL>2.1</versionUBL>
    <correoAdquiriente>'.$correoAdquiriente.'</correoAdquiriente>
    <numeroDocumentoEmisor>'.$rucEmisor.'</numeroDocumentoEmisor>
    <tipoDocumentoEmisor>6</tipoDocumentoEmisor>
    <tipoDocumento>01</tipoDocumento>
    <razonSocialEmisor>'.$razonSocialEmisor.'</razonSocialEmisor>
    <nombreComercialEmisor>-</nombreComercialEmisor>
    <serieNumero>'.$serieNumero.'</serieNumero>
    <fechaEmision>2020-06-12T00:00:00-05:00</fechaEmision>
    <ubigeoEmisor>150801</ubigeoEmisor>
    <direccionEmisor>AV. MERCEDES INDACOCHEA Nº 201</direccionEmisor>
    <urbanizacion>-</urbanizacion>
    <provinciaEmisor>HUAURA</provinciaEmisor>
    <departamentoEmisor>LIMA</departamentoEmisor>
    <distritoEmisor>HUACHO</distritoEmisor>
    <paisEmisor>PE</paisEmisor>
    <numeroDocumentoAdquiriente>'.$rucAdquiriente.'</numeroDocumentoAdquiriente>
    <tipoDocumentoAdquiriente>6</tipoDocumentoAdquiriente>
    <razonSocialAdquiriente>"'.$razonSocialAdquiriente.'"</razonSocialAdquiriente>
    <tipoMoneda>PEN</tipoMoneda>
    <totalValorVentaNetoOpGravadas>'.$totalVenta.'</totalValorVentaNetoOpGravadas>
    <tipoOperacion>0101</tipoOperacion>
    <coTipoEmision>RE</coTipoEmision>
    <totalIgv>'.$totalIgv.'</totalIgv>
    <totalVenta>'.$totalVenta.'</totalVenta>
    <textoLeyenda_1>Monto en Letras</textoLeyenda_1>
    <codigoLeyenda_1>1000</codigoLeyenda_1>
    <codigoAuxiliar40_1>9011</codigoAuxiliar40_1>
    <textoAuxiliar40_1>18%</textoAuxiliar40_1>
    <horaEmision>1970-01-01T09:39:09-05:00</horaEmision>
    <codigoLocalAnexoEmisor>0000</codigoLocalAnexoEmisor>
    <totalImpuestos>'.$totalImpuestos.'</totalImpuestos>
    <inHabilitado>1</inHabilitado>
<item>
        <indicador>D</indicador>
        <numeroOrdenItem>1</numeroOrdenItem>
        <codigoProducto>6001002</codigoProducto>
        <descripcion>GASOHOL 90 PLUS</descripcion>
        <cantidad>13.6930</cantidad>
        <unidadMedida>ZZ</unidadMedida>
        <importeTotalSinImpuesto>2.41</importeTotalSinImpuesto>
        <importeUnitarioSinImpuesto>2.41</importeUnitarioSinImpuesto>
        <importeUnitarioConImpuesto>13.39</importeUnitarioConImpuesto>
        <codigoImporteUnitarioConImpuesto>01</codigoImporteUnitarioConImpuesto>
        <importeIgv>27.76</importeIgv>
        <codigoRazonExoneracion>10</codigoRazonExoneracion>
        <montoBaseIgv>27.76</montoBaseIgv>
        <tasaIgv>18.00</tasaIgv>
        <importeTotalImpuestos>27.76</importeTotalImpuestos>
</item>
            
    <inHabilitado>1</inHabilitado>
     </documento>
     </SignOnLineCmd>';
	 
$respuestaSOAP = $client->invoke(['command' => $datorequest]);

$xmlrespuesta = simplexml_load_string($respuestaSOAP->return);

var_dump($xmlrespuesta);

echo '<br><br><br>';

$array = json_decode(json_encode($xmlrespuesta),true);

echo $array['genericInvokeResponse']['commonResponse']['summaryResult']['total'];

/*

=> SimpleXMLElement {#3545
     +"genericInvokeResponse": SimpleXMLElement {#3550
       +"commonResponse": SimpleXMLElement {#3540
         +"summaryResult": SimpleXMLElement {#3553
           +"total": "1",
         },
         +"status": "OK",
         +"descriptionStatus": "SUCCESFULL",
       },
       +"xmlResult": SimpleXMLElement {#3551
         +"document": SimpleXMLElement {#3543
           +"typeDocument": "01",
           +"idDocument": "F006-90001407",
           +"status": "ERROR",
           +"emisionTime": "2020-06-12",
           +"messages": SimpleXMLElement {#3530
             +"codeStatus": "400",
             +"descriptionStatus": SimpleXMLElement {#3521},
             +"codeDetail": "7074",
             +"descriptionDetail": SimpleXMLElement {#3534},
           },
           +"tipoDocumentoEmisor": "6",
           +"numeroDocumentoEmisor": "20477784764",
           +"tipoDocumentoAdquiriente": "6",
           +"numeroDocumentoAdquiriente": "20600261844",
           +"adicionales": SimpleXMLElement {#3527},
         },
       },
     },
   }
*/

$respuesta = $xmlrespuesta->genericInvokeResponse->xmlResult->document->idDocument->__toString();

print_r($respuesta);

//var_dump($respuesta);

///imprime F006-90001407

//$respuesta = simplexml_load_string($client->__getLastResponse())


//$respuesta->asXML();

?>






