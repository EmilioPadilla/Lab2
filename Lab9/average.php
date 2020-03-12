<?php
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
?>
