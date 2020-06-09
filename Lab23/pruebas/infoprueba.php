<?php
  require_once("../model.php");
  session_start();

	/*
		verificar que la sesión sea activa. (el timeout está en segundos)
	*/
	$time = $_SERVER['REQUEST_TIME'];
	$timeout_duration = 3000;
	if (isset($_SESSION['LAST_ACTIVITY']) &&
	($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
		echo "<script>
		alert('Tu sesión ha expirado. Por favor vuelve a iniciar sesión.');
		window.location.href='../controladores/cerrarSesion.php';
		</script>";
	}
	$_SESSION['LAST_ACTIVITY'] = $time;



  $botones = [
    ["Regresar", "../beneficiarias/verBeneficiaria.php"]
  ];


  //poner los paths de los estilos que va a tener la página
  $estilos = [
    "../css/prueba.css",
    "https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"
  ];

  $scripts = [
    "https://cdn.jsdelivr.net/momentjs/latest/moment.min.js",
    "https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js",
    "../js/prueba.js",
    "../js/birthdate.js",
    "../js/ajax.js"
  ];

  $nombreBenef = recuperar($_SESSION["benefactual"], "beneficiarias", "idBeneficiaria", "nombreCompleto");
  $nacbenef = recuperar($_SESSION["benefactual"], "beneficiarias", "idBeneficiaria", "fechaNacimiento");
  $nacbenef = (new DateTime($nacbenef))->format('d-m-Y');
  $DXBenef = recuperar($_SESSION["benefactual"], "beneficiarias", "idBeneficiaria", "diagnosticoInt");


  $titulo = "Registrar Prueba";
  include("../partials/_header.html");

  $tituloPrueba = "Informacion Beneficiaria";
  include("InfoPrueba.html");

	include("../partials/_footer.html");
 ?>
