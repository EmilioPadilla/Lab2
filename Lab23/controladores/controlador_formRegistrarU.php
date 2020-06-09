<?php
  require_once("../model.php");

  $titulo = "Registrar un nuevo usuario";
  include("../partials/_header.html");
  include("../partials/_mensajes.html");

  include("../usuarios/registrarCuenta.php");

  include("../partials/_footer.html");
?>
