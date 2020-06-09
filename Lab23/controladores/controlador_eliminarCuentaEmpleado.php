<?php
	session_start();
	require_once("../model.php");


    $idUsuario = $_GET["id"];
  	$idRol = recuperar($idUsuario, "desempenia", "usuario_id", "rol_id");


	if(isset($idUsuario) && isset($idRol)){
		if(eliminar_cuentaE($idUsuario, $idRol)){
			$_SESSION["mensaje"] = "Se eliminó al usuario!";
		
			
		}
		else
		{
			$_SESSION["warning"] = "Hubo un error al eliminar al usuario!";
			
		} 
		
	}

	header("location:../usuarios/consultarCuentas.php");
?>