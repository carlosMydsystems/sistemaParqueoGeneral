<div class="content-wrapper">

  <section class="content-header">
    
    <h1>GENERACIÓN DE ANULACIONES</h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Generacion anulaciones</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  


      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>

           <th style="text-align:center;">PLACA</th>
           <th>FECHA DE PAGO</th>
           <th>TIPO DOCUMENTO</th>
           <th>NRO DOCUMENTO</th>
           <th>CLIENTE</th>
           <th>RUC/DNI</th>
           <th>MONTO</th>
           <th>ACCIONES</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = "condicion";
      
        $valor = array( "condicion" => "PAGADO",
                        "estadoFacturaElectronica" => "Ok",
                        "estadoFacturaBoleta" => "3");

        $notaCreditoAnulacion = ControladorAnulacion::ctrMostrarComprobantes($item, $valor);

        foreach ($notaCreditoAnulacion as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["placa"].'</td>
                  <td>'.$value["fechapago"].'</td>
                  <td>'.$value["tipodocumento"].'</td>
                  <td>'.$value["serial"]."-".$value["numerodocumento"].'</td>
                  <td>'.$value["razonsocial"].'</td>
                  <td>'.$value["ruc"].'</td>
                  <td>'.$value["montoPago"].'</td>';

        
          echo '<td>

            <div class="btn-group">
                
              <button class="btn btn-warning btnAnulacion" 
              idEstacionamiento="'.$value["idEstacionamiento"].'" 
              tipodocumento="'.$value["tipodocumento"].'">ANULACION</button>


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
    MODAL GENERAR ANULACION
    ======================================-->
    
    <div id="modalGenerarAnulacion" class="modal fade" role="dialog">
      
      <div class="modal-dialog">
    
        <div class="modal-content">
    
          <form role="form" method="POST">
    
            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->
    
            <div class="modal-header" style="background:#3c8dbc; color:white">
    
              <button type="button" class="close" data-dismiss="modal">&times;</button>
    
              <h4 class="modal-title">ANULAR DOCUMENTO</h4>
    
            </div>
    
            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->
    
            <div class="modal-body">
    
              <div class="box-body">
    
                <!-- ENTRADA PARA EL NOMBRE DE LA TARIFA-->
                
                <div class="form-group">
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"></span> 
                    <input type="text" class="form-control input" id="Documento" readonly>
    
                  </div>
    
                </div>
    
                <!-- ENTRADA PARA EL MONTO DE LA TARIFA -->
    
                <div class="form-group">
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa fa-cash">MOTIVO</i></span> 
                        <input type="text" class="form-control input" name="motivoAnulacion" id="motivoAnulacion" placeholder="Ingresar Motivo">  
                        <input type="hidden" name="idEstacionamiento" id="idEstacionamiento">
                        <input type="hidden" name="serial" id="serial">
                        <input type="hidden" name="fechaAnulacion" id="fechaAnulacion">
                        <input type="hidden" name="correlativoAnulacion" id="correlativoAnulacion">
    
                    </div>
                </div>
    
              </div>
    
            </div>
    
            <!--=====================================
            PIE DEL MODAL
            ======================================-->
    
            <div class="modal-footer">
    
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
    
              <button type="submit" class="btn btn-primary">ANULAR COMPROBANTE</button>
    
            </div>
    
         <?php
    
              $generarAnulacion = new ControladorAnulacion();
              $generarAnulacion -> ctrCreaAnulacion();
    
            ?> 
    
          </form>
    
        </div>
    
      </div>
    
    </div>

<?php
/*
  $eliminarTarifa = new ControladorNotaCreditoAnulacion();
  $eliminarTarifa -> ctrEliminarTarifa();
*/
?> 
