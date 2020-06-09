<?php
	session_start();
	require_once("../model.php");

	$idMedico = htmlspecialchars($_POST["idMedico"]);
	$especialidad = htmlspecialchars($_POST["especialidad"]);
	$nombre = htmlspecialchars($_POST["nombres"]);
	$apellido = htmlspecialchars($_POST["apellidos"]);
	$direccion = htmlspecialchars($_POST["direccion"]);
	$telefono = htmlspecialchars($_POST["tel"]);
	$celular = htmlspecialchars($_POST["cel"]);
	$correo = htmlspecialchars($_POST["email"]);

	if(isset($idMedico) && isset($especialidad) && isset($nombre) && isset($apellido) && isset($direccion) && isset($telefono) && isset($celular) && isset($correo))
	{
		if(modificar_medico($idMedico, $especialidad, $nombre, $apellido, $direccion, $telefono, $celular, $correo))
		{
			$_SESSION["mensaje"] = "Se modificó la información del médico!";
		}
		else
		{
			$_SESSION["warning"] = "Hubo un error al modificar la información del médico!";
		} 
	}

	header("location:../usuarios/vistaAdmin.php");
?>