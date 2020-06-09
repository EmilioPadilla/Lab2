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
	

		$titulo = "Registrar Cuenta";
		$registrando = 1;

		$titulo = "Cuentas Empleados";
		 

		//poner los botones del sidebar como [nombreBtn, path]
		$botones = [
			["Regresar", "consultarCuentas.php"]
		];
	
		//poner los paths de los estilos que va a tener la página
		$estilos = [

			"../css/styles.css",
			"../css/prueba.css"

		];
		
		include("../partials/_header.html");
		include("../partials/_mensajes.html");

		
		include("registrarCuenta.html");
	
		
		include("../partials/_footer.html")

?>