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

		$registrando = 1;
		$titulo = "Modificar Donante";
		
		//poner los botones del sidebar como [nombreBtn, path]
		$botones = [
			["Regresar", "consultarDonantes.php"],
		];
	 
		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"../css/styles.css",
			"../css/map.css",
			"../css/registrarDonante.css",
			"https://use.fontawesome.com/releases/v5.7.0/css/all.css",
			"https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"
		];
		
		$scripts = [
			"../js/donantes.js",
			"https://cdn.jsdelivr.net/momentjs/latest/moment.min.js",
			"https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js",
			"../css/prueba.css"
		];

		$idDonante = htmlspecialchars($_GET["id"]);
		$idTipo = recuperar($idDonante, "donantes", "idDonante", "idTipo");
		$nombreDonante = recuperar($idDonante, "donantes", "idDonante", "nombreDonante");
		$contactoInterno = recuperar($idDonante, "donantes", "idDonante", "contactoInterno");

		$correoParticular = recuperar($idDonante, "donantes", "idDonante", "correoParticular");
		$telefonoParticular = recuperar($idDonante, "donantes", "idDonante", "telefonoParticular");
		$extensionParticular = recuperar($idDonante, "donantes", "idDonante", "extensionParticular");
		$celularParticular = recuperar($idDonante, "donantes", "idDonante", "celularParticular");
		$fechaNacParticular = recuperar($idDonante, "donantes", "idDonante", "fechaNacParticular");
		if(!empty($fechaNacParticular))
			$fechaNacParticular = date_format(date_create($fechaNacParticular), "d/m/Y");


		$razonSocial = recuperar($idDonante, "donantes", "idDonante", "razonSocial");
		$RFCEntidad = recuperar($idDonante, "donantes", "idDonante", "RFCEntidad");
		$direccionEntidad = recuperar($idDonante, "donantes", "idDonante", "direccionEntidad");
		$cpEntidad = recuperar($idDonante, "donantes", "idDonante", "cpEntidad");
		
		
		$accion = "Modificar";
		$editar = true;

		include("../partials/_header.html");
	
		
		include("registrarDonantes.html");
	
	
		
		include("../partials/_footer.html")

?>