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
	
		$titulo = "Donantes";
		
		//poner los botones del sidebar como [nombreBtn, path]
		$botones = [
			["Regresar", "consultarDonantes.php"],
		];
	
		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"../css/styles.css",
			"../css/tablaConScroll.css"
		];

		$scripts = [
			"../js/mensajes.js"
		];

		include("../partials/_header.html");
		include("../partials/_mensajes.html");

		$idDonante = htmlspecialchars($_GET["id"]);
		$idTipo = recuperar($idDonante, "donantes", "idDonante", "idTipo");
		$tipo = strtoupper(recuperar($idTipo, "tipodeDonante", "idTipo", "nombre"));
		$nombre = recuperar($idDonante, "donantes", "idDonante", "nombreDonante");
		$contacto = recuperar($idDonante, "donantes", "idDonante", "contactoInterno");

		switch($idTipo)
		{
			//si es Empresa, Gobierno o Fundación, solo se muestra la sección de entidad
			case '1': case '2': case '6':
				$detalle = "entidad";
				$razonSocial = recuperar($idDonante, "donantes", "idDonante", "razonSocial");
				$rfc = recuperar($idDonante, "donantes", "idDonante", "RFCEntidad");
				$dir = recuperar($idDonante, "donantes", "idDonante", "direccionEntidad");
				$cp = recuperar($idDonante, "donantes", "idDonante", "cpEntidad");
			break;
			//si es Particular, Cargo a tarjeta o fundación, solo se muestra la sección de particular
			case '3': case '4': case '5':
				$detalle= "particular";			
				$correo = recuperar($idDonante, "donantes", "idDonante", "correoParticular");
				$tel = recuperar($idDonante, "donantes", "idDonante", "telefonoParticular");
				$extension = recuperar($idDonante, "donantes", "idDonante", "extensionParticular");
				$cel = recuperar($idDonante, "donantes", "idDonante", "celularParticular");
				$fechaNac = recuperar($idDonante, "donantes", "idDonante", "fechaNacParticular");
			break;
			//si es otros contactos, se muestran las dos secciones
			case '7': default:
				$detalle = "todo";
				$razonSocial = recuperar($idDonante, "donantes", "idDonante", "razonSocial");
				$rfc = recuperar($idDonante, "donantes", "idDonante", "RFCEntidad");
				$dir = recuperar($idDonante, "donantes", "idDonante", "direccionEntidad");
				$cp = recuperar($idDonante, "donantes", "idDonante", "cpEntidad");

				$correo = recuperar($idDonante, "donantes", "idDonante", "correoParticular");
				$tel = recuperar($idDonante, "donantes", "idDonante", "telefonoParticular");
				$extension = recuperar($idDonante, "donantes", "idDonante", "extensionParticular");
				$cel = recuperar($idDonante, "donantes", "idDonante", "celularParticular");
				$fechaNac = recuperar($idDonante, "donantes", "idDonante", "fechaNacParticular");
				$fechaNac = date_format(date_create($fechaNac), "d/m/Y");
			break;
		}

		
		include("detalleDonantes.html");
	
		
		include("../partials/_footer.html")

?>