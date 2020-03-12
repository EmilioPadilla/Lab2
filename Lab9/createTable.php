<?php
function printTable($limit) {
  echo '<table>';
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
 ?>
