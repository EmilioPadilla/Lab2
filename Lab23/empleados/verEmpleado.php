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

	$titulo = "Ver Empleado";

	//poner los botones del sidebar como [nombreBtn, path]
	$botones = [
		["Regresar", "consultarEmpleado.php"]
	];

	//poner los paths de los estilos que va a tener la página
	$estilos = [
		"../css/map.css",
		"../css/verEmpleado.css"
	];

	//poner los paths de los scripts de la página
	$scripts = [
		"../js/modificarEmpleado.js"
	];
	include("../partials/_header.html");

	$idEmpleado = htmlspecialchars($_GET["id"]);
    echo detalle_empleado($idEmpleado);

	//include("verEmpleado.html");



	include("../partials/_footer.html")
?>
