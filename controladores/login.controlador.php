<?php

class ControladorLogin
{

	/*=============================================
	   INGRESO DE USUARIO
	   =============================================*/

	static public function ctrIngresoUsuario()
	{

		if (isset($_POST["ingUsuario"])) {

			if (
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])
			) {

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {

					if ($respuesta["estado"] == 1) {

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];

						/*=============================================
						  REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

						date_default_timezone_set('America/Bogota');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$tablacaja = "caja";

						$datos = array(
							"usuarioId" => $_SESSION["id"],
							"fechaCaja" => $fecha,
							"estadoCaja" => 0
						);

						$caja = ModeloLogin::mdlMostrarCaja($tablacaja, $datos);

						if (!$caja) {
							$datos = array(
								"usuarioId" => $_SESSION["id"],
								"fechaCaja" => $fecha,
								"estadoCaja" => 0
							);
							$_SESSION["cajaDuplicada"] = "No";
							$agregarCaja = modeloLogin::mdlCrearCaja($tablacaja,$datos);
							$_SESSION["idCaja"] = $agregarCaja;
						}else{
							$_SESSION["idCaja"] = $caja["idCaja"];
							$_SESSION["cajaDuplicada"] = "Si";
						}

						$fechaActual = $fecha . ' ' . $hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id";
						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						if ($ultimoLogin != "error") {
							echo '<script>
								window.location = "inicio";
							</script>';
						}

					} else {

						echo '<br>
							<div class="alert alert-danger">El usuario aún no está activado</div>';

					}

				} else {

					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

				}

			}

		}

	}

}



