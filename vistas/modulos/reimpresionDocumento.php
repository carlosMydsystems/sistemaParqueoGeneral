<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Reimpresi&oacuten de Documentos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Reimpresi&oacuten de documentos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      <br>

      <div class="box">
        <div class="box-header with-border">
            <div class="form-group">
                <div class="container">
                    <form method="POST">
                        <div class="row col-lg-7">
                            <div class="input-group">
                                <span class="input-group-addon"><i>FECHA INICIO</i></span> 
                                <input type="date" class="btn btn-primary" name="fechaInicio">
                            </div>
                        </div>
                 
                        <div class="row col-lg-5">
                            <div class="input-group">
                                <input type ="submit" class="btn btn-success" value = "BUSCAR">
                            </div>
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>

      
      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>PLACA</th>
           <th>TIPO VEHICULO</th>
           <th>CLIENTE</th>
           <th>FECHA INGRESO</th>
           <th>MONTO PAGADO</th>
           <th>TIPO DOCUMENTO</th>
           <th>NUMERO DOCUMENTO</th>
           <th>CONDICION</th>
           <th style="width:200px">ACCIONES</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = "condicion";
        $valor = "PAGADO";
        $item1 = "fechapago";
        if(isset($_POST['fechaInicio'])){

          $valor1 = $_POST['fechaInicio'];

        }else{

          $valor1 = "2020-01-01";

        }
       
      
        $reimpresion = ControladorReimpresionDocumentos::ctrMostrarReimpresionDocumentos($item, $valor,$item1, $valor1);

       foreach ($reimpresion as $key => $value){
           
           $fechaIngreso = explode(" ",$value["fechaingreso"])[0];
           $horaIngreso = explode(" ",$value["fechaingreso"])[1];
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["placa"].'</td>
                  <td>'.$value["nombretipovehiculo"].'</td>
                  <td>'.$value["razonsocial"].'</td>
                  <td>'.$fechaIngreso.'</td>
                  <td>'.$value["montoPago"].'</td>
                  <td>'.$value["tipodocumento"].'</td>
                  <td>'.$value["serial"]." - ".$value["numerodocumento"].'</td>
                  <td>'.$value["condicion"].'</td>
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnReimprimirDocumento" idestacionamiento="'.$value["idEstacionamiento"].'"><i class="fa fa-print"> Imprimir</i></button>

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




