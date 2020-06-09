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

		$idPlantilla = htmlspecialchars($_POST["plantillaReporte"]);
		$tipo = recuperar($idPlantilla, "plantillaReporte", "idPlantilla", "nombre");
		date_default_timezone_set("America/Mexico_City");
		$fecha = date("d/m/Y H:i:s");

		//poner los botones del sidebar como [nombreBtn, path]
		$botones = [
			["Regresar", "generarReporte.php"]
		];

		$estilos = [
			"../css/reportes.css"
		];
	

		include("../partials/_header.html");
	
		
		include("verReporte.html");
	
	
		
		include("../partials/_footer.html")

?>