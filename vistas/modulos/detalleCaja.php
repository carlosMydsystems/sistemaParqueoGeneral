<div class="content-wrapper">

  <section class="content-header">

    <h1>CONTROL DE DETALLE DE CAJA </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Control detalle caja</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDetalleCaja">
          Agregar Detalle Caja
        </button>
      </div>
      <br>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th style="width:120px">MONTO EGRESO</th>
              <th>CONCEPTO</th>
              <th style="width:50px">FECHA</th>
              <th style="width:80px">ACCIONES</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $item = "cajaId";
            $valor = $_SESSION["idCaja"];
            $listarDetalleCaja = ControladorDetalleCaja::ctrMostrarDetallesCaja($item, $valor);
            foreach ($listarDetalleCaja as $key => $value) {
              echo ' <tr>
            <td>' . ($key + 1) . '</td>
            <td>' . $value["montoEgreso"] . '</td>
            <td>' . $value["concepto"] . '</td>
            <td></td>
            <td>
              <div class="btn-group">
                <button class="btn btn-warning btnEditarDetalleCaja" idDetalleCaja="' . $value["idDetalleCaja"] . '"><i class="fa fa-pencil"></i></button>
                <button class="btn btn-danger btnEliminarDetalleCaja" idDetalleCaja="' . $value["idDetalleCaja"] . '"><i class="fa fa-times"></i></button>
              </div>  
            </td>
          </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<!--=====================================
MODAL AGREGAR DETALLE DE CAJA
======================================-->

<div id="modalAgregarDetalleCaja" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Detalle de Caja</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MONTO DEL EGRESO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i>EGRESO S/ :</i></span> 

                <input type="text" class="form-control input-lg" name="montoEgreso" placeholder="Monto egresado" id="montoEgreso" required>
                <input type="text" name="cajaId" value="<?php echo $_SESSION["idCaja"]?>">

              </div>

            </div>

            <!-- ENTRADA PARA EL DETALLE DEL EGRESO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i>CONCEPTO EGRESO</i></span> 

                <textarea type="text" class="form-control"  name="conceptoEgreso" rows="4"></textarea>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Detalle</button>

        </div>

        <?php

          $crearDetalleCaja = new ControladorDetalleCaja();
          $crearDetalleCaja -> ctrCrearDetalleCaja();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL ACTUALIZAR DETALLE DE CAJA
======================================-->

<div id="modalActualizarDetalleCaja" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Actualizar Detalle de Caja</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MONTO DEL EGRESO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i>EGRESO S/ :</i></span> 

                <input type="text" class="form-control input-lg" name="actualizarMontoEgreso" id="actualizarMontoEgreso" required>
                <input type="text" name="actualizaDetalleCajaId" id="actualizaDetalleCajaId">

              </div>

            </div>

            <!-- ENTRADA PARA EL DETALLE DEL EGRESO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i>CONCEPTO EGRESO</i></span> 

                <textarea type="text" class="form-control"  name="actualizarConceptoEgreso" id="actualizarConceptoEgreso" rows="4"></textarea>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar Detalle</button>

        </div>

        <?php

          $actualizarDetalleCaja = new ControladorDetalleCaja();
          $actualizarDetalleCaja -> ctrActualizarDetalleCaja();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $eliminarDetalleCaja = new ControladorDetalleCaja();
  $eliminarDetalleCaja -> ctrEliminarDetalleCaja();

?>

