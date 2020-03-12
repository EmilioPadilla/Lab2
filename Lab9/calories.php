<?php
  function computeCalories($altura, $peso, $nombre) {
    $altura = ($altura/100);
    $BMI = $peso / ($altura*$altura);
    echo $nombre."... Tu índice de masa corporal es= ".round($BMI,1);
    if ($BMI < 18.5) {
      echo "<p>Usted se encuentra bajo de peso</p>";
      echo '<img src="images/sad.jpg">';
    } else if ($BMI > 18.5 && $BMI < 25) {
      echo "<p>Usted se encuentra en su peso ideal</p>";
      echo '<img src="images/happy.jpg">';
    } else {
      echo "<p>Usted se encuentra en sobrepeso</p>";
      echo '<img src="images/sad.jpg">';
    }
  }
 ?>
