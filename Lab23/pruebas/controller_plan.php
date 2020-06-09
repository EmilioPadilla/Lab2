<?php
require_once("../model.php");
session_start();

	/*
		verificar que la sesión sea activa. (el timeout está en segundos)
	*/
	$time = $_SERVER['REQUEST_TIME'];
	$timeout_duration = 30;
	if (isset($_SESSION['LAST_ACTIVITY']) && 
	($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
		echo "<script>
		alert('Tu sesión ha expirado. Por favor vuelve a iniciar sesión.');
		window.location.href='../controladores/cerrarSesion.php';
		</script>";
	}
	$_SESSION['LAST_ACTIVITY'] = $time;	

  // $usuario = htmlspecialchars($_POST["usuario"]);
  // $password = hash('sha512', $_POST["password"]);
  // $nombre = htmlspecialchars($_POST["nombre"]);
  // $rol = htmlspecialchars($_POST["rol"]);

  if(isset($usuario) && isset($password) && isset($nombre) && isset($rol)) {
      if (registrar_Datos_seguimiento($usuario,$password,$nombre,$rol)) {
          $_SESSION["mensaje"] = "Se guadaron los datos con éxito!";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al guardar los datos";
      }
  }

  header("location:planseguimiento.php");
?>
