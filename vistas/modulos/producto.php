<div class="content-wrapper">

  <section class="content-header">
    
    <h1>PAGO DE PARQUEO DE VEHICULOS</h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Pago del parqueo de Veh&iacuteculos</li>
    
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
                            <div class="row">
                                <div class="container">
                                    <div class="col-lg-6"> 
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon input-lg"><i class="fa fa-barcode" aria-hidden="true"> &nbsp &nbsp CODIGO BARRA</i></span> 
                                                <input type="text" class="form-control input-lg" id="idEstacionamiento" name="idEstacionamiento" style="font-size:25px;"  
                                                placeholder="Ingresar codigo de barras" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" style="display:none; " id="mesAbonado"> 
                                        <div class="form-group">
                                            <select type="text" class="form-control multiselect multiselect-icon"  style="font-size:18px; height:46px; width:145px;" role="multiselect">          
                                              <option value="0" data-icon="glyphicon-picture" selected="selected">MES</option>          
                                              <option value="6" data-icon="glyphicon-link">JUNIO</option>
                                              <option value="7" data-icon="glyphicon-pencil">AGOSTO</option>
                                              <option value="8" data-icon="glyphicon-shopping-cart">SETIEMBRE</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6"> 
                                        <div class="form-group">
                                            <select type="text" class="form-control multiselect multiselect-icon" id="tipoPago" name="tipoPago" style="font-size:18px; height:46px; width:145px;" role="multiselect">          
                                              <option value="EFECTIVO" data-icon="glyphicon-picture" selected="selected">EFECTIVO</option>          
                                              <option value="TARJETA CREDITO" data-icon="glyphicon-link">T. CREDITO</option>
                                              <option value="TARJETA DEBITO" data-icon="glyphicon-pencil">T. DEBITO</option>
                                              <option value="YAPE" data-icon="glyphicon-shopping-cart">YAPE</option>
                                              <option value="PLIN" data-icon="glyphicon-shopping-cart">PLIN</option>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <br>
                        <div id="bloque" style="display:none;">
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><button class="btn btn-success btn-xl btnClienteChifa" clienteChifa="" estadoChifa="0" style="display:none;">CLIENTE ORDINARIO</button></span> 
                                <span class="input-group-addon"><button class="btn btn-success btn-xl btnCarretilla" estadoCarretilla="0" style="display:none;">SIN CARRETILLA</button></span>
                                <span class="input-group-addon" id="btnAcumulado"><button class="btn btn-success btn-xl btnAcumulado" estadoAcumulado="0" style="display:none;">ORDINARIO</button></span>
                            </div>
                        </div>

                        <div id="datos-chat">
                            <div id="contenedor" class="notificacionTarea " style="background:#F7F6F4;" >
                                <div><span style="color:#1c62c4; font-size:15px;">PLACA: <span style="color:#000;" id="placaVehiculo"></span></span></div>
                                
                                <div class="row" id="muestraClienteNormalEstacionamiento">
                                    
                                    <div class="col-lg-4"><span style="color:#1c62c4; font-size:15px;">INGRESO: <span style="color:#000;" id="fechaHoraIngresoVehicular"></span></span></div>
                                    <div class="col-lg-4"><span style="color:#1c62c4; font-size:15px;">SALIDA: <span style="color:#000;" id="fechaHoraSalidaVehicular"></span></span></div>
                                    <div class="col-lg-4"><span style="color:#1c62c4; font-size:15px;">MONTO: <span style="color:#000;" id="montoDetalle"></span></span></div>
                                    
                                </div>

                                <div class="row" id="muestraDetalleEstacionamiento" style="display:none;">
                                    <table class="table table-bordered table-striped dt-responsive" width="90%">
                                        <thead>
                                            <tr>
                                                <th style="width:20px">HORA DE INGRESO</th>
                                                <th style="width:20px">HORA DE SALIDA</th>
                                                <th style="width:20px">CANT. HORAS</th>
                                                <th style="width:20px">MONTO</th>
                                            </tr> 
                                        </thead>
                                        <tbody id="contenido">
                                            
                                            <!--  Se muestra dinamicamente la tabla -->
                                            
                                        </tbody>
                                </table> 
                                </div>
            
                                <br>
                                <!--<span style="float:right; font-size:11px; vertical-align:text-botton; color:#FF00FF"><?php echo date('d-M-Y ',strtotime($value['fechaCreacion']))?></span>-->
                            </div>
                        </div>
                        <br>
                   
                        <table class="table table-bordered table-striped dt-responsive" width="90%">
                            <thead>
                                <tr>
                                    <th style="width:20px"></th>
                                    <th style="width:20px">TOTAL</th>
                                    <th style="width:20px">NETO</th>
                                    <th style="width:20px">IGV</th>
                                    <th style="width:20px">HORAS</th>
                                     <th style="width:20px">CONDICION</th>
                                </tr> 
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-success btn-xl btnBoletaFactura" estadoBoleta="0" style="display:none;">BOLETA</button>
                                        </div>  
                                    </td>
                                    <td><input type="text" class="form-control input" id="monto"></td>
                                    <td><input type="text" class="form-control input" id="subtotal"></td>
                                    <td><input type="text" class="form-control input" id="igv"></td>
                                    <td><input type="text" class="form-control input" id="cantidadHoras"></td>
                                    <td><input type="text" class="form-control input" id="condicion"></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div id="datosFactura" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    
                                    <span class="input-group-addon input-lg"> &nbsp &nbsp RUC: </span> 
                                    <input type="text" class="form-control input-lg col-lg-1" id="rucCliente" required>
                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    
                                    <span class="input-group-addon input-lg"> &nbsp &nbsp Razon social: </span> 
                                    <input type="text" class="form-control input-lg" id="razonSocialCliente" required>
                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                   
                                    <span class="input-group-addon input-lg"> &nbsp &nbsp Direccion fiscal: </span> 
                                    <input type="text" class="form-control input-lg" id="direccionFiscalCliente">
                                    <input type="hidden" id="montoReal">
                                    <input type="hidden" id="tipoDocumento">
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div id="datosBoleta">
                            <div class="form-group">
                                <div class="input-group">
                                    
                                    <span class="input-group-addon input-lg"> &nbsp &nbsp DNI: </span> 
                                    <input type="text" class="form-control input-lg col-lg-1" id="dniCliente">
                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                   
                                    <span class="input-group-addon input-lg"> &nbsp &nbsp Direccion : </span> 
                                    <input type="text" class="form-control input-lg" id="direccionDniCliente">
                                    <input type="hidden" id="montoReal">
                                    <input type="hidden" id="tipoDocumento">
                                    
                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="btnAcumular" style="display:none;"><button class="btn btn-success btn-xl btnAcumular" >ACUMULAR</button></span>
                                <span class="input-group-addon" id="mostrarBtnPagar"><button class="btn btn-success btn-xl" id="btnPagar">PAGAR</button></span>
                                <span class="input-group-addon" id="mostrarBtnPagarAcumulado" style="display:none;"><button class="btn btn-success btn-xl" id="btnPagarAcumulado">PAGAR ACUMULADO</button></span>

                            </div>
                       
                        </div>

                        <!--<input type="text" id="contadorRepetido"> 
                            <input type="text" id="contador"> -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>
            <div class="box">

      <div class="box-body">
          
        <div class="container">
            <div style="display:none;" id="clientes" class = "box">
                <br>
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
                          <input type = "button" class="btn btn-warning btnSeleccionarCliente" idCliente="'.$value["idCliente"].'" rucCliente="'.$value["ruc"].'" 
                          razonSocialCliente="'.$value["razonSocial"].'" direccionFiscalCliente="'.$value["direccionFiscal"].'" value = "Seleccionar">
                      </td>
            
                    </tr>';
            }
        ?> 
        
        </tbody>
        
        </table>
        
        </div>
        </div>
        </div>
        </div>
    </div>

  </section>

</div>



