<?php
  session_start();
  $_SESSION["login"] = htmlspecialchars($_POST["usuario"]);
  $_SESSION["password"] = htmlspecialchars($_POST["pwd"]);

  if (!(isset($_POST["usuario"]) && isset($_POST["pwd"]))){
    die();
  } else {
    if ($_SESSION["login"] == "admin" && $_SESSION["password"] == "admin") {
      
      include("registrarPrueba.php");
    } else {
      include("html/pwd_incorrecto.html");
    }
  }
 ?>
