<?php
  session_start();
  require_once("model.php");  

  $_POST["lugar"] = htmlspecialchars($_POST["lugar"]);

  if(isset($_POST["lugar"])) {
      if (insertar_caso($_POST["lugar"])) {
          $_SESSION["mensaje"] = "Se registró el caso";
      } else {
          $_SESSION["warning"] = "Ocurrió un error al registrar el caso";
      }
  }

  header("location:controlador_session.php");
  exit;
?>