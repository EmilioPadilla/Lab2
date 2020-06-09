<?php
    session_start();
    require_once("../model.php");
    $id = htmlspecialchars($_GET["id"]);

    echo detalle_empleado($id);
?>
