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

		$titulo = "Cuentas Empleados";


		/*if(!isset($_SESSION["nombre"]))  {
		$titulo = "Favor de Iniciar Sesión";
		header("location:../controladores/controlador_cerrarSesion.php");
	} else {
		*/
		
		//poner los botones del sidebar como [nombreBtn, path]
		$botones = [
			["Empleados", "../empleados/consultarEmpleado.php"],
			["Beneficiarias", "#"],
			["Donantes", "../donantes/consultarDonantes.php"],
			["Reportes", "../reportes/generarReporte.php"]
		];
	
		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"../css/styles.css",
			"../css/tablaConScroll.css"
		];

		$scripts = [
			"../js/mensajes.js"
		];

		include("../partials/_header.html");
		include("../partials/_mensajes.html");
		include("consultarCuentas.html");
		
	
		
		include("../partials/_footer.html");
	

?>