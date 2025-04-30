<?php 
  if($_SESSION["cajaDuplicada"]=="No"){

    $variableAux = $_SESSION["cajaDuplicada"];
    $_SESSION["cajaDuplicada"] = "Si";

  }
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>REGISTRO DE VEHICULOS</h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Registro de Veh&iacuteculos</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">

        <div class="container">
          <div class="row">
            <div class="col-lg-4">
              <div class="widget">
                <div class="fecha" id="fecha">

                  <p id="diaSemana" class="diaSemana"></p>
                  <p id="dia" class="dia"></p>
                  <p> de </p>
                  <p id="mes" class="mes"></p>
                  <p>del </p>
                  <p id="year" class="year"></p>

                </div>
                <div class="reloj">

                  <p id="horas" class="horas"></p>
                  <p>:</p>
                  <p id="minutos" class="minutos"></p>
                  <div class="caja-segundos">
                    <p id="ampm" class="ampm"></p>
                    <p id="segundos" class="segundos"></p>
                  </div>

                </div>
              </div>
            </div>
            <div class="col-lg-8">

              <div class="box-body">

                <form method="POST" id="formIngresoVehiculo" onsubmit="return checkSubmit();">
                  <!-- ENTRADA PARA EL NOMBRE -->

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon input-lg"><i class="fa fa-car" aria-hidden="true"> &nbsp &nbsp
                          PLACA </i></span>
                      <input type="text" class="form-control input-lg" name="nuevaPlaca" id="nuevaPlaca"
                        style="text-transform:uppercase; font-size:25px;" value=""
                        onkeyup="javascript:this.value=this.value.toUpperCase();"
                        placeholder="Ingresar placa del Vehículo" maxlength="7" required>
                      <span class="input-group-addon input-lg"><input type="button" id="btnSeleccionCliente"
                          value="CLIENTE"></span>
                      <input type="hidden" name="condicion" value="PENDIENTE">
                      <input type="hidden" name="horaIngreso" id="horaIngreso">
                      <input type="hidden" name="accion" value="registrarVehiculo">
                      <input type="hidden" name="clienteVip" id="clienteVip">
                      <input type="hidden" name="numerodocumento" value="0">
                      <input type="hidden" name="idCaja" id="idCaja" value="<?php echo $_SESSION["idCaja"]?>">

                    </div>
                    <br>

                    <div class="input-group">
                      <span class="input-group-addon input-lg"><i class="fa fa-th-list"> &nbsp &nbsp TARIFA</i></span>
                      <select name="tarifa" id="tarifa" class="form-control input-lg" data-size="20" data-width="auto">

                        <?php

                        $item = null;
                        $valor = null;

                        $tarifas = ControladorInicio::ctrMostrarTarifas($item, $valor);

                        foreach ($tarifas as $key => $value) {

                          echo '<option value="' . $value["idtipovehiculo"] . '">' . $value["nombretipovehiculo"] . '</option>';

                        }

                        ?>

                      </select>

                    </div>

                  </div>
                  <input type="button" class="btn btn-success btnIngresar" value="REGISTRAR">

                  <?php

                  $registrarIngresoVehiculo = new ControladorInicio();
                  $registrarIngresoVehiculo->ctrRegistroVehiculo();

                  ?>

                </form>



              </div>


            </div>




          </div>
        </div>


      </div>

    </div>

  </section>

</div>


<!--=====================================
MODAL SELECCIONAR CLIENTE
======================================-->

<div id="modalSeleccionarVehiculoCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">SELECCIONAR VEHICULO</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

              <thead>

                <tr>

                  <th style="width:50px;">PLACA</th>
                  <th>TIPO DE VEHICULO</th>
                  <th>CLIENTE</th>
                  <th style="width:10px;"></th>

                </tr>

              </thead>

              <tbody>

                <?php

                $item = null;
                $valor = null;

                $vehiculoVip = ControladorVehiculoVip::ctrMostrarVehiculoCliente($item, $valor);

                foreach ($vehiculoVip as $key => $value) {

                  echo ' <tr>
                  <td>' . $value["placa"] . '</td>
                  <td>' . $value["nombretipovehiculo"] . '</td>
                  <td>' . $value["razonSocial"] . '</td>
                  <td>

                    <div class="btn-group">
                     
                      <input type="button" class="btn btn-success btnSeleccionarVehiculoCliente" 
                      idVehiculoClienteeleccionarVip="' . $value["placa"] . '" idtipovehiculo = "' . $value["idtipovehiculo"] . '" value = "SEL">

                    </div>  

                  </td>

                </tr>';
                }


                ?>

              </tbody>

            </table>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="button" class="btn btn-primary btnGuardarMontoCajaInicial">Guardar vehiculo</button>

        </div>

        <?php

        //$crearMontoInicialCaja = new ControladorVehiculoVip();
        //$crearVehiculoCliente -> ctrCrearVehiculoCliente();
        
        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL SELECCIONAR CLIENTE
======================================-->

<div id="modalIngresarMontoCaja" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white; ">
          <h4 class="modal-title">MONTO EN CAJA</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon input-lg"><i class="fa fa-money" aria-hidden="true"> &nbsp
                    CAJA S/ </i></span>
                <input type="number" id="montoCajaInicial" name="montoCajaInicial" class="form-control input-lg"
                  style="text-transform:uppercase; font-size:25px;" placeholder="Ingresar el monto en caja" required>
                <input type="hidden" id="cajaDuplicada" value="<?php echo $variableAux ?>">
                <input type="hidden" id="usuarioId" value="<?php echo $_SESSION["id"] ?>">
                <input type="text" id="idCajaInicial" name="idCajaInicial">
              </div>
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" id="btnSalir">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>

        </div>

        <?php
          $actualizarMontoInicialCaja = new ControladorInicio();
          $actualizarMontoInicialCaja -> ctrActualizarMontoInicialCaja();
        ?>

      </form>

    </div>

  </div>

</div>

  <?php
    $eliminarCaja = new ControladorCaja();
    $eliminarCaja -> ctrEliminarCaja();
  ?>