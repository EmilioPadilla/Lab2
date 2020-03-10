
<?php
include("_header.html");
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

  echo '<h4>Funcion promedio</h4>';
  echo "<p>Este es el 1er promedio = ";
  echo average(array(2,2,4,4));
  echo ", este es el 2do promedio = ";
  echo average(array(2,2,4,4,4,5,7,8,2));

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

  echo '<h4>Funcion mediana</h4>';
  echo "<p>Esta es la 1er mediana = ";
  median(array(3,5,7,12,13,14,21,23,23,23,23,29,40,56));
  echo ", esta es la 2da mediana = ";
  median(array(3, 5, 7, 12, 13, 14, 21, 23, 23, 23, 23, 29, 39, 40, 56));

  // Esta funcion debe de mostrar la lista de numeros, en <li> mostrar promedio, media, arreglo ordenado de mayor a menor y menor a mayor
  echo '<h4>Funcion que muestra lista de numeros, promedio, mediana, arreglo ascendente y descendente.</h4>';
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

  echo '<h5>Primer banco de datos</h5>';
  fullStack(array(1,5,6,8,2,4,6,8,3,7,3));
  echo '<h5>Segundo banco de datos</h5>';
  fullStack(array(2,4,6,8,10,1,3,5,7,9));


  function printTable($limit) {
    echo '<table id="center">';
    echo '<tr><th>X</th><th>X^2</th><th>X^3</th></tr>';
    $i = 1;
    while($i <= $limit) {
      echo '<tr>';
      echo '<td>'.$i.'</td>';
      echo '<td>'.pow($i,2).'</td>';
      echo '<td>'.pow($i,3).'</td>';
      $i += 1;
      echo '</tr>';
    }
    echo '</table>';
  }
  echo '<h4> Tabla de exponentes</h4>';
  echo '<h5>Exponentes de 1-4</h5>';
  printTable(4);

  echo '<h5>Exponentes de 1-6</h5>';
  printTable(6);

  include ("_footer.html");
?>
