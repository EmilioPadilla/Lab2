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
	
		$titulo = "Cuenta Personal";
		$registrando = 1;
		
		//poner los botones del sidebar como [nombreBtn, path]
		if($_SESSION["usuario"] === "Administradora")
		{
			$botones = [
				["Empleados", "../empleados/consultarEmpleado.php"],
				["Beneficiarias", "#"],
				["Donantes", "../donantes/consultarDonantes.php"],
				["Reportes", "../reportes/generarReporte.php"]
				
			];
		}
		else
		{
			$botones = [
				["Beneficiarias", "#"]
			];
		}
		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"../css/styles.css",
			"../css/prueba.css"
		];

		$scripts = [
			"../js/modificarCuenta.js"
		];
		include("../partials/_header.html");
		include("../partials/_mensajes.html");

	
		
		include("modificarCuentaPersonal.html");
	
		
		include("../partials/_footer.html")

?>