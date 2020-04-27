<?php
session_start();
require_once("model.php");

if (isset($_POST["Materiales"]) && isset($_POST["Proveedores"]) && isset($_POST["Proyectos"]) &&  isset($_POST["Entregan"])) {
  $_POST["Materiales"] = htmlspecialchars($_POST["Materiales"]);
  $_POST["Proveedores"] = htmlspecialchars($_POST["Proveedores"]);
  $_POST["Proyectos"] = htmlspecialchars($_POST["Proyectos"]);
  $_POST["Entregan"] = htmlspecialchars($_POST["Entregan"]);

  eliminar_entrega($_POST["Materiales"], $_POST["Proveedores"], $_POST["Proyectos"], $_POST["Entregan"]);
  $_SESSION["exito"] = "Se eliminó la entrega con éxito";
} else {
  $_SESSION["warning"] = "Hubo un error al eliminar la entrega";
}
  header("location:index.php");
?>
