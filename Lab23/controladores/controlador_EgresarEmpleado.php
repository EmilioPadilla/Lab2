<?php
    session_start();
    require_once("../model.php");
    var_dump($_POST);
    $id = htmlspecialchars($_POST["id"]);
    $fechaEgreso = htmlspecialchars($_POST["fechaEgreso".$id.""]);
    $motivoEgreso = htmlspecialchars($_POST["motivoEgreso".$id.""]);

    if(isset($id) && isset($fechaEgreso))
    {
        if(egresarEmpleado($id, $fechaEgreso, $motivoEgreso)){
            $_SESSION["mensaje"] = "Se egresó el empleado!";
        }
        else
        {
            $_SESSION["warning"] = "Hubo un error al egresar al empleado!";
        }
    }

    header("location:../empleados/consultarEmpleado.php");
?>



