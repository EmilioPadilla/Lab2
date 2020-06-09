<?php
  require_once("model.php");
  session_start();
  //Revisar que solo aquellos que tengan una sesion activa puedan entrar
  if(!isset($_SESSION["nombre"]))  {
    $titulo = "Favor de Iniciar Sesión";
    header("location:controlador_cerrarSesion.php");
  } else {
    

    $_POST["lugar"] = htmlspecialchars($_POST["lugar"]);
    $_POST["caso_id"] = htmlspecialchars($_POST["caso_id"]);

    if(isset($_POST["lugar"])) {
        if (editar_caso($_POST["caso_id"], $_POST["lugar"])) {
            $_SESSION["mensaje"] = "Se editó el caso";
        } else {
            $_SESSION["warning"] = "Ocurrió un error al editar el caso";
        }
    }

    header("location:controlador_session.php");
  }
?>
