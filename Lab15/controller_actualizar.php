<?php
session_start();
require_once("model.php");


if (isset($_POST["Materiales"]) && isset($_POST["Proveedores"]) && isset($_POST["Proyectos"])) {
  $_POST["Materiales"] = htmlspecialchars($_POST["Materiales"]);
  $_POST["Proveedores"] = htmlspecialchars($_POST["Proveedores"]);
  $_POST["Proyectos"] = htmlspecialchars($_POST["Proyectos"]);
  $_POST["Entregan"] = htmlspecialchars($_POST["Entregan"]);

  editar_entrega($_SESSION["fecha"], $_POST["Materiales"], $_POST["Proveedores"], $_POST["Proyectos"], $_POST["Entregan"]);
  $_SESSION["exito"] = "Se actualizó la entrega con éxito";
} else {
  $_SESSION["warning"] = "Hubo un error al actualizar la entrega";
}
  header("location:index.php");
?>
