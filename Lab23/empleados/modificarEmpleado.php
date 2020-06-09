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

		$titulo = "Modificar Empleado";
		$registrando = 1;

		$editar = htmlspecialchars($_GET["editar"]);
		
		//poner los botones del sidebar como [nombreBtn, path]
		if($editar === "general")
		{
			$botones = [
				["Regresar", "consultarEmpleado.php"]
			];
		}
		else
		{
			$botones = [
				["Regresar", "modificarEmpleado.php?editar=general"]
			];
		}
		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"../css/map.css",
			"../css/modificarEmpleado.css",
			"../css/prueba.css"
		];
		
		//poner los paths de los scripts que va a tener la página
		$scripts = [
			"../js/modificarEmpleado.js"
		];

		include("../partials/_header.html");

	
		if($editar === "general")	
			include("modificarEmpleado.html");
		else if($editar === "personal")
			include("modPers.html");
		else if($editar === "contacto")
			include("modContact.html");
		else if($editar === "contratacion")
			include("modContrat.html");
		else if($editar === "nomina")
			include("modNom.html");
		else if($editar === "beneficiarios")
			include("modBen.html");
		else if($editar === "archivos")
			include("modArch.html");
	
	
		
		include("../partials/_footer.html")

?>