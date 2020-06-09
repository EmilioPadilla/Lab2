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

	// 	PARAMETROS PARA CONSULTAR BENEFICIARIAS EGRESADAS

	if(isset($_POST["motivosEgreso"]))
		$idMotivoEgreso = htmlspecialchars($_POST["motivosEgreso"]);
	else
		$idMotivoEgreso = "";

	if (isset($_POST["destinos"]))
		$idDestino = htmlspecialchars($_POST["destinos"]);
	else
		$idDestino = "";

	if(isset($_POST["beneficiarias"]))
		$idBeneficiaria = htmlspecialchars($_POST["beneficiarias"]);
	else
		$idBeneficiaria = "";

	echo consultarBeneficiariasEgresadas($idMotivoEgreso, $idDestino, $idBeneficiaria);

?>