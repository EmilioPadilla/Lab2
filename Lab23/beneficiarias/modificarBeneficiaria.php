<?php
		require_once("../model.php");
		session_start();

		$titulo = "Modificar Beneficiaria";
		$registrando = 1;
		$editar = htmlspecialchars($_GET["editar"]);		
		//poner los botones del sidebar como [nombreBtn, path]
		if($editar === "general")
		{
			$botones = [
				["Regresar", "../beneficiarias/consultarBeneficiarias.php?status=activas"]
			];
		}
		else if($editar === "egreso"){
			$botones = [
				["Regresar", "../beneficiarias/consultarBeneficiarias.php?status=activas"]
			];
		}
		else
		{
			$botones = [
				["Regresar", "modificarBeneficiaria.php?editar=general"]
			];
		}
		//poner los paths de los estilos que va a tener la página
		$estilos = [
			"../css/map.css",
			"https://use.fontawesome.com/releases/v5.7.0/css/all.css",
			"../css/prueba.css"
		];
		
		//poner los paths de los scripts que va a tener la página
		$scripts = [
			"../js/modificarBeneficiaria.js"
		];

		include("../partials/_header.html");


		if($editar === "general"){
			$idBeneficiaria = htmlspecialchars($_GET["idBeneficiaria"]);
			$nombreCompleto = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "nombreCompleto");
			include("modificarBeneficiaria.html");
		}
		else if($editar === "personal"){
			$idBeneficiaria = htmlspecialchars($_GET["idBeneficiaria"]);
			$beneficiariaActiva = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "beneficiariaActiva");
			$nombreCompleto = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "nombreCompleto");
			$fechaNacimiento = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "fechaNacimiento");
			$edad = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "edad");
			include("modificarPersonal.html");
		}
		else if($editar === "ingreso"){
			$idBeneficiaria = htmlspecialchars($_GET["idBeneficiaria"]);
			$diagnosticoInt = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "diagnosticoInt");
			$diagnosticoMotriz = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "diagnosticoMotriz");
			$edadMental = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "edadMental");
			$fechaIngreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "fechaIngreso");
			$idMotivoIngreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "idMotivoIngreso");
			$motivoIngreso = recuperar($idMotivoIngreso, "motivosIngreso", "idMotivoIngreso", "motivoIngreso");
			$otroMotivoIngreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "otroMotivoIngreso");
			$nombreCanalizador = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "nombreCanalizador");
			$consideracionesIngreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "consideracionesIngreso");
			include("modificarIngreso.html");
		}
		else if($editar === "familiares"){
			$idBeneficiaria = htmlspecialchars($_GET["idBeneficiaria"]);
			$antecedentes = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "antecedentes");
			$vinculosFam  = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "vinculosFam");
			$convivencias = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "convivencias");
			$tutela = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "tutela");
			$situacionJuridica = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "situacionJuridica");
			include("modificarFamiliares.html");
		}
		else if($editar === "academicos"){
			$idBeneficiaria = htmlspecialchars($_GET["idBeneficiaria"]);
			$idEscolaridad = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "idEscolaridad");
			$nivelEscolar = recuperar($idEscolaridad, "escolaridad", "idEscolaridad", "nivelEscolar");
			$gradoEscolar = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "gradoEscolar");
			include("modificarAcademicos.html");
		}
		else if($editar === "archivos"){
			include("modificarArchivos.html");
		}
		else if($editar === "egreso"){
			$idBeneficiaria = htmlspecialchars($_GET["idBeneficiaria"]);
			$nombreCompleto = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "nombreCompleto");
			$fechaEgreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "fechaEgreso");
			$idMotivoEgreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "idMotivoEgreso");
			$motivoEgreso = recuperar($idMotivoEgreso, "motivosEgreso", "idMotivoEgreso", "motivoEgreso");
			$otroMotivoEgreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "otroMotivoEgreso");
			$consideracionesEgreso = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "consideracionesEgreso");
			$idDestino = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "idDestino");
			$nombreDestino = recuperar($idDestino, "destinos", "idDestino", "nombreDestino");
			$especificacionesDestino = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "especificacionesDestino");
			$nombreReceptor = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "nombreReceptor");
			$logros = recuperar($idBeneficiaria, "beneficiarias", "idBeneficiaria", "logros");
			include("modificarEgreso.html");
		}
	
	
		
		include("../partials/_footer.html")

?>