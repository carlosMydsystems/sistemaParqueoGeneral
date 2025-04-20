<div class="content-wrapper">

  <section class="content-header">
    
    <h1>ESTADO DE LOS DOCUMENTOS</h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Estado de documentos</li>
    
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
           <th>TIPO DOCUMENTO</th>
           <th>NUMERO DOCUMENTO</th>
           <th>FECHA PAGO</th>
           <th>MONTO</th>
           <th>ESTADO</th>
           <th>COMENTARIO</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = "estadoFacturaBoleta";
        $valor = "3";
        $valor1 = "0";

        $fallidos = ControladorEnvioFallido::ctrMostrarEstacionamientoEstado($item, $valor, $valor1);

       foreach ($fallidos as $key => $value){
           
           $fechaIngreso = explode(" ",$value["fechaingreso"])[0];
           $horaIngreso = explode(" ",$value["fechaingreso"])[1];
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["tipodocumento"].'</td>
                  <td>'.$value["serial"]."-".$value["numerodocumento"].'</td>
                  <td>'.$value["fechapago"].'</td>
                  <td>'.$value["montoPago"].'</td>
                  <td>'.$value["estadoFacturaBoleta"].'</td>
                  <td>'.$value["observacionFacturaBoleta"].'</td>
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnReEnviar"><i class="fa fa-print">Renviar</i></button>

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


