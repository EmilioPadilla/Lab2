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

	$idBeneficiaria = htmlspecialchars($_POST["idBeneficiaria"]);

	$nombreCompleto = htmlspecialchars($_POST["nombreCompleto"]);
	$fechaNacimiento = htmlspecialchars($_POST["fechaNacimiento"]);

	$edad = htmlspecialchars($_POST["edad"]);
	if($contactoInterno == "")
		$contactoInterno = NULL; 

	$fechaIngreso = htmlspecialchars($_POST["fechaIngreso"]);
	$idMotivoIngreso = htmlspecialchars($_POST["idMotivoIngreso"]);

	$otroMotivoIngreso = htmlspecialchars($_POST["otroMotivoIngreso"]);
	if($otroMotivoIngreso == "")
		$otroMotivoIngreso = NULL; 

	$nombreCanalizador = htmlspecialchars($_POST["nombreCanalizador"]);
	if($nombreCanalizador == "")
		$nombreCanalizador = NULL; 

	$consideracionesIngreso = htmlspecialchars($_POST["consideracionesIngreso"]);
	if($consideracionesIngreso == "")
		$consideracionesIngreso = NULL; 

	$diagnosticoInt = htmlspecialchars($_POST["diagnosticoInt"]);

	$diagnosticoMotriz = htmlspecialchars($_POST["diagnosticoMotriz"]);
	if($diagnosticoMotriz == "")
		$diagnosticoMotriz = NULL; 

	$edadMental = htmlspecialchars($_POST["edadMental"]);
	if($edadMental == "")
		$edadMental = NULL; 

	$antecedentes = htmlspecialchars($_POST["antecedentes"]);
	if($antecedentes == "")
		$antecedentes = NULL; 

	$vinculosFam = htmlspecialchars($_POST["vinculosFam"]);
	if($vinculosFam == "")
		$vinculosFam = NULL; 

	$convivencias = htmlspecialchars($_POST["convivencias"]);
	if($convivencias == "")
		$convivencias = NULL; 

	$tutela = htmlspecialchars($_POST["tutela"]);
	if($tutela == "")
		$tutela = NULL; 

	$situacionJuridica = htmlspecialchars($_POST["situacionJuridica"]);
	if($situacionJuridica == "")
		$situacionJuridica = NULL; 

	$idEscolaridad = htmlspecialchars($_POST["idEscolaridad"]);

	$gradoEscolar = htmlspecialchars($_POST["gradoEscolar"]);
	if($gradoEscolar == "")
		$gradoEscolar = NULL; 

	if(isset($nombreCompleto) && isset($fechaNacimiento) && isset($edad | $edad == NULL) && isset($fechaIngreso) && isset($idMotivoIngreso) && isset($otroMotivoIngreso | $otroMotivoIngreso == NULL) && isset($nombreCanalizador | $nombreCanalizador == NULL) && isset($consideracionesIngreso | $consideracionesIngreso == NULL) && isset($diagnosticoInt) && isset($diagnosticoMotriz | $diagnosticoMotriz == NULL) && isset($edadMental | $edadMental == NULL) && isset($antecedentes | $antecedentes == NULL) && isset($vinculosFam | $vinculosFam == NULL) && isset($tutela | $tutela == NULL) && isset($situacionJuridica | $situacionJuridica == NULL) && isset($convivencias | $convivencias == NULL) && isset($idEscolaridad) && isset($gradoEscolar | $gradoEscolar == NULL))
	{
		if(registrarBeneficiaria($nombreCompleto, $fechaNacimiento, $edad, $fechaIngreso, $idMotivoIngreso, $otroMotivoIngreso, $nombreCanalizador, $consideracionesIngreso, $diagnosticoInt, $diagnosticoMotriz, $edadMental, $antecedentes, $vinculosFam, $convivencias, $tutela, $situacionJuridica, $idEscolaridad, $gradoEscolar))
		{
			$_SESSION["mensaje"] = "El registro de la beneficiaria ha sido exitoso!";
		}
		else
		{
			$_SESSION["warning"] = "Ocurrió un error al registrar a la beneficiaria!";
		}
	}

	header("location:consultarBeneficiarias.php");
?>