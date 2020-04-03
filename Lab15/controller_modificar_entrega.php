<?php
require_once("model.php");
include("html/_header.html");
include("html/_modificarEnt.html");

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


 ?>
