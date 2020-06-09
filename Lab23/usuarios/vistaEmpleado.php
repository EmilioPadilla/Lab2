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
		
	$_SESSION["usuario"] = "Empleado General";
	$titulo = "Casa Maria Goretti";

	//poner los botones del sidebar como [nombreBtn, path]
	$botones = [
		["Beneficiarias", "#"]
	];	
	
	//poner los paths de los estilos que va a tener la página
	$estilos = [
		"../css/styles.css",
		"../css/map.css",
		'https://use.fontawesome.com/releases/v5.0.6/css/all.css',
		'../node_modules/@fullcalendar/core/main.css',
		'../node_modules/@fullcalendar/daygrid/main.css',
		'../node_modules/@fullcalendar/bootstrap/main.css',
		"../css/calendario.css"
	];

	$scripts = [
		'../node_modules/@fullcalendar/core/main.js',
		'../node_modules/@fullcalendar/core/locales/es.js',
		'../node_modules/@fullcalendar/daygrid/main.js',
		'../node_modules/@fullcalendar/bootstrap/main.js',
		'../node_modules/@fullcalendar/interaction/main.js',
		"../js/calendarioGeneral.js",
		"../js/agenda.js"
	];

	include("../partials/_header.html");

	include("principalEmpleado.html");
 
	echo "<br/><br/><br/><br/><br/>";
	echo  carruselMedico();

	include("../partials/_footer.html")

?>