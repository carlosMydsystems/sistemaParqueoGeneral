<div id="back"></div>
<div style="text-align:center; width:90% ; height:110px; background:#2878EB; margin:50px; ">
<div style="height:50px; width:400px;margin:100px auto;">
      <div class="login-logo">
          
          <h2>Estacionamiento San Andr&eacutes</h2>

      </div>
  </div>
  </div>
<div class="login-box" style="text.align:center">
  

  <div class="login-box-body" >

    <p class="login-box-msg" style="font-size:18px; font-weight: bold; color:#000;">CONTROL DEL INGRESO DE VEHICULOS</p>

    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      
      </div>

      <div class="row">
       
        <div class="col-xs-4" style="margin-left: 50%;transform: translateX(-50%);" >
        <div >
            
                <button type="submit" id = "btnLogin" class="btn btn-primary" >Ingresar</button>
          
        </div>
        </div>

      </div>

      <?php

        $login = new ControladorLogin();
        $login -> ctrIngresoUsuario();
        
      ?>

    </form>

  </div>

</div>
