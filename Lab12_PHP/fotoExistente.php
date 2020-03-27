<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Registrar Prueba</title>

  <!-- Vendor CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link href="css/registrar-prueba.css" rel="stylesheet">
  <link href="css/Lab12.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
  <!-- Container wrapper -->
    <div class="d-flex bodycontainer" id="wrapper">

      <!-- Sidebar -->
      <div class="border-right d-none d-md-block " id="sidebar-wrapper">
        <div class="sidebar-heading"><a href="../usuarios/principalAdministrador.html"><img src="images/CMG-logo" class="logo-CMG rounded" alt="logo CMG"></a></div>
        <div class="list-group list-group-flush">
          <!-- <a href="InfoPrueba.html" class="list-group-item list-group-item-action">Regresar</a> -->
        </div>
      </div>
      <!-- Sidebar ends -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
       <!-- Navbar  -->
       <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn-blanco btn " id="menu-toggle">
          Registrar Prueba
        </button>

        <button class="btn-blanco navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle ml-auto" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="https://cdn.mos.cms.futurecdn.net/qcXNfw7aYK3FwqxW3zepvS.jpg" class="imgprofile rounded-circle" alt="imgprofile">
                Administradora
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="controller_salir.php">Cerrar Sesión</a>
                <!-- <a class="dropdown-item" href="../usuarios/modificarCuentaPersonal.html">Configuracion de cuenta</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../usuarios/consultarCuentas.html">Configuracion de empleados</a>
              </div> -->
            </li>
          </ul>
        </div>
      </nav>
      <!-- Navbar ends -->

        <!-- Fluid Container -->
        <div class="fluid-container content">
          <div class="d-flex flex-row justify-content-center">
            <h1 class="">Registrar prueba</h1>
          </div>

          <div class="d-flex flex-row justify-content-end">
            <div class="p-2">
              <button type="button" class="btn btn-outline-dark" data-toggle="popover" title="¿Qué significa esta barra?" data-content="El progreso dentro de la prueba. Rosa para completada, azul para en progreso y rosa claro para sin empezar"><i class="material-icons">info</i></button></a>
            </div>

          </div>

              <div class="progress">
                <div class="progress-bar progress-bar pb-completed progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 14.2%;">
                  <a href="#"> Info</a>
                </div>
                <div class="progress-bar progress-bar pb-completed progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:14.2%;">
                    <a href="#"> área 1</a>
                </div>
                <div class="progress-bar progress-bar pb-completed  progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 14.2%;">
                    <a href="#"> área 2</a>
                </div>
                <div class="progress-bar progress-bar pb-progress progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 14.2%;">
                  <a href="#"> area 3</a>
                </div>
                <div class="progress-bar progress-bar pb-undone progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:14.2%;">
                    <a href="#"> habilidad 1</a>
                </div>
                <div class="progress-bar progress-bar  pb-undone progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 14.2%;">
                    <a href="#"> habilidad 2</a>
                </div>
                <div class="progress-bar progress-bar pb-undone progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:14.2%;">
                    <a href="#"> habilidad 3</a>
                </div>
              <!-- Progress Bar Ends -->
              </div>

              <br>

              <!-- CARD DE BENEFICIARIA -->
              <div class="row d-flex justify-content-center">
                <div class="card mb-3 border-top-0 border-left-0 col-xs-4" style="max-width: 600px;">
                  <div class="row no-gutters">
                    <div class="col-md-4">
                      <img src="images/emrata.jpg" class="card-img rounded-circle foto-prueba" alt="Foto beneficiaria">
                    </div>
                    <div class="col-8">
                      <div class="card-body">
                        <h5 class="card-title">Antonia Hernandez Caballero</h5>
                        <p class="card-text">Diagnostico: Discapacidad intelectual leve
                        <br> Edad: 16 años</p>
                        <form class="" action="upload.php" method="post" enctype="multipart/form-data">
                          <p class="card-text"><small class="text-muted">Cambiar foto</small></p>
                          <input type="file" name="fileToUpload" id="fileToUpload">
                          <input type="submit" value="cambiar foto" name="submit">
                        </form>
                        <p class="pwdwrong">Esta foto ya existe</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br>

          <!-- TABLA DE PREGUNTAS DE PRUEBA -->
          <div class="dflex flex-row">
            <table class="table table-borderless">
              <thead>
                <tr>
                  <td scope="col">#</td>
                  <th scope="col">Académicas Funcionales y de comunicacion</th>
                  <th scope="col"><i class="material-icons fails">close</i></th>
                  <th scope="col"><i class="material-icons tries">hdr_weak</i></th>
                  <th scope="col"><i class="material-icons succeed">check</i></th>
                  <th scope="col"></th>
                  <th scope="col">Vista previa</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td scope="row">1</td>
                  <td>Discrimina sonidos del medio ambiente.</td>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioFails" id="inlineRadio1" value="option1">
                      <label class="form-check-label" for="inlineRadio1"></label>
                    </div>
                  </td>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioFails" id="inlineRadio1" value="option1">
                      <label class="form-check-label" for="inlineRadio1"></label>
                    </div>
                  </td>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioFails" id="inlineRadio1" value="option1">
                      <label class="form-check-label" for="inlineRadio1"></label>
                    </div>
                  </td>
                  <td>
                    <i class="material-icons" onclick="comentar_prueba()">comment</i>
                  </td>
                </tr>
                <tr>
                  <td scope="row">2</td>
                  <td>Sigue órdenes de un comando</td>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioTries" id="inlineRadio1" value="option1">
                      <label class="form-check-label" for="inlineRadio1"></label>
                    </div>
                  </td>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioTries" id="inlineRadio1" value="option1">
                      <label class="form-check-label" for="inlineRadio1"></label>
                    </div>
                  </td>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioTries" id="inlineRadio1" value="option1">
                      <label class="form-check-label" for="inlineRadio1"></label>
                    </div>
                  </td>
                  <td>
                    <i class="material-icons" onclick="comentar_prueba()">comment</i>
                  </td>
                </tr>
                <tr>

                  <td scope="row">3</td>
                  <td>Sigue órdenes de dos comandos</td>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioSucceed" id="inlineRadio1" value="option1">
                      <label class="form-check-label" for="inlineRadio1"></label>
                    </div>
                  </td>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioSucceed" id="inlineRadio1" value="option1">
                      <label class="form-check-label" for="inlineRadio1"></label>
                    </div>
                  </td>
                  <td>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioSucceed" id="inlineRadio1" value="option1">
                      <label class="form-check-label" for="inlineRadio1"></label>
                    </div>
                  </td>
                  <td>
                    <i class="material-icons" onclick="comentar_prueba()">comment</i>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="dflex flex-row" id="commentBox">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <option selected># de Act</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>

                </div>
              </div>
              <textarea class="form-control" aria-label="With textarea"></textarea>
            </div>
          </div>
<br>
          <div class="d-flex justify-content-end">
            <a href="verPrueba.html"><button type="button" class="btn btn-outline-success">Guardar</button></a>
            <button type="button" class="btn btn-outline-primary border btn-next">Siguiente</button>

          </div>
          <div class="d-flex justify-content-end">
            <a href="planSeguimiento.html">
              <button type="button" class="btn btn-outline-primary btn-plan">Generar plan de seguimiento</button>
            </a>

          </div>
        <!-- Fluid Container ends -->
        </div>

      <!-- Page-content-wrapper ends -->
      </div>

  <!-- Container ends -->
  </div>


  <!-- Bootstrap core JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/prueba.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    $(function () {
      $('[data-toggle="popover"]').popover();
    })
  </script>

</body>

</html>
