<?php
  session_start();
  require_once("model.php");
  $titulo = "Busqueda y registro de incidentes";

  include("html/_header.html");
  include("html/_registrar_incidente.html");

  echo "<div class='col s8' id='tablaIncidentes'>";
  echo consultar_incidentes();;
  echo "</div> </div>";
  include("html/_footer.html");



 ?>
