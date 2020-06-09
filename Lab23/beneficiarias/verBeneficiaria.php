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

		$titulo = "Ver Beneficiaria";

		// $idBeneficiaria = htmlspecialchars($_GET["idBeneficiaria"]);

		if (isset($_GET["idBeneficiaria"])) {
			$idBeneficiaria = htmlspecialchars($_GET["idBeneficiaria"]);
			$_SESSION["benefactual"] = $idBeneficiaria;
		} else {
			$idBeneficiaria = $_SESSION["benefactual"];
		}
		//$nombreCompleto = $_GET['nombreCompleto'];

		//$_SESSION["benefactual"] = 1; //$_GET["beneficariaElegida"]

		//poner los botones del sidebar como [nombreBtn, path]
		$botones = [
			["Regresar", "../usuarios/vistaEmpleado.php"]
		];
		if($_SESSION["usuario"] === "Administradora")
		{
			$botones = [
				["Regresar", "../beneficiarias/consultarBeneficiarias.php?status=activas"]
			];
		}

		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"../css/stylesA.css",
			"https://use.fontawesome.com/releases/v5.7.0/css/all.css"
		];

		include("../partials/_header.html");


		$beneficiariaActiva = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "beneficiariaActiva");
		$nombreCompleto = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "nombreCompleto");
		$fechaNacimiento = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "fechaNacimiento");
		$edad = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "edad");
		$antecedentes = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "antecedentes");
		$diagnosticoInt = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "diagnosticoInt");
		$diagnosticoMotriz = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "diagnosticoMotriz");
		$edadMental = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "edadMental");
		$fechaIngreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "fechaIngreso");
		$idMotivoIngreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "idMotivoIngreso");
		$motivoIngreso = recuperar($idMotivoIngreso, "motivosIngreso", "idMotivoIngreso", "motivoIngreso");
		$otroMotivoIngreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "otroMotivoIngreso");
		$nombreCanalizador = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "nombreCanalizador");
		$consideracionesIngreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "consideracionesIngreso");
		$vinculosFam  = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "vinculosFam");
		$convivencias = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "convivencias");
		$tutela = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "tutela");
		$situacionJuridica = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "situacionJuridica");
		$idEscolaridad = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "idEscolaridad");
		$nivelEscolar = recuperar($idEscolaridad, "escolaridad", "idEscolaridad", "nivelEscolar");
		$gradoEscolar = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "gradoEscolar");
		$fechaEgreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "fechaEgreso");
		$idMotivoEgreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "idMotivoEgreso");
		$motivoEgreso = recuperar($idMotivoEgreso, "motivosEgreso", "idMotivoEgreso", "motivoEgreso");
		$otroMotivoEgreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "otroMotivoEgreso");
		$idDestino = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "idDestino");
		$nombreDestino = recuperar($idDestino, "destinos", "idDestino", "nombreDestino");
		$especificacionesDestino = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "especificacionesDestino");
		$nombreReceptor = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "nombreReceptor");
		$logros = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "logros");

		include("verBeneficiaria.html");
		include("../partials/_footer.html")

?>
