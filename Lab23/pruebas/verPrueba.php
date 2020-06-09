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

		$_SESSION["pruebaactual"] = 1;
		$benefActual = $_SESSION["benefactual"];


		$titulo = "Ver Prueba";

		//poner los botones del sidebar como [nombreBtn, path]
		$botones = [
			["Regresar", "../beneficiarias/verBeneficiaria.php"]
		];

		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"../css/prueba.css"
		];


		include("../partials/_header.html");

		//Con proposito de incluir car de beneficiaria, poner fluid-container aparte
		echo "<div class='fluid-container content verPr'>";
		echo crear_card_beneficiaria($benefActual);
		include("verPrueba.html");



		include("../partials/_footer.html")

?>
