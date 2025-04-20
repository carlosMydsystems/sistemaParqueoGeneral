

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      GESTION DE CAJA
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Gestión de clientes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
        <div class="box-header with-border">
        
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">Agregar Cliente</button>

        </div>
      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>RUC</th>
           <th>RAZON SOCIAL</th>
           <th>DIRECCION FISCAL</th>
           <th style="width:140px">ACCIONES</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $reimpresion = ControladorCliente::ctrMostrarCliente($item, $valor);

       foreach ($reimpresion as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["ruc"].'</td>
                  <td>'.$value["razonSocial"].'</td>
                  <td>'.$value["direccionFiscal"].'</td>
                  <td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarCliente" idCliente="'.$value["idCliente"].'" rucCliente="'.$value["ruc"].'" 
                      razonSocialCliente="'.$value["razonSocial"].'" direccionFiscalCliente="'.$value["direccionFiscal"].'" 
                      data-toggle="modal" data-target="#modalEditarCliente"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-info btnVehiculos" idCliente="'.$value["idCliente"].'"><i class="fa fa-car"> Placas</i></button>
                      <button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["idCliente"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL RUC -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="ruc" placeholder="Ingresar Ruc de la empresa" id="ruc" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL RAZON SOCIAL -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-smile-o"></i></span> 

                <input type="text" class="form-control input-lg" name="razonSocial" placeholder="Ingrese la razon social" id="razonSocial" required>

              </div>

            </div>

            <!-- ENTRADA PARA DIRECCION FISCAL -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" name="direccionFiscal" id="direccionFiscal" placeholder="Ingresar la direccion fiscal" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

        <?php

          $crearCliente = new ControladorCliente();
          $crearCliente -> ctrCrearCliente();

        ?>

      </form>

    </div>

  </div>

</div>

<!--===================================== 
MODAL EDITAR USUARIO
======================================-->


<div id="modalEditarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Actualizar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL RUC -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="actualizarRuc" id="actualizarRuc">

              </div>

            </div>

            <!-- ENTRADA PARA EL RAZON SOCIAL -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-smile-o"></i></span> 

                <input type="text" class="form-control input-lg" name="actualizarRazonSocial" id="actualizarRazonSocial">

              </div>

            </div>

            <!-- ENTRADA PARA DIRECCION FISCAL -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="text" class="form-control input-lg" name="actualizarDireccionFiscal" id="actualizarDireccionFiscal">
                <input type="hidden" name="idCliente" id="idCliente">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn btn-primary">ACTUALIZAR CLIENTE</button>

        </div>

        <?php

          $actualizarCliente = new ControladorCliente();
          $actualizarCliente -> ctrActualizarCliente();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

          $eliminarCliente = new ControladorCliente();
          $eliminarCliente -> ctrEliminarCliente();

?>






