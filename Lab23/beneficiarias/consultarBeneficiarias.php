<?php
	require_once("../model.php");
	session_start();

	/*
		verificar que la sesión sea activa. (el timeout está en segundos)
	*/
	$time = $_SERVER['REQUEST_TIME'];
	$timeout_duration = 3000;
	if (isset($_SESSION['LAST_ACTIVITY']) &&
	($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
		echo "<script>
		alert('Tu sesión ha expirado. Por favor vuelve a iniciar sesión.');
		window.location.href='../controladores/cerrarSesion.php';
		</script>";
	}
	$_SESSION['LAST_ACTIVITY'] = $time;

	$status = htmlspecialchars($_GET["status"]);

	if ($status === "activas") {
		$titulo = "Beneficiarias activas";
	}
	else if ($status === "INACTIVAS") {
		$titulo = "Beneficiarias inactivas";
	}

	//poner los botones del sidebar como [nombreBtn, path]
	$botones = [
		["Empleados", "../empleados/consultarEmpleado.php"],
		["Beneficiarias", "../beneficiarias/consultarBeneficiarias.php?status=activas"],
		["Donantes", "../donantes/consultarDonantes.php"],
		["Reportes", "../reportes/generarReporte.php"]
	];

	//poner los paths de los estilos que va a tener la página
	$estilos = [
		"../css/map.css",
		"../css/consultarBeneficiarias.css",
		//"../css/tablaConScroll.css"
		"tablaConScroll.css"
	];

	include("../partials/_header.html");
	include("../partials/_mensajes.html");

	include("consultarBeneficiarias.html");

	$scripts = [
			//"../js/ajaxBeneficiarias.js"
			"ajaxBeneficiarias.js",
	];

	include("egresar.html");
	include("reingresar.html");
	include("../partials/_footer.html")
?>
