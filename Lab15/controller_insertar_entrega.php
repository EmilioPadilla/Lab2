<?php
session_start();
require_once("model.php");

if (isset($_POST["Materiales"]) && isset($_POST["Proveedores"]) && isset($_POST["Proyectos"]) &&  isset($_POST["Cantidad"])) {
  $_POST["Materiales"] = htmlspecialchars($_POST["Materiales"]);
  $_POST["Proveedores"] = htmlspecialchars($_POST["Proveedores"]);
  $_POST["Proyectos"] = htmlspecialchars($_POST["Proyectos"]);
  $_POST["Cantidad"] = htmlspecialchars($_POST["Cantidad"]);

  insertar_entrega($_POST["Materiales"], $_POST["Proveedores"], $_POST["Proyectos"], $_POST["Cantidad"]);
  $_SESSION["exito"] = "Se registró el caso con éxito";
} else {
  $_SESSION["warning"] = "Se registró el caso con éxito";
}
  header("location:index.php");

 ?>
