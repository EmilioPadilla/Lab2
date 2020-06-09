<?php
  session_start();
  require_once("model.php");

  $usuario = htmlspecialchars($_POST["usuario"]);
  $password = hash('sha512', $_POST["password"]);
  $nombre = htmlspecialchars($_POST["nombre"]);
  $rol = htmlspecialchars($_POST["rol"]);

  if(isset($usuario) && isset($password) && isset($nombre) && isset($rol)) {
      if (insertar_usuario($usuario,$password,$nombre,$rol)) {
          $_SESSION["mensaje"] = "Se registró el usuario";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al registrar el usuario";
      }
  }

  header("location:controlador_session.php");
?>
