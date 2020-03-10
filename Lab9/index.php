<?php $nombre = "Lalo";
  echo "<p>Hola $nombre</p>";
  echo '<p>Hola $nombre</p>';
  $respuesta = "Ey" ;
  echo '<p>'.$respuesta."</p>";


  function average($array) {
    $sum = 0;
    $contar = 0;
    $result = 0;
    foreach ($array as $value) {
      $sum+= $value;
      $contar++;
    }
    $result = ($sum/$contar);
    echo $result;
  }

  echo "<p>Este es el promedio</p>".average(array(2,2,4,4));

  function median($array) {
    sort($array);
    $median = 0;
    if (count($array) % 2 == 0) {
      $median = ($array[((count($array))/2) - 1] + $array[(count($array))/2])/2;
    } else {
      $median = $array[floor((count($array))/2)];
    }
    echo $median;
  }

  echo "Esta es la primera mediana";
  median(array(3,5,7,12,13,14,21,23,23,23,23,29,40,56));
  echo "Esta es la segunda mediana";
  median(array(3, 5, 7, 12, 13, 14, 21, 23, 23, 23, 23, 29, 39, 40, 56));

  // Esta funcion debe de mostrar la lista de numeros, en <li> mostrar promedio, media, arreglo ordenado de mayor a menor y menor a mayor
  function fullStack($array) {
    $arrToStr = implode($array);
    $asc = rsort($array);
    $desc = sort($array);
    echo "<p> El array es $arrToStr</p>";

    echo '<li></li>'.average($array);
    echo "<li></li>".median($array);
    rsort($array);
    echo "<li>El arreglo ordenado de mayor a menor es </li>".implode($array);
    sort($array);
    echo "<li>El arreglo ordenado de menor a mayor es </li>".implode($array);
  }

  fullStack(array(1,5,6,8,2,4,6,8,3,7,3));

  function printTable() {

  }

?>
