<<?php
    require_once("../model.php");
    session_start();
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

    $titulo = "Egresar Empleado";

    //poner los botones del sidebar como [nombreBtn, path]
    $botones = [
        ["Empleados", "#"],
        ["Beneficiarias", "#"],
        ["Donantes", "../donantes/consultarDonantes.php"]
    ];

    //poner los paths de los estilos que va a tener la página
    $estilos = [
        "../css/map.css",
        "../css/consultarEmpleado.css",
        "../css/tablaConScroll.css"
    ];



    include("../partials/_header.html");


    include("consultarEmpleado.html");

    if (isset($_POST["Puesto"])) {
      $puesto = htmlspecialchars($_POST["Puesto"]);
    } else {
        $puesto = "";
    }

    include("modalEmpleados.html");
    //poner los scripts de js
    $scripts = [
            "../js/ajaxBuscarEmpleado.js"
    ];


    include("../partials/_footer.html")


 ?>
