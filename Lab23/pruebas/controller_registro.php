<?php
  require_once("../model.php");
  session_start();

  $seccionActual = htmlspecialchars($_GET["seccion"]);
  $btnprueba = htmlspecialchars($_GET["btnprueba"]);
  $contadorAct = htmlspecialchars($_GET["contadorAct"]);
  $numAct = recuperar_id_actividad ($_SESSION["pruebaactual"], $_SESSION["benefactual"], $seccionActual);
  // $fechaPruebaActual = htmlspecialchars($_GET["fechaAct"]);


  //Insertar calificacion de tabla
  function recuperar_calificacion ($idprueba, $idbenef, $idseccion ) {

  }

  // Ciclo para hacer n updates a la BD de valorar_actividad
  for ($i = $numAct; $i <= ($numAct + $contadorAct); $i++) {
    actualizar_actividad($_SESSION["pruebaactual"], 1, $seccionActual, $i, 2);
  }
  actualizar_seccion($_SESSION["pruebaactual"], $_SESSION["benefactual"], $seccionActual, 1);



  if (isset($seccionActual)) {
    if ($btnprueba == "mas")
    $seccionActual++;
    else
    $seccionActual--;
  } else {
    calcular_seccion($_SESSION["benefactual"]);
  }

  // $calificacion = recuperar_calif_act(1, $_SESSION["benefactual"], $seccionActual, );
  echo crear_tabla_prueba($seccionActual, $_SESSION["pruebaactual"]);
 ?>
