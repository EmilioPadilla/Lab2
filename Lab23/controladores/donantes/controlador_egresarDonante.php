<?php
	session_start();
	require_once("../../model.php");

	$idDonante = htmlspecialchars($_POST["idDonante"]);
	$fechaEgreso = date("Y-m-d");
	$motivo = htmlspecialchars($_POST["motivoFinDonaciones"]);
	if($motivo == "")
		$motivo = NULL; 

		if(isset($idDonante) && isset($fechaEgreso) && (isset($motivo) | $motivo == NULL))
	{
		
		if(egresar_donante($fechaEgreso, $motivo, $idDonante))
		{
			$_SESSION["mensaje"] = "Se dio de baja al donante!";
		}
		else
		{
			$_SESSION["warning"] = "Hubo un error al dar de baja al donante!";
		}
	}

	header("location:../../donantes/consultarDonantes.php");

?>