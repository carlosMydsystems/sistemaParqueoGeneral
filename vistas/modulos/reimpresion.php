<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Reimpresi&oacuten de ticket
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Reimpresi&oacuten de ticket</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
<br>
      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>PLACA</th>
           <th>TIPO VEHICULO</th>
           <th>FECHA INGRESO</th>
           <th>HORA INGRESO</th>
           <th>CONDICION</th>
           <th style="width:200px">ACCIONES</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = "condicion";
        $valor = "PENDIENTE";

        $reimpresion = ControladorReimpresion::ctrMostrarReimpresion($item, $valor);

       foreach ($reimpresion as $key => $value){
           
           $fechaIngreso = explode(" ",$value["fechaingreso"])[0];
           $horaIngreso = explode(" ",$value["fechaingreso"])[1];
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["placa"].'</td>
                  <td>'.$value["nombretipovehiculo"].'</td>
                  <td>'.$fechaIngreso.'</td>
                  <td>'.$horaIngreso.'</td>
                  <td>'.$value["condicion"].'</td>
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnReimprimir" idestacionamiento="'.$value["idEstacionamiento"].'"><i class="fa fa-print"> Imprimir</i></button>
                      <button class="btn btn-danger btnAnularTicket" idestacionamiento="'.$value["idEstacionamiento"].'"><i class="fa fa-times"> Eliminar Ticket</i></button>

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

<?php

    $eliminarTicket = new ControladorReimpresion();
    $eliminarTicket -> ctrEliminarTicket();

?>



