<?php
require_once("model.php");
if(isset($_GET["patternProyectos"]) && isset($_GET["tablaProyectos"])) {
  $patternProy = htmlspecialchars(strtolower($_GET["patternProyectos"]));
  $tablaProy = htmlspecialchars($_GET["tablaProyectos"]);
  $wordsProy = obtener_registros("Proyectos", "Denominacion");
  $idsProy = obtener_registros("Proyectos", "Numero");
  desplegar_opciones($wordsProy, $idsProy, $patternProy, $tablaProy);
}

if(isset($_GET["patternMateriales"]) && isset($_GET["tablaMateriales"])) {
  $patternMat = htmlspecialchars(strtolower($_GET["patternMateriales"]));
  $tablaMat = htmlspecialchars($_GET["tablaMateriales"]);
  $wordsMat = obtener_registros("Materiales", "Descripcion");
  $idsMat = obtener_registros("Materiales", "Clave");
  desplegar_opciones($wordsMat, $idsMat, $patternMat, $tablaMat);
}

if(isset($_GET["patternProveedores"]) && isset($_GET["tablaProveedores"])) {
  $patternProv = htmlspecialchars(strtolower($_GET["patternProveedores"]));
  $tablaProv = htmlspecialchars($_GET["tablaProveedores"]);
  $wordsProv = obtener_registros("Proveedores", "RazonSocial");
  $idsProv = obtener_registros("Proveedores", "RFC");
  desplegar_opciones($wordsProv, $idsProv, $patternProv, $tablaProv);
}


?>
