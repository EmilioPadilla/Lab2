<?php
session_start();
require_once("model.php");

$fecha = htmlspecialchars($_GET["e_fecha"]);
$titulo = "Actualizar Entrega ".$fecha;
// $warning_eliminar = true;
include("html/_header.html");
$_SESSION["fecha"] = $fecha;

//Recuperar los campos a Modificar
$clave = recuperar_campo($fecha, "Clave");
$rfc = recuperar_campo($fecha, "RFC");
$numero = recuperar_campo($fecha, "Numero");
$cantidad = recuperar_campo($fecha, "Cantidad");

// $fecha_id = recuperar_lugar($fecha);
include("html/_form_actualizar.html");

include("html/_footer.html");



 ?>
