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

		$registrando = 1;

		//poner los botones del sidebar como [nombreBtn, path]
		$botones = [
			["Regresar", "verPrueba.php"]
		];

		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"../css/prueba.css"
		];

		$scripts = [
			"../js/prueba.js"
		];

		$titulo = "Plan de Seguimiento";
		include("../partials/_header.html");

		$tituloPlan = "Programa de Trabajo";
		include("_headerPlan.html");

		echo crear_card_beneficiaria($_SESSION["benefactual"]);
		/*
		ESTA FUNCION YA SIRVE, FALTA IMPLEMENTARLA
		llenar_plan_seguimiento($_SESSION["PruebaActual"], $_SESSION["BenefActual"], $_SESSION["seccionActual"], "Esto es automatico", "Esto es automatico");
		*/
		$fechaNac = recuperar($_SESSION["benefactual"], "beneficiarias", "idBeneficiaria", "fechaNacimiento");
		$edad = calculaEdad($fechaNac);

		include("planSeguimiento.html");

		// llenar_plan_seguimiento (1, 1, 2, "Esto fue hecho en controlador", "Eres una pistola");



		include("../partials/_footer.html");

?>
