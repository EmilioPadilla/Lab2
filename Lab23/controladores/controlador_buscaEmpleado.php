<?php
    session_start();
    require_once("../model.php");
    $puesto = htmlspecialchars($_POST["puesto"]);
    $empleado = htmlspecialchars($_POST["idEmpleado"]);
    echo consultar_empleados($puesto,$empleado);
?>
