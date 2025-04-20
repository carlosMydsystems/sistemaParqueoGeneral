<?php

$idAnulacion = $_GET['idAnulacion'];

$options = array(
     'login' => 'piro',
     'password' => '20551684157'
);   

$client = new SoapClient("http://testing.bizlinks.com.pe/integrador21/ws/invoker?wsdl",  $options);

//$client = new SoapClient("https://integrador.bizlinks.com.pe/integrador21/ws/invoker?wsdl",  $options);

        $item = "idResumenBoleta";
        $valor = $idAnulacion;

        $anulacion = ControladorAnulacionElectronica::ctrMostrarAnulaciones($item, $valor);
    
         foreach ($anulacion as $key => $value){

            $serial = $value["serialResumenBoleta"];
            $numerodocumento = $value["correlativoResumenBoleta"];
            
            // Completa con ceros el numero de la serie de la anulacion
  
            $longitueNumeroDocumentoAnulacion = 3-strlen($numerodocumento);
            
            if($longitueNumeroDocumentoAnulacion >= 0 ){
                
                for($i=0; $i<$longitueNumeroDocumentoAnulacion;$i++){
                    
                    $numerodocumento = "0".$numerodocumento;
                    
                }
            }
            
             // Completa con ceros el numero de la serie de la factura
             
            $numeroDocumentoBaja = $value["numerodocumento"];
  
            $longitueNumeroDocumento = 8-strlen($numeroDocumentoBaja);
            
            if($longitueNumeroDocumento >= 0 ){
                
                for($i=0; $i<$longitueNumeroDocumento;$i++){
                    
                    $numeroDocumentoBaja = "0".$numeroDocumentoBaja;
                    
                }
            }
            
            $fechaEmisionComprobante =  explode(" ",$value["fechapago"])[0];
            $estadoFacturaElectronica = $value["estadoFacturaBoleta"];
            $serieNumero = $serial."-".$numerodocumento;
            $tipodocumento = $value["tipodocumento"];

            }

            if($tipodocumento == "FACTURA"){
                
                $typeDocument = "01";
                $serialDocumento = "F001-";
                $tipoDocumentoAdquiriente = "6";
                $identificadorBoletaFactura = "RA";
                
            }else if($tipodocumento == "BOLETA"){
                
                $typeDocument = "03";
                $serialDocumento = "B001-";
                $tipoDocumentoAdquiriente = "1";
                $identificadorBoletaFactura = "RC";
                
            }

            $hoy = getdate();
            $datorequest ='';
            
            $fechaActual = $hoy['year']."-".ajustarFecha($hoy['mon'])."-".ajustarFecha($hoy['mday']);

            if($tipodocumento == "FACTURA"){

            $datorequest ='<SignOnLineSummaryCmd declare-sunat="1" replicate="1" output="">
 
            <parametros/>
			<parameter value="20551684157" name="idEmisor"/> 
			<parameter value="'.$identificadorBoletaFactura.'" name="tipoDocumento"/> 
			<documento>
				<numeroDocumentoEmisor>20551684157</numeroDocumentoEmisor> 
				<version>1.0</version>
				<versionUBL>2.0</versionUBL>
				<tipoDocumentoEmisor>6</tipoDocumentoEmisor> 
				<resumenId>'.$serieNumero.'</resumenId> 
				<fechaEmisionComprobante>'.$fechaEmisionComprobante.'</fechaEmisionComprobante> 
				<fechaGeneracionResumen>'.$fechaActual.'</fechaGeneracionResumen> 
				<razonSocialEmisor>PIROTECNICOS SAC.</razonSocialEmisor> 
				<correoEmisor>-</correoEmisor>
				<inHabilitado>1</inHabilitado> 
                <resumenTipo>'.$identificadorBoletaFactura.'</resumenTipo> ';
            $detallerequest1 ='
				<ResumenItem>
					<numeroFila>1</numeroFila> 
					<tipoDocumento>01</tipoDocumento> 
					<serieDocumentoBaja>F001</serieDocumentoBaja> 
					<numeroDocumentoBaja>'.$serialDocumento.$numeroDocumentoBaja.'</numeroDocumentoBaja> 
					<motivoBaja>'.$value["comentarioResumen"].'</motivoBaja>
				</ResumenItem>
                </documento>
                </SignOnLineSummaryCmd>';

            
 
            $datorequest = $datorequest.$detallerequest1;     // Se debe definir el detalle de los resumenes de los Item

            $respuestaSOAP = $client->invoke(['command' => $datorequest]);

            $xmlrespuesta = simplexml_load_string($respuestaSOAP->return);
            

        }else{

            $datorequest ='<SignOnLineSummaryCmd declare-sunat="1" replicate="1" output="">
            <parameter value="20551684157" name="idEmisor"/>
            <parameter value="'.$identificadorBoletaFactura.'" name="tipoDocumento"/>
            <parameter value="185" name="version"/>
           <resumen>
           <tipoDocumentoEmisor>6</tipoDocumentoEmisor>
           <numeroDocumentoEmisor>20551684157</numeroDocumentoEmisor>
           <resumenId>'.$serieNumero.'</resumenId>
           <fechaEmisionComprobante>'.$fechaEmisionComprobante.'</fechaEmisionComprobante>
           <fechaGeneracionResumen>'.$fechaActual.'</fechaGeneracionResumen>
           <razonSocialEmisor>PIROTECNICOS SAC.</razonSocialEmisor>
           <correoEmisor>-</correoEmisor>
           <resumenTipo>'.$identificadorBoletaFactura.'</resumenTipo>';
           $detallerequest1 ='
           <SummaryItem>
            <numeroFila>1</numeroFila>    
            <tipoDocumento>'.$typeDocument.'</tipoDocumento>
            <tipoDocumentoAdquiriente>0</tipoDocumentoAdquiriente>
            <numeroDocumentoAdquiriente>-</numeroDocumentoAdquiriente>
            <tipoMoneda>PEN</tipoMoneda>
            <numeroCorrelativo>'.$serialDocumento.$numeroDocumentoBaja.'</numeroCorrelativo>
            <estadoItem>1</estadoItem>
            <totalValorVentaOpGravadasConIgv>4.24</totalValorVentaOpGravadasConIgv>
            <totalIsc>0.00</totalIsc>
            <totalIgv>0.76</totalIgv>
            <totalVenta>5.00</totalVenta>
           </SummaryItem>
           </resumen>
           </SignOnLineSummaryCmd>';

           $datorequest = $datorequest.$detallerequest1;

            $respuestaSOAP = $client->invoke(['command' => $datorequest]);

            $xmlrespuesta = simplexml_load_string($respuestaSOAP->return);
            

        }

        print_r($xmlrespuesta);

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      GESTION DE DOCUMENTOS
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Gestión de facturas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">

        <script type="text/javascript">

            function mostrar() 
            { 
                var  dia = new Date(); 
                
                var day = dia.getDate();
                
                var month = dia.getMonth() +1;
                
                if ((day >= 0)&&(day <= 9)){ 
                    day="0"+day; 
                }
                
                if ((month >= 0)&&(month <= 9)){ 
                    month="0"+month; 
                }
                
                
                var  fecha = day + "-" + month + "-" + dia.getFullYear();
                

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

        <textarea name="comentarios" rows="50" cols="120"><?php echo $datorequest?></textarea>
        

      </div>
      
      <div>
          
          <?php
          
          
          
          ?>
          
      </div>

    </div>

  </section>

</div>

<?php

function ajustarFecha($valor) {

    if($valor <=9){
        
        $valorSeteado = "0".$valor;
        
    }else{
        
        $valorSeteado = $valor;
    }
    
    return $valorSeteado;
    
    }

?>





