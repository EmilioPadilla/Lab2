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


	  $seccionActual = calcular_seccion($_SESSION["benefactual"]);

		//poner los botones del sidebar como [nombreBtn, path]
		$botones = [
			["Regresar", "infoprueba.php"]
		];

		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"../css/prueba.css"
		];

		$scripts = [
			"../js/prueba.js",
			"../js/ajax.js"
		];

		$titulo = "Registrar Prueba";
		include("../partials/_header.html");


		$tituloPrueba = recuperar($seccionActual, "seccion", "ID", "categoria");
		include("_headerPrueba.html");
		echo crear_card_beneficiaria($_SESSION["benefactual"]);


		echo "<div id='tablaPrueba'>";
		echo crear_tabla_prueba($seccionActual, $_SESSION["pruebaactual"]);
		echo "</div>";


		include("_footerPrueba.html");


		include("../partials/_footer.html")

?>
