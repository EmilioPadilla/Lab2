<?php
  session_start();
  require_once("model.php");
  include("html/_header.html");

  include("html/_table.html");

  if (isset($_POST["Materiales"])) {
      $clave = htmlspecialchars($_POST["Materiales"]);
  } else {
      $clave = "";
  }

  if (isset($_POST["Proveedores"])) {
      $rfc = htmlspecialchars($_POST["Proveedores"]);
  } else {
      $rfc = "";
  }

  if (isset($_POST["Proyectos"])) {
      $numero = htmlspecialchars($_POST["Proyectos"]);
  } else {
      $numero = "";
  }

  echo consultar_existencia($clave, $rfc, $numero);



  include("html/_footer.html")
 ?>
