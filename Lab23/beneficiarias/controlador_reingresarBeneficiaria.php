<?php
    session_start();
    require_once("../model.php");

	/*
		verificar que la sesión sea activa. (el timeout está en segundos)
	*/
	$time = $_SERVER['REQUEST_TIME'];
	$timeout_duration = 30;
	if (isset($_SESSION['LAST_ACTIVITY']) && 
	($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
		echo "<script>
		alert('Tu sesión ha expirado. Por favor vuelve a iniciar sesión.');
		window.location.href='../controladores/cerrarSesion.php';
		</script>";
	}
	$_SESSION['LAST_ACTIVITY'] = $time;	

    var_dump($_POST);
    $idBeneficiaria = htmlspecialchars($_POST["idBeneficiaria"]);
    $fechaReingreso = htmlspecialchars($_POST["fechaReingreso"]);
    $motivoReingreso = htmlspecialchars($_POST["motivoReingreso"]);


    if(isset($idBeneficiaria) && isset($fechaReingreso) && isset($motivoReingreso))
    {
        if(reingresarBeneficiaria($idBeneficiaria, $fechaReingreso, $motivoReingreso)){
            $_SESSION["mensaje"] = "Reingreso de beneficiaria exitoso!";
        }
        else
        {
            $_SESSION["warning"] = "Hubo un error al intentar reingresar a la beneficiaria!";
        }
    }

    header("location:consultarBeneficiaria.php");
?>