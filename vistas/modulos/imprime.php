<?php

    $idEstacionamiento = "000000000".$_GET['idEstacionamiento'];
    

                        
        $item = "idEstacionamiento";
        $valor = $idEstacionamiento;  
        
        $vehiculo = ControladorImpresion::ctrMostrarVehiculo($item, $valor);
        
        foreach ($vehiculo as $key => $value){ 
            
            $placaVehiculo = $value["placa"];  
            $fechaingreso = $value["fechaingreso"];
            
        }
           
                    

?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script type="text/javascript">

            
            function Imprime(){
                window.print();
            }

      
      
</script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/RegistrarEstacionamiento.js"></script>
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	

    </head>
    <body>

            <div id="OcultaImpresion" style="display: inline">
                <div class="ticket" style="text-align:center">
                    <h3 >TICKET PLAYA</h3>
                    <h6>
                    <p class="centered">Estacionamiento San Andres
                        <br>Jiron Huallaga 839
                        <br>Cercado de Lima
                      
                    </h6>
                    <h5 id="HoraEntrada"><?php echo explode(" ",$fechaingreso)[0]?></h5>
                    <h4>HORA INGRESO  <?php echo explode(" ",$fechaingreso)[1]?> horas</h4>
              
                    <h2 id="bloquePlaca"><?php echo $placaVehiculo?></h2>
                    
                    <div> 
                        <img src="generar.php?numero=<?php echo $idEstacionamiento?>">'
                        
                        
                        
                    </div>
                    <p>&nbsp;Atencion de 8:00am - 7:00pm</p>
                    <span class="centered" style="font-size: 15px;" >Condiciones:</span>
                    <span class="centered" style="font-size: 9px; line-height:0px;" >
                        <br>- Conserve su ticket que acredita el ingreso de su vehículo y entréguelo al recoger el mismo.Indicar si desea boleta o factura, no se cambiará el comprobante
                        <br>- La playa no acepta ni reconoce ningún grado de responsabilidad por daños que pudiera sufrir el vehículo,ni por sustracciones de objetos dentro de el, ni por robo de partes, piezas y/o unidad móvil
                    </span>
                    
                </div>
                <br>
            <center>
                <button id="btnPrint" class="hidden-print" idEstacionamiento = "<?php echo $idEstacionamiento?>"onclick="Imprime()">Imprimir Ticket</button>
            </center>
        </div>
    

       
    </body>
