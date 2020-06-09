<?php
	session_start();
	require_once("../model.php");

	$idMedico = htmlspecialchars($_GET["id"]);
	$idEspecialidad = recuperar($idMedico, "medico", "idMedico", "idEspecialidad");


	if(isset($idMedico) && isset($idEspecialidad))
	{
		if(eliminar_medico($idMedico, $idEspecialidad))
		{
			$_SESSION["mensaje"] = "Se eliminó al médico!";
		
			
		}
		else
		{
			$_SESSION["warning"] = "Hubo un error al eliminar al médico!";
			
		}
		
	}

	header("location:../usuarios/vistaAdmin.php");
?>