<?php
    session_start();
    require_once("model.php");

    $clave = htmlspecialchars($_GET["Materiales"]);
    $rfc = htmlspecialchars($_GET["Proveedores"]);
    $numero = htmlspecialchars($_GET["Proyectos"]);
    echo consultar_existencia($clave, $rfc, $numero);
?>
