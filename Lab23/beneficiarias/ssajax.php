<?php
require_once("../model.php");

//admits lower case and upper case
$pattern=htmlspecialchars(strtolower($_GET['pattern']));
//tabla que se manda a llamar "beneficiarias"
$tabla = htmlspecialchars($_GET["Tabla"]);

$diagnosticos = obtenerBeneficiarias("beneficiarias", "diagnosticoInt");
$ids = obtenerBeneficiarias("beneficiarias", "idBeneficiaria", true);

$response = "";
$size = 0;
for($i = 0; $i < count($diagnosticos); $i++)
{
   $pos=stripos(strtolower($diagnosticos[$i]),$pattern);
   if(!($pos === false))
   {
     $size++;
     $diagnostico = $diagnosticos[$i];
     $id = $ids[$i];

     $response .= "<option value=\"$id\">$diagnostico</option>"; 
   }
}
if($size > 0)
  echo "<select class=' form-control mx-auto' id=\"list\" size=$size onclick=\"selectValueD('$tabla')\">$response</select>";
?>