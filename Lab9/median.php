<?php
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
 ?>
