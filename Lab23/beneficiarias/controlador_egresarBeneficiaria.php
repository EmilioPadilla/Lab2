<?php 
  session_start();
  require_once("../model.php");

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

  var_dump($_POST);
  $idBeneficiaria = htmlspecialchars($_POST["idBeneficiaria"]);
  $fechaEgreso = htmlspecialchars($_POST["fechaEgreso"]);
  $motivosEgreso = htmlspecialchars($_POST["motivosEgreso"]);
  $otroMotivoEgreso = htmlspecialchars($_POST["otroMotivoEgreso"]);
  $destinos = htmlspecialchars($_POST["destinos"]);
  $especificacionesDestino = htmlspecialchars($_POST["especificacionesDestino"]);
  $consideracionesEgreso = htmlspecialchars($_POST["consideracionesEgreso"]);
  $logros = htmlspecialchars($_POST["logros"]);
  $nombreReceptor = htmlspecialchars($_POST["nombreReceptor"]);

  
  
  if(isset($idBeneficiaria) && isset($fechaEgreso) && isset($motivosEgreso) && isset($destinos) && isset($especificacionesDestino) && isset($consideracionesEgreso) && isset($logros) && isset($nombreReceptor) && isset($otroMotivoEgreso))
  	{
		if(egresarBeneficiaria($idBeneficiaria, $fechaEgreso, $motivosEgreso, $otroMotivoEgreso, $consideracionesEgreso, $destinos, $especificacionesDestino, $nombreReceptor, $logros))
		{
			$_SESSION["mensaje"] = "La beneficiaria fue egresada de manera exitosa!";
		}
		else
		{
			$_SESSION["warning"] = "Hubo un error al intentar egresar a la beneficiaria seleccionada!";
		}
	}

	header("location:consultarBeneficiaria.php");
?>