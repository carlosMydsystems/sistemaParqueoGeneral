<div class="content-wrapper">

  <section class="content-header">
    
    <h1>NOTAS DE CRÉDITO</h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">notas de credito</li>
    
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
           <th>NUMERO NOTA DE CREDITO</th>   
           <th>MOTIVO</th> 
           <th>FECHA DE EMISION</th>
           <th>TIPO DE DOCUMENTO</th>
           <th>RAZÓN SOCIAL</th>
           <th>RUC/DNI</th>
           <th>MONTO</th>
           
         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;
/*
        $valor = array( "condicion" => "PAGADO",
                        "estadoFacturaElectronica" => "Ok");
*/
        $notalistaNotaCredito = ControladorListaAnulaciones::ctrMostrarListaAnulaciones($item, $valor);

        foreach ($notalistaNotaCredito as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["serialAnulacion"]."-00".$value["numeroAnulacion"].'</td>
                  <td>'.$value["motivoAnulacion"].'</td>
                  <td>'.$value["fechaAnulacion"].'</td>
                  <td>'.$value["tipodocumento"].'</td>
                  <td>'.$value["razonsocial"].'</td>
                  <td>'.$value["ruc"].'</td>
                  <td>'.$value["montoPago"].'</td>';
          echo '<td>

            <div class="btn-group">
 
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

