<?php
  function fullStack($array) {
    $arrToStr = implode($array);
    $asc = rsort($array);
    $desc = sort($array);
    echo "<p> El array es $arrToStr</p>";

    echo '<li> El promedio del arreglo es = ';
    echo average($array);
    echo '<li> La mediana del arreglo es = ';
    echo median($array);
    rsort($array);
    echo "<li>El arreglo ordenado de mayor a menor es = ";
    echo implode($array);
    sort($array);
    echo "<li>El arreglo ordenado de menor a mayor es = ";
    echo implode($array);
  }
 ?>
