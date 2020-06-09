<?php
  session_start();
  require_once("model.php");

  $titulo = "Registrar un nuevo usuario";
  include("_header.html");

  $editar = 1;

  $idUsuario = $_GET["id"];
  $usuario = recuperar($idUsuario, "usuario", "id", "usuario");
  $nombre = recuperar($idUsuario, "usuario", "id", "nombre");
  $idRol = recuperar($idUsuario, "desempenia", "usuario_id", "rol_id");

  include("_forma_registroU.html");

  include("_footer.html");
?>
