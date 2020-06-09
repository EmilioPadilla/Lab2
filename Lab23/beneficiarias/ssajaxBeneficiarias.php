<?php
require_once("../model.php");

//admits lower case and upper case
$pattern=htmlspecialchars(strtolower($_GET['pattern']));
//tabla que se manda a llamar "beneficiarias"
$tabla = htmlspecialchars($_GET["Tabla"]);

$nombres = obtenerBeneficiarias("beneficiarias", "nombreCompleto");
$ids = obtenerBeneficiarias("beneficiarias", "idBeneficiaria", true);

$response = "";
$size = 0;
for($i = 0; $i < count($nombres); $i++)
{
   $pos=stripos(strtolower($nombres[$i]),$pattern);
   if(!($pos === false))
   {
     $size++;
     $nombre = $nombres[$i];
     $id = $ids[$i];

     $response .= "<option value=\"$id\">$nombre</option>"; 
   }
}
if($size > 0)
  echo "<select class=' form-control mx-auto' id=\"list\" size=$size onclick=\"selectValue('$tabla')\">$response</select>";
?>