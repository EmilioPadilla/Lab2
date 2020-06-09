<?php
require_once("model.php");
session_start();



if(!isset($_SESSION["Usuario"]))
  $_SESSION["Usuario"] = $_POST["Usuario"];
if(!isset($_SESSION["Contraseña"]))
{
  $_SESSION["Contraseña"] = hash('sha512', $_POST["Contraseña"]);
}

if($_SESSION["Contraseña"] == getQuery($_SESSION["Usuario"])){
  $user = $_SESSION["Usuario"];
  $pass = $_SESSION["Contraseña"];
  autenticar_bd($user,$pass);
  //header("location:_controller.php");


    $titulo = "Buscador";
    include("_header.html");



    if(isset($_SESSION["ver"])) {
       include("_form.html");
    }



    if(isset($_SESSION["registrar"])) {
      include("_btn_agregar.html");
    }


    if(isset($_SESSION["ver"])) {
      if (isset($_POST["lugar"])) {
          $lugar = htmlspecialchars($_POST["lugar"]);
      } else {
          $lugar = "";
      }

      if (isset($_POST["estado"])) {
          $estado = htmlspecialchars($_POST["estado"]);
      } else {
          $estado = "";
      }
      echo consultar_casos($lugar,$estado);
    }

    //Rol de registrar puede agregar casos
    if(isset($_SESSION["registrar"])) {
      include("_btn_agregar.html");
    }

    include ("_preguntas.html");

    include("_footer.html");
  

}
else
{
  header("location:controlador_cerrarSesion.php");
}






?>