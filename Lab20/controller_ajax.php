<?php
require_once("model.php");
$pattern = htmlspecialchars(strtolower($_GET["pattern"]));
$tabla = htmlspecialchars($_GET["tabla"]);
$words = obtener_registros("Proyectos", "Denominacion");
$ids = obtener_registros("Proyectos", "Numero");

$response = "";
$size = 0;

for($i = 0; $i < count($words); $i++)
{
  $pos = stripos(strtolower($words[$i]), $pattern);
  if(!($pos === false))
  {
    $size++;
    $word = $words[$i];
    $id = $ids[$i];

    $response .= "<option value=\"$id\">$word</option>";
  }
}

if($size > 0)
  echo "<select class=' form-control col-md-12 mx-auto' id=\"list\" size=$size onclick=\"selectValue('$tabla')\">$response</select>";
?>
