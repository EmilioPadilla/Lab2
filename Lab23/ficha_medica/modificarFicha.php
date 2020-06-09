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
	
		$titulo = "Modificar Ficha Médica";
		
		//poner los botones del sidebar como [nombreBtn, path]
		$botones = [
			["Regresar", "../beneficiarias/verBeneficiaria.php"]
		];
	
		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"../css/map.css",
			"https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"
		];

		$scripts = [
			"https://cdn.jsdelivr.net/jquery/latest/jquery.min.js",
			"https://cdn.jsdelivr.net/momentjs/latest/moment.min.js",
			"https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js",
			"../js/datePicker.js",
			"../js/registrarFichaM.js",
			"../js/modificarFicha.js"
		];


		include("../partials/_header.html");
	
		
		include("modificarFicha.html");
	
	
		
		include("../partials/_footer.html")

?>