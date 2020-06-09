<?php
	session_start();
	require_once("../model.php");
	$titulo = "Editar Usuarios";
	include("../partials/_header.html");
	if(!isset($_SESSION["nombre"]))  {
		$titulo = "Favor de Iniciar Sesión";
		header("location:../controladores/controlador_cerrarSesion.php");
	} else {
	

		//if(isset($_SESSION["administrar"])) {
			echo consultar_usuarios();
		//}
		//else
		//{
		//	$titulo = "Acceso Denegado";
		//	$recursos = "Editar Usuarios";
		//	include("_denied_access.html");
		//}
	}


	include("../partials/_footer.html");
?>
