<?php
	session_start();
	require_once("../model.php");

	$especialidad = htmlspecialchars($_POST["especialidad"]);
	$nombre = htmlspecialchars($_POST["nombres"]);
	$apellido = htmlspecialchars($_POST["apellidos"]);
	$direccion = htmlspecialchars($_POST["direccion"]);
	$telefono = htmlspecialchars($_POST["tel"]);
	$celular = htmlspecialchars($_POST["cel"]);
	$correo = htmlspecialchars($_POST["email"]);

	if(isset($especialidad) && isset($nombre) && isset($apellido) && isset($direccion) && isset($telefono) && isset($celular) && isset($correo))
	{
		if(agregar_medico($especialidad, $nombre, $apellido, $direccion, $telefono, $celular, $correo))
		{
			$_SESSION["mensaje"] = "Se registro un nuevo médico!";
		}
		else
		{
			$_SESSION["warning"] = "Hubo un error al registrar al médico!";
		}
	}

	header("location:../usuarios/vistaAdmin.php");
?>



