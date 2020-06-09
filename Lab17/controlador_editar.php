<?php
//Checar que las cookies no afecten el inicio de sesion

  session_start();
  //Revisar que solo aquellos que tengan una sesion activa puedan entrar
  if(!isset($_SESSION["nombre"]))  {
    $titulo = "Favor de Iniciar Sesión";
    include("_header.html");
    include("login.html");
  } else {
    if (isset($_SESSION["registrar"])) {
      require_once("model.php");

      $caso_id = htmlspecialchars($_GET["caso_id"]);

      $titulo = "Editar el caso ".$caso_id;
      include("_header.html");

      $lugar_id = recuperar_lugar($caso_id);
      $editar = 1;
      include("_form_caso.html");

      include("_footer.html");
    }


    if (!isset($_SESSION["registrar"])) {
      $titulo = "Acceso Denegado";
      $recursos = "Editar Caso de COVID";
      include("_header.html");
      include("_denied_access.html");
    }
  }
?>
