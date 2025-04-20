<?php 
if($_GET['idCliente'] != null){
    
    $_SESSION['idCliente'] = $_GET['idCliente'];
    
}



?>


<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      GESTION DE VEHICULOS DE CLIENTES
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Gesti贸n de vehiculos de clientes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
        <div class="box-header with-border">
        
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarVehiculoCliente">Agregar Vehiculo</button>
        
        </div>
      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>PLACA</th>
           <th>TIPO DE VEHICULO</th>
           <th style="width:140px">ACCIONES</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = "clienteId";
        $valor = $_SESSION['idCliente'];

        $vehiculoVip = ControladorVehiculoVip::ctrMostrarVehiculoCliente($item, $valor);

       foreach ($vehiculoVip as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["placa"].'</td>
                  <td>'.$value["nombretipovehiculo"].'</td>
                  
                  <td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarVehiculoCliente" idVehiculoClienteVip="'.$value["idVehiculoClienteVip"].'" actualizarPlaca="'.$value["placa"].'" 
                      tipoVehiculoId="'.$value["tipoVehiculoId"].'" 
                      data-toggle="modal" data-target="#modalEditarVehiculoCliente"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btnEliminarVehiculoCliente" idVehiculoClienteEliminarVip="'.$value["idVehiculoClienteVip"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR VEHICULO
======================================-->

<div id="modalAgregarVehiculoCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Vehiculo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL RUC -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon input-lg"><i class="fa fa-car fa-lg">   PLACA</i></span> 

                <input type="text" class="form-control input-lg" name="placaVehiculo" placeholder="Ingresar placa" id="placaVehiculo" required>

              </div>

            </div>

            <div class="input-group">
                    <span class="input-group-addon input-lg"><i class="fa fa-th-list fa-lg"> &nbsp &nbsp TARIFA</i></span> 
                    <select name="tarifaCliente" class="form-control input-lg" data-size="20" data-width="auto">
       
                        <?php
                        
                            $item = null;
                            $valor = null;  
                            
                            $tarifas = ControladorInicio::ctrMostrarTarifas($item, $valor);
                            
                            foreach ($tarifas as $key => $value){ 
                                
                                echo '<option value="'.$value["idtipovehiculo"].'">'.$value["nombretipovehiculo"].'</option>'; 
                                
                            }
           
                        ?> 

                    </select>
                    
                    
                </div>



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar vehiculo</button>

        </div>

        <?php

          $crearVehiculoCliente = new ControladorVehiculoVip();
          $crearVehiculoCliente -> ctrCrearVehiculoCliente();

        ?>

      </form>

    </div>

  </div>

</div>

<!--===================================== 
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarVehiculoCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="get">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Vehiculo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA PLACA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon input-lg"><i class="fa fa-car fa-lg">   PLACA</i></span> 

                <input type="text" class="form-control input-lg" name="actualizarPlacaVehiculo" placeholder="Ingresar placa" id="actualizarPlacaVehiculo" required>
                <input type="text" id="idVehiculoClienteVip" name="idVehiculoClienteVip">

              </div>

            </div>

            <div class="input-group">
                    <span class="input-group-addon input-lg"><i class="fa fa-th-list fa-lg"> &nbsp &nbsp TARIFA</i></span> 
                    <select name="actualizarTarifaCliente" id="actualizarTarifaCliente" class="form-control input-lg" data-size="20" data-width="auto">
       
                        <?php
                        
                            $item = null;
                            $valor = null;  
                            
                            $tarifas = ControladorInicio::ctrMostrarTarifas($item, $valor);
                            
                            foreach ($tarifas as $key => $value){ 
                                
                                echo '<option value="'.$value["idtipovehiculo"].'">'.$value["nombretipovehiculo"].'</option>'; 
                                
                            }
           
                        ?> 

                    </select>
                    
                    
                </div>



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar vehiculo</button>

        </div>

        <?php

          $actualizarVehiculoCliente = new ControladorVehiculoVip();
          $actualizarVehiculoCliente -> ctrActualizarVehiculoCliente();

        ?>

      </form>

    </div>

  </div>

</div>


<?php

          $eliminarVehiculoCliente = new ControladorVehiculoVip();
          $eliminarVehiculoCliente -> ctrEliminarVehiculoCliente();

?>






