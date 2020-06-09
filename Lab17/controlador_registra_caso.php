<?php
require_once("model.php");
$titulo = "Registrar nuevo caso";
include("_header.html");
  session_start();
  //Revisar que solo aquellos que tengan una sesion activa puedan entrar
  if(!isset($_SESSION["nombre"])) {
    $titulo = "Favor de Iniciar Sesión";

    include("login.html");
  } else {



    $titulo = "Registra un nuevo caso";
    if (isset($_SESSION["registrar"])) {

      include("_form_caso.html");


    }


    if (!isset($_SESSION["registrar"])) {
      $titulo = "Acceso Denegado";
      $recursos = "Editar Caso de COVID";
      include("_header.html");
      include("_denied_access.html");
    }
  }
  include("_footer.html");
?>
