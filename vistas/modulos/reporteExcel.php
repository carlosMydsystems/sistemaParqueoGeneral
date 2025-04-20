<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      DESCARGAR REPORTE
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Descargar reporte</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
        <div class="box-header with-border">
            <div class="form-group">
                <div class="container">
                    <form method="GET" action="modelos/descargarExcel.php" >
                        <div class="row col-lg-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i>FECHA INICIO</i></span> 
                                <input type="date" class="btn btn-primary" name="fechaInicio">
                            </div>
                        </div>
                        <div class="row col-lg-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i>FECHA FINAL</i></span> 
                                <input type="date" class="btn btn-primary" name="fechaFinal">
                            </div>
                        </div>
                        <div class="row col-lg-2">
                            <div class="input-group">
                                <input type ="submit" class="btn btn-success" value = "DESCARGAR">
                            </div>
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>

  </section>

</div>


