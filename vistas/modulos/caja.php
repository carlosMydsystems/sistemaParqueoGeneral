<div class="content-wrapper">
  <section class="content-header">
    <h1>Gestion de Caja</h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Caja</li>
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div>
        <div class="row">
        </div>
      </div>
      <br>
      <div class="box-body">
        <div class="row">
          <div class="col-lg-5"> <!-- Tabla maestro de caja-->
            <table class="table table-bordered table-striped dt-responsive tablas border" width="100%">
              <thead>
                <tr>
                  <th style="width:10px">#</th>
                  <th style="width:70px">FECHA CAJA</th>
                  <th style="width:70px">MONTO INICIAL</th>
                  <th style="width:40px">ACCIONES</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $item = "idCaja";
                $valor = $_SESSION["idCaja"];
                $caja = ControladorCaja::ctrMostrarCaja($item, $valor);
                foreach ($caja as $key => $value) {
                  echo '
                    <tr>
                      <td>' . ($key + 1) . '</td>
                      <td>' . $value["fechaCaja"] . '</td>
                      <td>' . $value["montoInicial"] . '</td>
                      <td>
                      <div class="btn-group">
                        <button class="btn btn-success btnDetalleCaja" idCaja="'. $value["idCaja"] .'">
                          <i>Detalle Caja</i>
                        </button>
                      </div>  
                      </td>
                    </tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="col-lg-7">
            <div class="content">
              <div class="box">
                <div class="row">

                  <div>
                    <div class="col-lg-6"><span style="color:#1c62c4; font-size:18px;">MONTO INICIAL: <span
                          style="color:#000;" id="montoInicialCaja"></span></span></div>
                    <div class="col-lg-6"><span style="color:#1c62c4; font-size:18px;">INGRESO: <span
                          style="color:#000;" id="muestraMontoTotal"></span></span></div>
                  </div>
                  <br>
                  <div>
                    <div class="col-lg-6"><span style="color:#1c62c4; font-size:18px;">EGRESO: <span
                        style="color:#000;" id="muestraMontoCaja"></span></span></div>
                    <div class="col-lg-6"><span style="color:#1c62c4; font-size:18px;">MONTO EN CAJA: <span
                        style="color:#000;" id="muestraMontoDetalleCaja"></span></span></div>
                  </div>
                </div>
                <br>
              </div>
              <div id="ventanaTablapagoEstacionamiento">
                <div>
                  <p class="text-center">TABLA DE VEHICULOS PAGADOS</p>
                </div>
                <div>  
                  <button class="btn btn-success btnCerrarCaja">Cerrar Caja</button>
                </div>
                <br>
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                  <thead>
                    <tr>
                      <th style="width:10px">#</th>
                      <th>PLACA</th>
                      <th>TIPO VEHICULO</th>
                      <th>HORA DE INGRESO</th>
                      <th>HORA DE SALIDA</th>
                      <th>CONDICION</th>
                      <th style="width:100px">MONTO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $item2 = "estadoCaja";
                    $valor2 = 0;
                    $item1 = "usuarioId";
                    $valor1 = $_SESSION["id"];

                    $caja = ControladorCaja::ctrMostrarCajaUsuario($item2, $valor2, $item1, $valor1);

                    foreach ($caja as $key => $value) {

                      $montoInicial = $value["montoInicial"];

                    }

                    $item = "condicion";
                    $valor = "PAGADO";
                    $item3 = "cajaId";
                    $valor3 = $_SESSION["idCaja"];

                    $estacionamientoCaja = ControladorCaja::ctrMostrarEstacionamientoPagado(
                      $item,
                      $valor,
                      $item3,
                      $valor3
                    );

                    $montoTotal = 0.00;

                    foreach ($estacionamientoCaja as $key => $value) {
                      echo '
                          <tr>
                            <td>' . ($key + 1) . '</td>
                            <td>' . $value["placa"] . '</td>
                            <td>' . $value["nombretipovehiculo"] . '</td>
                            <td>' . $value["fechaingreso"] . '</td>
                            <td>' . $value["fechapago"] . '</td>
                            <td>' . $value["condicion"] . '</td>
                            <td>' . $value["montoPago"] . '</td>
                          </tr>';
                      $montoTotal += $value["montoPago"];
                    }

                    $item = "idCaja";
                    $valor = $_SESSION["idCaja"];
                    $caja = ControladorDetalleCaja::ctrTotalDetalleCaja($item, $valor);
                    var_dump( $caja["suma"])
                    ?>
                  </tbody>

                </table>
                <input type="hidden" id="montoTotal" value=<?php echo $montoTotal ?>>
                <input type="hidden" id="montoInicial" value=<?php echo $montoInicial ?>>
                <input type="hidden" id="montoDetalleCaja" value=<?php echo $caja["suma"]?>>

              </div>

            </div>
          </div>
        </div>
      </div> <!-- fin div -->
    </div>
  </section>

</div> 

<div id="modalCerrarCaja" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

      <!--=====================================
                CABEZA DEL MODAL
      ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">CERRAR CAJA</h4>
        </div>

      <!--=====================================
                  CUERPO DEL MODAL
      ======================================-->

        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i>MONTO INICIAL S/: </i></span>
                <input type="text" class="form-control input-lg" id="montoInicialCaja">
                <input type="hidden" name="cerrarCajaId" value="<?php echo $_SESSION["idCaja"]?>">
                <span class="input-group-addon"><i>MONTO ACTUAL S/:</i></span>
                <input type="text" class="form-control input-lg" name="actualizarMontoFinal">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i>OBSERVACION</i></span>
                <textArea row="4" class="form-control" name="actualizarObservacion"></textArea>
              </div>
            </div>
          </div>
        </div>

        <!--=====================================
                  PIE DEL MODAL
      ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">AGREGAR DETALLE CAJA</button>
        </div>
        <?php

        $cerrarCaja = new ControladorCaja();
        $cerrarCaja -> ctrCerrareCaja();
        
        ?>

      </form>
    </div>
  </div>
</div>

<?php

$eliminarDetalleCaja = new ControladorCaja();
$eliminarDetalleCaja->ctrEliminarDetalleCaja();
?>

<div id="modalAgregarCaja" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

      <!--=====================================
                CABEZA DEL MODAL
      ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar salida de caja caja</h4>
        </div>

      <!--=====================================
                  CUERPO DEL MODAL
      ======================================-->

        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="agregarMontoEgreso">
                <input type="hidden" name="cajaId" value="<?php echo $_SESSION["idCaja"]?>"

              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-smile-o"></i></span>
                <textArea row="4" class="form-control" name="agregarConcepto"></textArea>
              </div>
            </div>
          </div>
        </div>

        <!--=====================================
                  PIE DEL MODAL
      ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">AGREGAR DETALLE CAJA</button>
        </div>
        <?php
          $agregarDetalleCaja = new ControladorCaja();
          $agregarDetalleCaja -> ctrAgregarDetalleCaja();
        ?>
      </form>
    </div>
  </div>
</div>
<div>
  <form action="detalleCaja" role="form" method="post" id="envioDetalleCaja">
    
  </form>
</div>