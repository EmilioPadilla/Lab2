<?php
  session_start();
  require_once("../model.php");

  $botones = [
    ["Regresar", "../usuarios/consultarCuentas.php"]
  ];

  //poner los paths de los estilos que va a tener la página
  $estilos = [
    "../css/styles.css"
  ];

  $titulo = "Cuentas Empleados";
  include("../partials/_header.html");

  $editar = 1;

  $idUsuario = $_GET["id"];
  $usuario = recuperar($idUsuario, "usuario", "id", "usuario");
  $nombre = recuperar($idUsuario, "usuario", "id", "nombre");
  $idRol = recuperar($idUsuario, "desempenia", "usuario_id", "rol_id");

  include("../usuarios/registrarCuenta.html");

  include("../partials/_footer.html");
?>