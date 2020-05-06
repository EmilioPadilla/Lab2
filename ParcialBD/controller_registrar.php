<?php
  session_start();
  require_once("model.php");



  if (isset($_GET["tipo_id"]) && isset($_GET["lugar_id"])) {
    $_GET["tipo_id"] = htmlspecialchars($_GET["tipo_id"]);
    $_GET["lugar_id"] = htmlspecialchars($_GET["lugar_id"]);

    agregar_incidente($_GET["lugar_id"], $_GET["tipo_id"]);

    $_SESSION["exito"] = "Se registró el incidente con éxito";
  } else {
    $_SESSION["warning"] = "Hubo un error al registrar el incidente";
  }


  if(isset($_SESSION["exito"])){
        echo "<div class='row'>
          <div class='col s12'>
            <div class='card-panel teal'>
              <span class='white-text'>";
                echo $_SESSION["exito"];
        echo   "</span>
            </div>
          </div>
        </div>";
  unset($_SESSION["exito"]);
}

  if(isset($_SESSION["warning"])) {
        echo "<div class='row'>
          <div class='col s12'>
            <div class='card-panel red'>
              <span class='white-text'>";
                echo $_SESSION["warning"];
        echo   "</span>
            </div>
          </div>
        </div>";
        unset($_SESSION["warning"]);
  }

  echo consultar_incidentes();
 ?>
