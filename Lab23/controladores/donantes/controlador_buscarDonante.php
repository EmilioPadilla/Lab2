<?php
	session_start();
	require_once("../../model.php");


	if(isset($_POST["tipodeDonante"]))
		$idTipo = htmlspecialchars($_POST["tipodeDonante"]);
	else
		$idTipo = "";
	if(isset($_POST["donantes"]))
		$idDonante = htmlspecialchars($_POST["donantes"]);
	else
		$idDonante = "";	
		

	
	echo consultarDonantes($idTipo, $idDonante);
?>  