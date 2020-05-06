<?php
  session_start();
  require_once("model.php");

  if (isset($_POST["tipo"]) && isset($_POST["lugar"])) {
    $_POST["tipo"] = htmlspecialchars($_POST["tipo"]);
    $_POST["lugar"] = htmlspecialchars($_POST["lugar"]);

    agregar_incidente($_POST["lugar"], $_POST["tipo"]);

    $_SESSION["exito"] = "Se registró el incidente con éxito";
  } else {
    $_SESSION["warning"] = "Hubo un error al registrar el incidente";
  }

  echo consultar_incidentes();
 ?>
