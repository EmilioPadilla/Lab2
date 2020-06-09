<?php
  session_start();
  require_once("../model.php");

  
  $idUsuario = htmlspecialchars($_POST["idUsuario"]);
  $usuario = htmlspecialchars($_POST["usuario"]);
  if( $_POST["password"] != "")
  {
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  }
  $nombre = htmlspecialchars($_POST["nombre"]);
  $rol = htmlspecialchars($_POST["rol"]);
  
  if(isset($password))
  {
  if(isset($idUsuario) && isset($usuario) && isset($nombre) && isset($rol)) {
    
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
  }else if(!isset($password)){
    $_SESSION["warning"] = "No se hizo ninguna modificacion";
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


  

  header("location:../usuarios/consultarCuentas.php");
?>