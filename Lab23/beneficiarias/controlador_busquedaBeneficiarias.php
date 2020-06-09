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

    // 	PARAMETROS PAR CONSULTAR BENEFICIARIAS ACTIVAS

	if(isset($_POST["motivosIngreso"]))
		$idMotivoIngreso = htmlspecialchars($_POST["motivosIngreso"]);
	else
		$idMotivoIngreso = "";
	if(isset($_POST["beneficiarias"]))
		$idBeneficiaria = htmlspecialchars($_POST["beneficiarias"]);
	else
		$idBeneficiaria = "";

	echo consultarBeneficiarias($idMotivoIngreso, $idBeneficiaria);

?>