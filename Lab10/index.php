<?php
  require_once("macro.php");
  include("html/_header.html");
  include("html/_questions.html");
  include("html/_index.html");

  $name = $last_name = "";
	if (!(isset($_POST["first_name"]) && isset($_POST["last_name"]))){
	   die();
	} else {
    $name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
  }
  full_name($name, $last_name);

  $cm = $kg = 0;
  if (!(isset($_POST["kg"]) && isset($_POST["cm"]))){
	   die();
	} else {
    $kg = htmlspecialchars($_POST["kg"]);
    $cm = htmlspecialchars($_POST["cm"]);
  }

  calcular_IMC($kg, $cm);


  include("html/_footer.html");
 ?>
