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

  //Se calcula la fecha a asignar a nueva prueba
  date_default_timezone_set('America/Mexico_City');
  $date = date('Y/m/d H:i:s', time());

  //Se recupera el ultimo numero de $pruebaActual
  $prueba = recuperar_ultima_prueba();
  if ($prueba) {
    $_SESSION["pruebaactual"] = $prueba[0] + 1;
  } else {
    $_SESSION["pruebaactual"] = 1;
  }

  //Se agrega la prueba en la BD
  insert_act_sec(1, 7, $_SESSION["pruebaactual"], 1, $date);
  insert_act_sec(8, 14, $_SESSION["pruebaactual"], 2, $date);
  insert_act_sec(15, 21, $_SESSION["pruebaactual"], 3, $date);
  insert_act_sec(22, 25, $_SESSION["pruebaactual"], 4, $date);
  insert_act_sec(26, 32, $_SESSION["pruebaactual"], 5, $date);
  insert_act_sec(33, 34, $_SESSION["pruebaactual"], 6, $date);
  insert_act_sec(35, 37, $_SESSION["pruebaactual"], 7, $date);
  insert_act_sec(38, 40, $_SESSION["pruebaactual"], 8, $date);
  insert_act_sec(41, 46, $_SESSION["pruebaactual"], 9, $date);
  insert_act_sec(47, 49, $_SESSION["pruebaactual"], 10, $date);
  insert_act_sec(50, 51, $_SESSION["pruebaactual"], 11, $date);
  insert_act_sec(52, 54, $_SESSION["pruebaactual"], 12, $date);
  insert_act_sec(55, 61, $_SESSION["pruebaactual"], 13, $date);
  insert_act_sec(62, 64, $_SESSION["pruebaactual"], 14, $date);
  insert_act_sec(65, 77, $_SESSION["pruebaactual"], 15, $date);
  insert_act_sec(78, 79, $_SESSION["pruebaactual"], 16, $date);

  insertar_actividad($_SESSION["pruebaactual"], $_SESSION["benefactual"], 17, 80, 0, $date);
  insertar_seccion($_SESSION["pruebaactual"], $_SESSION["benefactual"], 17, 0, $_SESSION["usuario"], $date);

  insert_act_sec(81, 82, $_SESSION["pruebaactual"], 18, $date);
  insert_act_sec(83, 92, $_SESSION["pruebaactual"], 19, $date);
  insert_act_sec(93, 95, $_SESSION["pruebaactual"], 20, $date);

  insertar_actividad($_SESSION["pruebaactual"], $_SESSION["benefactual"], 21, 96, 0, $date);
  insertar_seccion($_SESSION["pruebaactual"], $_SESSION["benefactual"], 21, 0, $_SESSION["usuario"], $date);

  insert_act_sec(97, 102, $_SESSION["pruebaactual"], 22, $date);
  insert_act_sec(103, 105, $_SESSION["pruebaactual"], 23, $date);
  insert_act_sec(106, 107, $_SESSION["pruebaactual"], 24, $date);
  insert_act_sec(108, 109, $_SESSION["pruebaactual"], 25, $date);
  insert_act_sec(110, 115, $_SESSION["pruebaactual"], 26, $date);
  insert_act_sec(116, 123, $_SESSION["pruebaactual"], 27, $date);
  insert_act_sec(124, 130, $_SESSION["pruebaactual"], 28, $date);
  insert_act_sec(131, 135, $_SESSION["pruebaactual"], 29, $date);
  insert_act_sec(136, 158, $_SESSION["pruebaactual"], 30, $date);
  insert_act_sec(159, 170, $_SESSION["pruebaactual"], 31, $date);
  insert_act_sec(171, 172, $_SESSION["pruebaactual"], 32, $date);
  insert_act_sec(173, 177, $_SESSION["pruebaactual"], 33, $date);
  insert_act_sec(178, 192, $_SESSION["pruebaactual"], 34, $date);
  insert_act_sec(193, 201, $_SESSION["pruebaactual"], 35, $date);
  insert_act_sec(202, 209, $_SESSION["pruebaactual"], 36, $date);
  insert_act_sec(210, 215, $_SESSION["pruebaactual"], 37, $date);
  insert_act_sec(216, 222, $_SESSION["pruebaactual"], 38, $date);
  insert_act_sec(223, 227, $_SESSION["pruebaactual"], 39, $date);
  insert_act_sec(228, 233, $_SESSION["pruebaactual"], 40, $date);
  insert_act_sec(234, 239, $_SESSION["pruebaactual"], 41, $date);
  insert_act_sec(240, 247, $_SESSION["pruebaactual"], 42, $date);
  insert_act_sec(248, 270, $_SESSION["pruebaactual"], 43, $date);
  insert_act_sec(271, 273, $_SESSION["pruebaactual"], 44, $date);
  insert_act_sec(274, 279, $_SESSION["pruebaactual"], 45, $date);
  insert_act_sec(280, 296, $_SESSION["pruebaactual"], 46, $date);
  insert_act_sec(297, 307, $_SESSION["pruebaactual"], 47, $date);






  header("location:registrarPrueba.php?fechaPrueba=$fechaPrueba");
 ?>
