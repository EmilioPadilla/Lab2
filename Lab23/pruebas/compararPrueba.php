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



		$paso = htmlspecialchars($_GET["paso"]);

		//poner los botones del sidebar como [nombreBtn, path]
		if($paso === "seleccionar")
		{
			$titulo = "Seleccionar Prueba";
			$botones = [
				["Regresar", "../beneficiarias/verBeneficiaria.php"]
			];
		}
		else
		{
			$titulo = "Comparar Prueba";
			$botones = [
				["Regresar", "compararPrueba.php?paso=seleccionar"]
			];
		}

		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"../css/prueba.css",
			"https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"
		];

		$scripts = [
			"../js/prueba.js",
			"../js/compararPruebas.js"
		];

		include("../partials/_header.html");

		if($paso === "seleccionar")
			include("seleccionarPrueba.html");
		else
			include("compararPrueba.html");



		include("../partials/_footer.html");

?>
