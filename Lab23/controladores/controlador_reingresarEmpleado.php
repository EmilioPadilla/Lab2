<?php
    session_start();
    require_once("../model.php");
    var_dump($_POST);
    $id = htmlspecialchars($_POST["id"]);
    $fechaReingreso = htmlspecialchars($_POST["fechaReingreso"]);


    if(isset($id) && isset($fechaReingreso))
    {
        if(reingresarEmpleado($id, $fechaReingreso)){
            $_SESSION["mensaje"] = "Se reingresó el empleado!";
        }
        else
        {
            $_SESSION["warning"] = "Hubo un error al reingresar al empleado!";
        }
    }

    header("location:../empleados/consultarEmpleado.php");
?>
