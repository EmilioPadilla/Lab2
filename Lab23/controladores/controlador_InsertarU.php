<?php
  session_start();
  require_once("../model.php");


  $usuario = htmlspecialchars($_POST["usuario"]);
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $nombre = htmlspecialchars($_POST["nombre"]);
  $rol = htmlspecialchars($_POST["rol"]);

  
    if(buscarUsuarioRepetido($usuario)==1){
         $_SESSION["warning"] = "Ese usuario ya existe";


    }else if(isset($usuario) && isset($password) && isset($nombre) && isset($rol)){
      insertar_usuario($usuario,$password,$nombre,$rol);
          $_SESSION["mensaje"] = "Se registró el usuario";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al registrar el usuario";
      }
  
//echo "hola";
  header("location:../usuarios/consultarCuentas.php");
?>
