<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Estacionamiento San Andrés</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">  

  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">

   <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="vistas/dist/css/estilos.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  
  
  <!-- fullCalendar -->
  <link rel="stylesheet" href="vistas/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="vistas/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  
  
  
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script> 
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> 

  <!-- jQuery UI 1.11.4 -->
  <script src="vistas/bower_components/jquery-ui/jquery-ui.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- fullCalendar -->
    
  <script src="vistas/bower_components/moment/moment.js"></script>
  <script src="vistas/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
 
  <?php

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

   echo '<div class="wrapper">';

    /*=============================================
    CABEZOTE
    =============================================*/

    include "modulos/cabecera.php";

    /*=============================================
    MENU
    =============================================*/

    include "modulos/menu.php";

    /*=============================================
    CONTENIDO
    =============================================*/

    if(isset($_GET["ruta"])){

      if($_GET["ruta"] == "inicio" ||
         $_GET["ruta"] == "reimpresion" ||
         $_GET["ruta"] == "pago" ||
         $_GET["ruta"] == "vehiculosVip" ||
         $_GET["ruta"] == "cliente" ||
         $_GET["ruta"] == "factura" ||
         $_GET["ruta"] == "imprime" ||
         $_GET["ruta"] == "anulaciones" ||    
         $_GET["ruta"] == "anulacionElectronica" || 
         $_GET["ruta"] == "listaAnulaciones" ||
         $_GET["ruta"] == "envioFallido" ||
         $_GET["ruta"] == "reporteExcel" ||
         $_GET["ruta"] == "reimprimeDocumento" ||
         $_GET["ruta"] == "detalleCaja" ||
         $_GET["ruta"] == "reimpresionDocumento" ||
         $_GET["ruta"] == "producto" ||
         $_GET["ruta"] == "caja" ||
         $_GET["ruta"] == "salir"){

        include "modulos/".$_GET["ruta"].".php";

      }else{

        include "modulos/404.php";

      }

    }else{

      include "modulos/inicio.php";

    }

    /*=============================================
    FOOTER
    =============================================*/

    include "modulos/footer.php";

    echo '</div>';

  }else{

    include "modulos/login.php";

  }

  ?>

<script src="vistas/js/plantilla.js"></script>  
<script src="vistas/js/inicio.js"></script>
<script src="vistas/js/reimpresion.js"></script>
<script src="vistas/js/pago.js"></script>
<script src="vistas/js/cliente.js"></script>
<script src="vistas/js/vehiculosVip.js"></script>
<script src="vistas/js/detalleCaja.js"></script>
<script src="vistas/js/anulaciones.js"></script>    
<script src="vistas/js/reporteExcel.js"></script>
<script src="vistas/js/reimpresionDocumento.js"></script>
<script src="vistas/js/caja.js"></script>
<script src="vistas/js/cabezote.js"></script>  
<script src="vistas/js/detalleCaja.js"></script>  

</body>
</html>
