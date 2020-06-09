<?php
	session_start();
	require_once("../../model.php");

	$idTipo = htmlspecialchars($_POST["tipodeDonante"]);
	$fechaRegistro = date("Y-m-d");
	$nombreDonante = htmlspecialchars($_POST["nombreDonante"]);
	$contactoInterno = htmlspecialchars($_POST["contactoInterno"]);
	if($contactoInterno == "")
		$contactoInterno = NULL; 

	$correoParticular = htmlspecialchars($_POST["correoParticular"]);
	if($correoParticular == "")
		$correoParticular = NULL; 

	$telefonoParticular = htmlspecialchars($_POST["telefonoParticular"]);
	if($telefonoParticular == "")
		$telefonoParticular = NULL; 

	$extensionParticular = htmlspecialchars($_POST["extensionParticular"]);
	if($extensionParticular == "")
		$extensionParticular = NULL; 

	$celularParticular= htmlspecialchars($_POST["celularParticular"]);
	if($celularParticular == "")
		$celularParticular = NULL; 

	$fechaNacParticular = htmlspecialchars($_POST["fechaNacParticular"]);
	echo $fechaNacParticular.",";
	if($fechaNacParticular == "")
		$fechaNacParticular = NULL; 
	else
		$fechaNacParticular = date("Y-m-d", strtotime($fechaNacParticular));

	echo $fechaNacParticular;

	$razonSocial = htmlspecialchars($_POST["razonSocial"]);
	if($razonSocial == "")
		$razonSocial = NULL; 

	$RFCEntidad = htmlspecialchars($_POST["RFCEntidad"]);
	if($RFCEntidad == "")
		$RFCEntidad = NULL; 

	$direccionEntidad = htmlspecialchars($_POST["direccionEntidad"]);
	if($direccionEntidad == "")
		$direccionEntidad = NULL;

	$cpEntidad = htmlspecialchars($_POST["cpEntidad"]);
	if($cpEntidad == "")
		$cpEntidad = NULL; 


	if(isset($idTipo) && isset($fechaRegistro) && isset($nombreDonante) && (isset($contactoInterno) | $contactoInterno == NULL) && (isset($correoParticular) | $correoParticular == NULL)
	 && (isset($telefonoParticular) | $telefonoParticular == NULL) && (isset($extensionParticular) | $extensionParticular == NULL) 
	 && (isset($celularParticular) | $celularParticular == NULL) && (isset($fechaNacParticular) | $fechaNacParticular == NULL) && (isset($razonSocial) | $razonSocial == NULL) 
	 && (isset($RFCEntidad) | $RFCEntidad == NULL) && (isset($direccionEntidad) | $direccionEntidad == NULL) && (isset($cpEntidad) | $cpEntidad == NULL))
	{
		
		if(agregar_donante($idTipo, $fechaRegistro, $contactoInterno, $nombreDonante, $correoParticular, $telefonoParticular, $extensionParticular,
		$celularParticular, $fechaNacParticular, $razonSocial, $RFCEntidad, $direccionEntidad, $cpEntidad))
		{
			$_SESSION["mensaje"] = "Se registro un nuevo donante!";
		}
		else
		{
			$_SESSION["warning"] = "Hubo un error al registrar al donante!";
		}
	}

	header("location:../../donantes/consultarDonantes.php");
?>
