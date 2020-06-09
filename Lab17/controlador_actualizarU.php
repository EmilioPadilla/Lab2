<?php
  session_start();
  require_once("model.php");

  $idUsuario = htmlspecialchars($_POST["idUsuario"]);
  $usuario = htmlspecialchars($_POST["usuario"]);
  if($_POST["oldPwd"] != "" && $_POST["password"] != "")
  {
	$oldPwd = hash('sha512', $_POST["oldPwd"]);
	$password = hash('sha512', $_POST["password"]);
  }
  $nombre = htmlspecialchars($_POST["nombre"]);
  $rol = htmlspecialchars($_POST["rol"]);
  
  if(isset($oldPwd) && isset($password))
  {
	if(isset($idUsuario) && isset($usuario) && isset($nombre) && isset($rol)) {
		if($oldPwd === recuperar($idUsuario, "usuario", "id", "password"))
		{
		  if (editar_usuario($idUsuario,$usuario,$password,$nombre,$rol)) {
			  $_SESSION["mensaje"] = "Se modificó el usuario";
			  
		  } else {
			  $_SESSION["warning"] = "Ocurrió un error al modificar al usuario";
		  }
		}
		else
		{
		  $_SESSION["warning"] = "Ocurrió un error al modificar al usuario";
		}
	}
  }
  else
  {
	$password = recuperar($idUsuario, "usuario", "id", "password");
	if(isset($idUsuario) && isset($usuario) && isset($password) && isset($nombre) && isset($rol)) {
		  if (editar_usuario($idUsuario,$usuario,$password,$nombre,$rol)) {
			  $_SESSION["mensaje"] = "Se modificó el usuario";
			  
		  } else {
			  $_SESSION["warning"] = "Ocurrió un error al modificar al usuario";
		  }

	}
  }


  

  header("location:controlador_session.php");
?>
