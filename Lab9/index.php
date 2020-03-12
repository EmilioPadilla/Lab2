
<?php
  include("html/_header.html");

  include("html/_questions.html");

  echo '<div class="row">';
  echo '<div class="col s6 blue lighten-4">';

  include("average.php");

  echo '<h4>1. Funcion promedio</h4>';
  echo "<p>1er promedio = ";
  echo average(array(2,2,4,4));
  echo "</p>Segundo promedio = ";
  echo average(array(2,2,4,4,4,5,7,8,2));
  echo '</div>';

  echo '<div class="col s6">';
  include("median.php");

  echo '<h4>2. Funcion mediana</h4>';
  echo "<p>Primer mediana = ";
  median(array(3,5,7,12,13,14,21,23,23,23,23,29,40,56));
  echo "</p> Segunda mediana = ";
  median(array(3, 5, 7, 12, 13, 14, 21, 23, 23, 23, 23, 29, 39, 40, 56));
  echo '</div>';


  echo '<div class="col s6">';
  // Esta funcion debe de mostrar la lista de numeros, en <li> mostrar promedio, media, arreglo ordenado de mayor a menor y menor a mayor
  echo '<h4>3. Funcion que muestra lista de numeros, promedio, mediana, arreglo ascendente y descendente.</h4>';
  include("fullStack.php");

  echo '<h5>Primer banco de datos</h5>';
  fullStack(array(1,5,6,8,2,4,6,8,3,7,3));
  echo '<h5>Segundo banco de datos</h5>';
  fullStack(array(2,4,6,8,10,1,3,5,7,9));
  echo '</div>';


  echo '<div class="col s6 blue lighten-4">';
  include("createTable.php");
  echo '<h4>4. Tabla de exponentes</h4>';
  echo '<h5>Exponentes de 1-4</h5>';
  printTable(4);

  echo '<h5>Exponentes de 1-6</h5>';
  printTable(6);
  echo '</div>';
  echo '<div class="col s8 offset-s2 center">';


  echo '<h4>5. Calculo de Indice de Masa Corporal</h4>';
  include("calories.php");

  echo '<h5>Calculo de IMC para Emilio, que pesa 88 kg y mide 190 cm</h5>';
  computeCalories(190, 88, "Emilio");

  echo '<h5>Calculo de IMC para Juan, que pesa 65 kg y mide 188 cm</h5>';
  computeCalories(188, 65, "Juan");

  echo '</div>';
  echo '</div>';

  include ("html/_footer.html");
?>
