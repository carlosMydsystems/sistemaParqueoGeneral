<?php

$idEstacionamiento = $_GET['idEstacionamiento'];


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
            
            function fechaActual() 
            { 
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
                
            
            function mostrar() 
            { 
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

        <div id="OcultaImpresion">
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
        $item = "estacionamientoId";
        $valor = $idEstacionamiento;

        $factura = ControladorFactura::ctrMostrarDetalleEstacionamiento($item, $valor);
    
         foreach ($factura as $key => $value){
           echo '<h5>'.'de '.explode(" ",$value["fechaHoraIngreso"])[1].' al '.explode(" ",$value["fechaHoraSalida"])[1].' monto S/ '.$value["monto"].'</h5>';

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
