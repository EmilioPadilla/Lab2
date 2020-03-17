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



 ?>
