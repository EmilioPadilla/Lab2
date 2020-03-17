<?php

  require_once("index.php");
  function full_name($f_n, $l_n) {
    echo "<h5 class='center'>Hola ".$f_n." ".$l_n."!</h5>";
  }

  $calorias = 0;
  function calcular_IMC($kg, $cm) {
    $calorias = round($kg / pow($cm/100, 2), 1);
    echo "<h5>Tu IMC es de ".$calorias."</h5>";
    if ($calorias < 18.5) {
      echo "<p>Usted se encuentra bajo de peso</p>";
    } else if ($calorias > 18.5 && $calorias < 25) {
      echo "<p>Usted se encuentra en su peso ideal</p>";
    } else {
      echo "<p>Usted se encuentra en sobrepeso</p>";
    }
  }

 ?>
