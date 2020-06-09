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
	
		$titulo = "Generar Reporte";
		
		//poner los botones del sidebar como [nombreBtn, path]
		$botones = [
			["Empleados", "../empleados/consultarEmpleado.php"],
			["Beneficiarias", "../beneficiarias/consultarBeneficiarias.php?status=activas"],
			["Donantes", "../donantes/consultarDonantes.php"],
			["Reportes", "../reportes/generarReporte.php"]
		];
	
		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"
		];

		$scripts = [
			"https://cdn.jsdelivr.net/jquery/latest/jquery.min.js",
			"https://cdn.jsdelivr.net/momentjs/latest/moment.min.js",
			"https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js",
			"../js/datePicker.js",
			"../js/generarReporte.js"
		];
		include("../partials/_header.html");
	
		
		include("Generar Reporte.html");
	
	
		
		include("../partials/_footer.html")

?>