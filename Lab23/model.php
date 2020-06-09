<?php

//------------------------------------------------------------
 //        --- FUNCIONES GENERALES---
//-------------------------------------------------------------

	//conectarse a la bd
	function conectar_bd()
	{
		$conexion_bd = mysqli_connect("localhost", "root", "", "CMG");
		if($conexion_bd == NULL)
			die("La base de datos CMG está en mantenimiento, vuelve a intentarlo más tarde...");

		return $conexion_bd;
	}

	//desconectarse de la bd
	function desconectar_bd($conexion_bd)
	{
		mysqli_close($conexion_bd);
	}

	//función para crear los botones del sidebar de manera dinámica dependiendo de la página en la que esté el usuario.
	//$btn[0] es el nombre del botón y $btn[1] el path a donde lleva el botón
	function botones_sidebar($botones)
	{
		foreach($botones as $btn)
		{
			echo "<a href='".$btn[1]."' class='list-group-item list-group-item-action'>".$btn[0]."</a>";
		}
	}

	//función para poner estilos dependiendo del path del css pasado
	function agregar_estilos($estilos)
	{
		foreach($estilos as $style)
		{
			echo "<link href='".$style."' rel='stylesheet'>";
		}
	}

	//función para poner scripts dependiendo del path del js pasado
	function agregar_js($scripts)
	{
		foreach($scripts as $js)
		{
			echo "<script src='".$js."'></script>";
		}
	}

	//Consultar un campo de una tabla a partir de su llave
	 //$llave es el valor de la llave del registro que se quiere recuperar
	 //$tabla es el nombre de la tabla pasado como string
	 //$nombreLlave es el nombre de la llave de la tabla (como aparece en la bd) pasado como string
	 //$campo es el nombre del campo que se quiere recuperar (como aparece en la bd) pasado como string
	 function recuperar($llave, $tabla, $nombreLlave, $campo) {

		$conexion_bd = conectar_bd();


		$consulta = "SELECT $campo FROM $tabla WHERE $nombreLlave ='$llave'";
		$resultados = $conexion_bd->query($consulta);
		while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
			desconectar_bd($conexion_bd);
			return $row["$campo"];
		}

		desconectar_bd($conexion_bd);
		return 0;
	  }

	//funcion para regresar el url de un string
	function urlify($string){
		$string = strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
		$string = str_replace(" ", "%20", $string);
		$string = str_replace(",", "%2C", $string);
		$string = str_replace("#", "%23", $string);
		return $string;
	 }

//crear select dinámico
	function crear_select($llave, $descripcion, $tabla, $required, $seleccion = 0, $label = "", $busqueda = false)
	{

		$conexion_bd = conectar_bd();

		//poner el label recibido como parametro o por default el nombre de la tabla
		if($label === "")
			$resultado = "<label  for='".$tabla."'>".$tabla."</label>";
		else
			$resultado = "<label  for='".$tabla."'>".$label."</label>";

		$resultado .= "<div class='form-group'><select class='form-control mx-auto' id='".$tabla."' name='".$tabla."' ";
		if($required)
		{
			$resultado .= "required";
		}
		$resultado .= "><option value='' ";
		//si el select es para una busqueda no lleva el disabled para poder buscar sin filtro
		if(!$busqueda)
			$resultado .= "disabled";
		$resultado .= " selected>Selecciona una opción</option>";

		$consulta = "SELECT $llave, $descripcion FROM $tabla";
		$resultados = $conexion_bd->query($consulta);
		while($row = mysqli_fetch_array($resultados, MYSQLI_BOTH))
		{
			$resultado .= "<option value='".$row["$llave"]."' ";
			if($seleccion === $row["$llave"])
			{
				$resultado .= "selected";
			}
			$resultado .= ">".$row["$descripcion"]."</option>";
		}

		desconectar_bd($conexion_bd);
		$resultado .= "</select><div class='invalid-feedback'>Escoge una opción válida</div></div><br/>";
		return $resultado;
	}


	 //funcion para calcular la edad
    function calculaEdad($fNacimiento){
        $nacimiento = new DateTime($fNacimiento);
        $hoy   = new DateTime('today');
        return $nacimiento->diff($hoy)->y;
	}

	//obtener todas los registros de un campo de una tabla
    function obtener_registros($tabla, $campo, $id = false)
    {
        $conexion_bd = conectar_bd();
        $array = "";
        $consulta = 'SELECT '.$campo.' FROM '.$tabla;
        if($id){
            $consulta .= ' ORDER BY '.$campo;
        }
        $resultados = $conexion_bd->query($consulta);
        while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)){
            $array .= $row["$campo"].",";
        }
        mysqli_free_result($resultados);
        desconectar_bd($conexion_bd);
        $array = explode(",", $array);
        return $array;
    }


//------------------------------------------------------------
 //        --- FUNCIONES PARA MEDICOS---
//-------------------------------------------------------------
	//agregar un médico a la bd
	function agregar_medico($especialidad, $nombre, $apellido, $direccion, $telefono, $celular, $correo)
	{
		$conexion_bd = conectar_bd();

		//preparar consulta
		$dml_insertar = 'INSERT INTO medico (idEspecialidad, nombre, apellido, direccion, telefono, celular, correo) VALUES (?, ?, ?, ?, ?, ?, ?)';
		if(!($statement = $conexion_bd->prepare($dml_insertar)))
		{
			die("Error: (".$conexion_bd->errno.") ".$conexion_bd->error);
			return 0;
		}


		//unir parámetros de la función con la consulta
		//el primer arg es el formato de cada parámetro
		if(!$statement->bind_param("issssss", $especialidad, $nombre, $apellido, $direccion, $telefono, $celular, $correo))
		{
			die("Error en vinculación: (".$statement->errno.") ".$statement->error);
			return 0;
		}

		//Ejecutar inserción
		if(!$statement->execute())
		{
			die("Error en ejecución: (".$statement->errno.") ".$statement->error);
			return 0;
		}

		desconectar_bd($conexion_bd);
		return 1;
	}

	//modificar a un medico
	function modificar_medico($idMedico, $especialidad, $nombre, $apellido, $direccion, $telefono, $celular, $correo)
	{
		$conexion_bd = conectar_bd();

		//Prepara la consulta
		$dml_editar = 'UPDATE medico SET idEspecialidad=(?), nombre=(?), apellido=(?), direccion=(?), telefono=(?), celular=(?), correo=(?) WHERE idMedico=(?)';
		if ( !($statement = $conexion_bd->prepare($dml_editar)) ) {
			die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
			return 0;
		}

		//Unir los parámetros de la función con los parámetros de la consulta
		//El primer argumento de bind_param es el formato de cada parámetro
		if (!$statement->bind_param("issssssi", $especialidad, $nombre, $apellido, $direccion, $telefono, $celular, $correo, $idMedico)) {
			die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
			return 0;
		}

		//Executar la consulta
		if (!$statement->execute()) {
		  die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
			return 0;
		}

		desconectar_bd($conexion_bd);
		  return 1;
	}

	//Eliminar a un médico
	function eliminar_medico($idMedico, $idEspecialidad)
	{
		$conexion_bd = conectar_bd();

		//Prepara la consulta
		$dml_eliminar = 'DELETE FROM medico WHERE idMedico=(?) AND idEspecialidad=(?)';
		if ( !($statement = $conexion_bd->prepare($dml_eliminar)) ) {
			die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
			return 0;
		}

		//Unir los parámetros de la función con los parámetros de la consulta
		//El primer argumento de bind_param es el formato de cada parámetro
		if (!$statement->bind_param("ii", $idMedico, $idEspecialidad)) {
			die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
			return 0;
		}

		//Executar la consulta
		if (!$statement->execute()) {
		  die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
			return 0;
		}

		desconectar_bd($conexion_bd);
		return 1;
	}


	//crear carrusel de médicos con sus modals
	function carruselMedico()
	{
		$conexion_bd = conectar_bd();

		$resultado = "<hr/><footer><div class='container-fluid text-center'><h2>Directorio Médico</h2>";
		if($_SESSION["usuario"] === "Administradora")
			$resultado .= "<h5>Registrar Médico<a href='../Medicos/registrarMedico.php'><span class='material-icons'>add_circle_outline</span></a></h5>";
		$resultado .= "<div id='carruselMedicos' class='carousel slide' data-interval='10000' data-ride='carousel'><div class='carousel-inner' align='center'>";


		$consulta = 'SELECT M.idMedico as idMedico, E.nombre as especialidad, M.nombre as nombre, M.apellido as apellido, M.direccion as dir, M.telefono as tel, M.celular as cel, M.correo as correo ';
		$consulta .= ' FROM medico as M, especialidad as E ';
		$consulta .= ' WHERE M.idEspecialidad = E.idEspecialidad ';


		$resultados = $conexion_bd->query($consulta);
		$contador = 1;
		while($row = mysqli_fetch_array($resultados, MYSQLI_BOTH))
		{
			$resultado .= "<div class='carousel-item ";
			if($contador == 1)
				$resultado .= "active";
			$resultado .= "'><div  class='card bg-primary' style='width: 50%;'><div class='card-body'>";

			$resultado .= "<h3 class='card-title text-white'>Dr(a). ".$row['apellido']."</h3>";
			$resultado .= "<h6 class='card-subtitle mb-2 text-white'>".$row['especialidad']."</h6>";
			$resultado .= "<a data-toggle='modal'  href='#modal".$row['idMedico']."' class='card-link text-primary'>Detalles</a>";

			$resultado .= "</div></div></div>";

			$direccion = urlify($row['dir']);
			include("Medicos/modalMedicos.html");
			$contador++;
		}

		mysqli_free_result($resultados);


		desconectar_bd($conexion_bd);

		$resultado .= "<a class='carousel-control-prev control' href='#carruselMedicos' role='button' data-slide='prev'>";
		$resultado .= "<span class='carousel-control-prev-icon bg-dark' aria-hidden='true'></span><span class='sr-only'>Previous</span></a>";
		$resultado .= "<a class='carousel-control-next control' href='#carruselMedicos' role='button' data-slide='next'>";
		$resultado .= "<span class='carousel-control-next-icon bg-dark' aria-hidden='true'></span><span class='sr-only'>Next</span></a>";
		$resultado .= "</div></div></div></footer>";

		return $resultado;
	}



//------------------------------------------------------------
 //        --- FUNCIONES PARA DONANTES---
//-------------------------------------------------------------
	//crear tabla de donantes
	function consultarDonantes($idTipo="", $idDonante="")
	{
		$conexion_bd = conectar_bd();

		$resultado = "<table class='table table-hover table-striped table-responsive-md btn-table'><thead><tr><th>Nombre</th><th>Tipo</th><th colspan='3'>Opciones</th></tr></thead><tbody>";

		$consulta = 'SELECT D.nombreDonante as nombre, T.nombre as tipo, D.idDonante as idDonante';
		$consulta .= ' FROM donantes as D, tipodeDonante as T';
		$consulta .= ' WHERE D.idTipo = T.idTipo AND D.fechaFinDonaciones IS NULL';

		if($idTipo != "")
			$consulta .= ' AND D.idTipo = '.$idTipo;
		if($idDonante != "")
			$consulta .= ' AND D.idDonante = '.$idDonante;

		$resultados = $conexion_bd->query($consulta);
		while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH))
		{
			$resultado .= "<tr>";

			$resultado .= "<td>".$row['nombre']."</td>";
			$resultado .= "<td>".$row['tipo']."</td>";
			//botones
			$resultado .= "<td>";
			$resultado .= "<a href='verDetalleDonante.php?id=".$row['idDonante']."' class='btn btn-outline-success'>VER MAS</a>";
			//si tiene permisos de editar y eliminar que salgan los botones
			if($_SESSION["usuario"] === "Administradora")
			{
				$resultado .= "<a href='modificarDonante.php?id=".$row['idDonante']."' class='btn btn-outline-secondary'><i class='material-icons'>settings</i></a>";
				$resultado .= "<a data-toggle='modal'  href='#modal".$row['idDonante']."' class='btn btn-outline-danger'>Dar de Baja</a>";
			}
			$resultado .= "</td>";

      $resultado .= "</tr>";

      include("donantes/modalDarDeBajaDonante.html");
		}

		mysqli_free_result($resultados);
		desconectar_bd($conexion_bd);

		$resultado .= "</tbody></table>";

		return $resultado;
	}

	//agregar un donante a la bd
	function agregar_donante($idTipo, $fechaRegistro, $contactoInterno, $nombreDonante, $correoParticular, $telefonoParticular, $extensionParticular,
							$celularParticular, $fechaNacParticular, $razonSocial, $RFCEntidad, $direccionEntidad, $cpEntidad)
	{
		$conexion_bd = conectar_bd();

		//preparar consulta
		$dml_insertar = 'INSERT INTO donantes (idTipo, fechaRegistro, contactoInterno, nombreDonante, correoParticular, telefonoParticular, extensionParticular, ';
		$dml_insertar .= 'celularParticular, fechaNacParticular, razonSocial, RFCEntidad, direccionEntidad, cpEntidad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		if(!($statement = $conexion_bd->prepare($dml_insertar)))
		{
			die("Error: (".$conexion_bd->errno.") ".$conexion_bd->error);
			return 0;
		}


		//unir parámetros de la función con la consulta
		//el primer arg es el formato de cada parámetro
		if(!$statement->bind_param("isssssisssssi", $idTipo, $fechaRegistro, $contactoInterno, $nombreDonante, $correoParticular, $telefonoParticular, $extensionParticular,
		$celularParticular, $fechaNacParticular, $razonSocial, $RFCEntidad, $direccionEntidad, $cpEntidad))
		{
			die("Error en vinculación: (".$statement->errno.") ".$statement->error);
			return 0;
		}

		//Ejecutar inserción
		if(!$statement->execute())
		{
			die("Error en ejecución: (".$statement->errno.") ".$statement->error);
			return 0;
		}

		desconectar_bd($conexion_bd);
		return 1;
	}

	//modificar a un donante
	function modificar_donante($idDonante, $idTipo, $contactoInterno, $nombreDonante, $correoParticular, $telefonoParticular, $extensionParticular,
	$celularParticular, $fechaNacParticular, $razonSocial, $RFCEntidad, $direccionEntidad, $cpEntidad)
	{
		$conexion_bd = conectar_bd();

		//Prepara la consulta
		$dml_editar = 'UPDATE donantes SET idTipo=(?), contactoInterno=(?), nombreDonante=(?), correoParticular=(?), telefonoParticular=(?), extensionParticular=(?), ';
		$dml_editar .= ' celularParticular=(?), fechaNacParticular=(?), razonSocial=(?), RFCEntidad=(?), direccionEntidad=(?), cpEntidad=(?)';
		$dml_editar .= ' WHERE idDonante=(?)';
		if ( !($statement = $conexion_bd->prepare($dml_editar)) ) {
			die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
			return 0;
		}

		//Unir los parámetros de la función con los parámetros de la consulta
		//El primer argumento de bind_param es el formato de cada parámetro
		if (!$statement->bind_param("issssisssssii", $idTipo, $contactoInterno, $nombreDonante, $correoParticular, $telefonoParticular, $extensionParticular,
		$celularParticular, $fechaNacParticular, $razonSocial, $RFCEntidad, $direccionEntidad, $cpEntidad, $idDonante)) {
			die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
			return 0;
		}

		//Executar la consulta
		if (!$statement->execute()) {
		  die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
			return 0;
		}

		desconectar_bd($conexion_bd);
		  return 1;
  }

  //dar de baja a un donante
	function egresar_donante($fechaEgreso, $motivo, $idDonante)
	{
		$conexion_bd = conectar_bd();

		//Prepara la consulta
    $dml_editar = 'UPDATE donantes SET fechaFinDonaciones=(?), motivoFinDonaciones=(?) WHERE idDonante=(?)';

		if ( !($statement = $conexion_bd->prepare($dml_editar)) ) {
			die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
			return 0;
		}

		//Unir los parámetros de la función con los parámetros de la consulta
		//El primer argumento de bind_param es el formato de cada parámetro
		if (!$statement->bind_param("ssi", $fechaEgreso, $motivo, $idDonante)) {
			die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
			return 0;
		}

		//Executar la consulta
		if (!$statement->execute()) {
		  die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
			return 0;
		}

		desconectar_bd($conexion_bd);
		  return 1;
	}
//---------------------------------------------------------------
//-----------------------------EMPLEADOS-------------------------
//---------------------------------------------------------------

	 //Consulta los empleados
   function consultar_empleados($puesto="",$empleado="") {
     $conexion_bd = conectar_bd();

    $resultado =  "<div class=\"row\"><div class=\"miTabla table-wrapper-scroll-y my-custom-scrollbar mx-auto text-center\"><table class='table table-hover table-striped table-responsive-md btn-table'><thead><tr><th scope=\"col\">Nombre</th><th scope=\"col\">Puesto</th><th scope=\"col\">Celular</th><th scope=\"col\">Acciones</th></tr></thead>";

    $consulta = 'Select E.idEmpleado as id, E.Nombre as nombre, E.estado as estado, P.nombre as puesto, E.celular as celular From empleado as E, puesto as P WHERE E.idPuesto = P.idPuesto ';
    //$consulta .= 'E.estado = "activo"';
    if ($empleado != "") {
        $consulta .= ' AND E.idEmpleado = '.$empleado;
    }

    if ($puesto != "") {
        $consulta .= " AND E.idPuesto = ".$puesto;
    }

    $consulta .= ' ORDER BY E.idEmpleado ASC ';

    $resultados = $conexion_bd->query($consulta);
     while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
         $resultado .= "<tr>";
         $resultado .= '<td>'.$row["nombre"].'</a></td>'; //Se puede usar el índice de la consulta
         $resultado .= "<td>".$row['puesto']."</td>";
         $resultado .= "<td><a href=\"tel:+52".$row['celular']."\">".$row['celular']."</td>";
         //botones
         $resultado .= "<td>";
		 $resultado .= "<a href=\"verEmpleado.php?id=".$row['id']."\" class=\"btn btn-outline-success\">VER MAS</a>";
		 //si tiene permisos de editar y eliminar que salgan los botones
		 if($_SESSION["usuario"] === "Administradora"){
			$resultado .= "<a href='' class='btn btn-outline-secondary'><i class='material-icons'>settings</i></a>";
            if($row["estado"]=='activo'){

                $resultado .= '<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal'.$row['id'].'">
                    Egresar</button>';
                //Crear el modal
                 $resultado .= '<div class="modal fade" id="modal'.$row['id'].'"> tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Dar de Baja a '.$row["nombre"].'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <h5>DATOS DE EGRESO</h5>
                                        <div class="alert alert-danger" role="alert">
                                          <h6 class="alert-heading">¿Estás seguro de que deseas esgresar a <strong>'.$row['nombre'].'</strong> con puesto <strong>"'.$row['puesto'].'</strong>"?</h6>
                                        </div>
                                        <form action="../controladores/controlador_EgresarEmpleado.php" method="POST">
                                          <div class="form-group">
                                            <i class="far fa-calendar-alt"></i>
                                                <label for="fechaEgreso">Ultimo día trabajado:</label>
                                                <input type="date" class="form-control" placeholder="" name="fechaEgreso'.$row['id'].'" required>
                                              </div>
                                              <div lass="form-group">
                                              <label for="motivoEgreso">Motivo de egreso:</label>
                                              <textarea class="form-control" name="motivoEgreso'.$row['id'].'" rows="5" required></textarea>
                                            </div>
                                            <div class="form-group">
                                              <i class="fas fa-file-upload"></i>
                                              <label for="finiquito">Carga de finiquito firmado:</label>
                                              <input type="file" class="form-control-file" name="finiquito'.$row['id'].'" aria-describedby="fileHelp">
                                            </div>
                                            <div class="form-group">
                                              <i class="fas fa-file-upload"></i>
                                              <label for="renuncia">Carga de carta de renuncia:</label>
                                              <input type="file" class="form-control-file" name="renuncia'.$row['id'].'" aria-describedby="fileHelp">
                                            </div>
                                            <input type="hidden" name="id" value="'.$row['id'].'"></input>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                      <button type="submit" class="btn btn-danger" role="button">Dar de Baja</a>
                                    </div>


                                </form>
                                  </div>
                                </div>
                              </div>';
                              //fin del modal
                }else{
                    $resultado .= '<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal'.$row['id'].'">
                    Reingresar</button>';
                    //Crear el modal
                     $resultado .= '<div class="modal fade" id="modal'.$row['id'].'"> tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Reingresar a '.$row["nombre"].'</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <h5>DATOS DE REINGRESO</h5>
                                            <div class="alert alert-warning" role="alert">
                                              <h6 class="alert-heading">¿Estás seguro de que deseas Reingresar a <strong>'.$row['nombre'].'</strong> con puesto <strong>"'.$row['puesto'].'</strong>"?</h6>
                                            </div>
                                            <form action="../controladores/controlador_reingresarEmpleado.php" method="post">
                                              <div class="form-group">
                                                <i class="far fa-calendar-alt"></i>
                                                    <label for="fechaEgreso">Fecha de reingreso:</label>
                                                    <input type="date" class="form-control" placeholder="" name="fechaReingreso" required>
                                                     <input type="hidden" name="id" value="'.$row['id'].'"></input>
                                               </div>

                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                          <button type="submit" class="btn btn-success">Reingresar</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>';
                                  //fin del modal
                }
		 }
		 $resultado .= "</td>";
         $resultado .= "</tr>";


     }

     mysqli_free_result($resultados); //Liberar la memoria

     desconectar_bd($conexion_bd);

     $resultado .= "</tbody></table></div>";
     return $resultado;
   }

   //Consulta el detalle de cada empleado
   function detalle_empleado($id="") {
     $conexion_bd = conectar_bd();

    $resultado =  '<div class="container-fluid">';

    $consulta = 'Select E.idEmpleado as id, E.Nombre as nombre, P.nombre as puesto, E.fechaI as fechaIngreso, E.fechaNacimiento as fechaNacimiento, E.estadoNacimiento as eNacimiento, E.curp as curp, E.rfc as rfc, E.segSocial as segsocial, E.direccion as direccion, E.correo as correo, E.celular as celular, E.diasT as diasT, E.horasT as horasT, EC.nombre as estcivil, E.escolaridad as escolaridad ';
    $consulta .=' From empleado as E, puesto as P, estadocivil as EC';
    $consulta .= ' WHERE E.idEmpleado = '.$id.' AND E.idEstCivil = EC.idEstCivil AND E.idPuesto = P.idPuesto ';



    $resultados = $conexion_bd->query($consulta);
     while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        //DATOS INICIALES
        //calcular edad
            $edad = calculaEdad($row['fechaNacimiento']);
         $resultado .= '<h1 class="mt-4 text-primary" align="center" >'.$row['nombre'].'</h1>';
         $resultado .= '<center><small class="text-muted">'.$row['puesto'].'    |</small>';
         $resultado .= ' <small class="text-muted">'.$row['fechaIngreso'].'</small></center>';
         $resultado .= '<hr />';
        //DATOS PERSONALES
         $resultado .= '<div class="container-fluid"><div id="info"><div class="row"><div class="col-12 col-md-4 offset-md-1"><span class="badge badge-secondary">Información personal</span><ul>';
         $resultado .= '<li><strong>EDAD:   </strong>'.$edad.'</li>';
         $resultado .= '<li><strong>FECHA DE NACIMIENTO:  </strong>'.$row['fechaNacimiento'].'</li>';
         $resultado .= '<li><strong>ESTADO DE NACIMIENTO:   </strong>'.$row['eNacimiento'].'</li>';
         $resultado .= '<li><strong>CURP:   </strong>'.$row['curp'].'</li>';
         $resultado .= '<li><strong>RFC:   </strong>'.$row['rfc'].'</li>';
         $resultado .= '<li><strong>NO. DE SEGURO SOCIAL:   </strong>'.$row['segsocial'].'</li>
                        </ul>
                        </div>';
        //INFORMACION DE CONTACTO
         $resultado .= '<div class="col-12 col-md-4 offset-md-1">
                        <span class="badge badge-secondary">Información de Contacto</span>
                        <ul>';
         $resultado .= '<li><strong>DIRECCIÓN:   </strong>'.$row['direccion'].'</li>';
         $resultado .= '<li><strong>CORREO:   </strong>'.$row['correo'].'</li>';
         $resultado .= '<li><strong>CELULAR:</strong><a href="tel:+52'.$row['celular'].'">   '.$row['celular'].'</a></li>';
         $resultado .= '<li><strong>CORREO:</strong>'.$row['correo'].'</li></ul>
                        </div>
                        </div><hr/>';
        //INFORMACION DE CONTRATACION
         $resultado .= '<div class="row">
                        <div class="col-12 col-md-4 offset-md-1">
                        <span class="badge badge-secondary">Información de Contratación</span>
                        <ul>';
                        //salario pendiente por tabla sin registros
         $resultado .= '<li><strong>SALARIO DIARIO ACTUAL   :</strong></li>';
         $resultado .= '<li><strong>DIAS QUE LABORA:</strong>'.$row['diasT'].'</li>';
         $resultado .= '<li><strong>HORARIO LABORAL:</strong>'.$row['horasT'].'</li>';
                        //horas semanales de trabajo pendiente por operacion y falta de datos
         $resultado .= '<li><strong>HORAS DE TRABAJO:</strong></li>
                        </ul>
                        </div>';
        //INFORMACION DE NOMINA
         $resultado .= '<div class="col-12 col-md-4 offset-md-1">
                        <span class="badge badge-secondary">Información Nómina</span>
                        <ul>';
         $resultado .= '<li><strong>ESTADO CIVIL:  </strong>'.$row['estcivil'].'</li>';
         $resultado .= '<li><strong>ESCOLARIDAD:   </strong>'.$row['escolaridad'].'</li>';
         $resultado .= '<li><strong># BENEFICIARIOS:  </strong></li>
                        </ul>
                        <a href=\"verBeneficiario.php?id='.$row['id'].' class="btn btn-outline-success">Ver Beneficiarios</a>
                        </div>
                        </div>
                        <hr/>';

        }
     mysqli_free_result($resultados); //Liberar la memoria

     desconectar_bd($conexion_bd);
     return $resultado;
   }

   //Egresar un empleado
   function egresarEmpleado($id, $fechaEgreso, $motivoEgreso){
    $conexion_bd = conectar_bd();

    $estado="inactivo";

    //Prepara la consulta
    $dml_egresar = 'UPDATE empleado SET fegreso=(?), motivoegreso=(?), estado=(?) WHERE idEmpleado=(?)';
    if ( !($statement = $conexion_bd->prepare($dml_egresar)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
    //Unir los parámetros de la función con los parámetros de la consulta
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("sssi", $fechaEgreso, $motivoEgreso, $estado, $id)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
   //Executar la consulta
    if (!$statement->execute()) {
        die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    desconectar_bd($conexion_bd);
    return 1;
   }


   //Reingresar un empleado
    function reingresarEmpleado($id, $fechaReingreso){
    $conexion_bd = conectar_bd();

    $estado="activo";

    //Prepara la consulta
    $dml_reingresar = 'UPDATE empleado SET fechaI=(?), estado=(?) WHERE idEmpleado=(?)';
    if ( !($statement = $conexion_bd->prepare($dml_reingresar)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
    //Unir los parámetros de la función con los parámetros de la consulta
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("ssi", $fechaReingreso, $estado, $id)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
   //Executar la consulta
    if (!$statement->execute()) {
        die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    desconectar_bd($conexion_bd);
    return 1;
   }


//------------------------------------------------------------
 //        --- INICIAR SESION---
//-------------------------------------------------------------

	  // funcion para checar la contraseña

 function getQuery($user){
      $conexion_bd = conectar_bd();
      $query = "SELECT password FROM usuario WHERE usuario='$user'";

    $result = mysqli_query($conexion_bd, $query);
      while($row=mysqli_fetch_array($result,MYSQLI_BOTH)){
        $password["password"]= $row["password"];

      }

      mysqli_free_result($result);
      desconectar_bd($conexion_bd);

      return $password["password"];
}

//------------------------------------------------------------
 //        --- CUENTAS---
//-------------------------------------------------------------

  function autenticar_bd($username, $password)
  {
    $conexion_bd = conectar_bd();
    $query = "SELECT p.nombre as per, u.nombre as nom, u.id as id
              FROM usuario u, desempenia d, rol r, obtiene o, permiso p
              WHERE u.id = d.usuario_id
              AND d.rol_id = r.id
              AND o.rol_id = r.id
              AND o.permiso_id = p.id
              AND u.usuario = '$username'
              AND u.password = '$password'";

    $result = mysqli_query($conexion_bd, $query);
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
      if($row["per"] == "registrar")
      {
        $_SESSION["registrar"] = 1;
      }
      if($row["per"] == "ver")
      {
        $_SESSION["ver"] = 1;
      }
      if($row["per"] == "administrar")
      {
        $_SESSION["administrar"] = 1;
      }
      $_SESSION["nombre"] = $row["nom"];
      $_SESSION["idUsuario"] = $row["id"];


    }

    desconectar_bd($conexion_bd);

  }

 function insertar_usuario($usuario,$password,$nombre,$rol) {
    $conexion_bd = conectar_bd();

    //Prepara la consulta
    $dml = 'INSERT INTO usuario (usuario,password,nombre) VALUES (?,?,?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }

    //Unir los parámetros de la función con los parámetros de la consulta
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("sss", $usuario, $password, $nombre)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    //************
    //***Insertar el rol****
    //************

    //obtener el id del usuario
    $resultados = $conexion_bd->query("SELECT * from usuario ORDER BY id DESC LIMIT 1");
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        $resultado = $row["id"];
    }
    $id_u = $resultado;
    echo $id_u;



    //insercion del rol en la bd
    $dml = 'INSERT INTO desempenia (usuario_id,rol_id) VALUES (?,?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }

    //Unir los parámetros de la función con los parámetros de la consulta
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("ii", $id_u, $rol)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    desconectar_bd($conexion_bd);
    return 1;
  }

  //consultar cuentas
 function consultar_usuarios() {
    $conexion_bd = conectar_bd();

    $resultado =  "<br/><table class='table table-hover table-striped table-responsive-md btn-table'><thead><tr><th>Nombre</th><th>Usuario</th><th>Rol</th><th>Opciones</th></tr></thead>";

    $consulta = 'SELECT u.id as id, u.usuario as usuario, u.nombre as nombre, r.nombre as rol';
    $consulta .= ' FROM usuario as u, desempenia as d, rol as r';
    $consulta .= ' WHERE u.id=d.usuario_id AND r.id=d.rol_id';
    $consulta .= ' ORDER BY u.id';


    $resultados = $conexion_bd->query($consulta);


    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {

        $resultado .= "<tr>";
		$resultado .= "<td>".$row['nombre']."</td>";
        $resultado .= "<td>".$row['usuario']."</td>"; //o el nombre de la columna

        $resultado .= "<td>".$row['rol']."</td>";
         $resultado .= "<td>"."<a href='../controladores/controlador_editarU.php?id=".$row['id']."'>&#9881;</a>";
              $tituloModal = str_replace(' ', ' ', $row['usuario']);
        $resultado .= "<button type='button' class='btn' data-toggle='modal' data-target='#".$tituloModal."'>";
        $resultado.="&#9940;</button>"."</td>";
        include("modalEliminarUsuario.html");
        $resultado .= "</tr>";

    }

    mysqli_free_result($resultados); //Liberar la memoria

    desconectar_bd($conexion_bd);

    $resultado .= "</tbody></table>";
    return $resultado;
  }




	//Consultar un campo de una tabla a partir de su llave
	//$llave es el valor de la llave del registro que se quiere recuperar
	//$tabla es el nombre de la tabla pasado como string
	//$nombreLlave es el nombre de la llave de la tabla (como aparece en la bd) pasado como string
	//$campo es el nombre del campo que se quiere recuperar (como aparece en la bd) pasado como string
	function recuperar_dos_llaves($llaveuno, $llavedos, $tabla, $nombreLlaveuno, $nombrellavedos, $campo) {

	 $conexion_bd = conectar_bd();


	 $consulta = "SELECT $campo FROM $tabla WHERE $nombreLlaveuno ='$llaveuno' and $nombreLlavedos ='$llavedos'";
	 $resultados = $conexion_bd->query($consulta);
	 while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
		 desconectar_bd($conexion_bd);
		 return $row["$campo"];
	 }

	 desconectar_bd($conexion_bd);
	 return 0;
	 }


    function editar_usuario($idUsuario,$usuario,$password,$nombre,$rol) {
    $conexion_bd = conectar_bd();

    //Prepara la consulta
    $dml = 'UPDATE usuario SET usuario=(?), password=(?), nombre= (?) WHERE id=(?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }

    //Unir los parámetros de la función con los parámetros de la consulta
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("sssi", $usuario, $password, $nombre, $idUsuario)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }


    //editar rol en la bd
    $dml = 'UPDATE desempenia SET rol_id=(?) WHERE usuario_id =(?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }

    //Unir los parámetros de la función con los parámetros de la consulta
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("ii", $rol, $idUsuario)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    $_SESSION["Usuario"] = $usuario;
    $_SESSION["Contraseña"] = $password;
    $_SESSION["nombre"] = $nombre;
    autenticar_bd($usuario, $password);
    desconectar_bd($conexion_bd);
      return 1;
  }

  	//Eliminar a un usuario
	function eliminar_cuentaE($idUsuario){
		$conexion_bd = conectar_bd();

		//preparar la consulta para borrar de la tabla usuario
		$dml2_eliminar = 'DELETE FROM usuario WHERE id=(?)';
		if ( !($statement = $conexion_bd->prepare($dml2_eliminar))) {
			die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
			return 0;
		}

		//Unir los parámetros de la función con los parámetros de la consulta
		//El primer argumento de bind_param es el formato de cada parámetro
		if (!$statement->bind_param("i", $idUsuario)) {
			die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
			return 0;
		}

		//Executar la consulta
		if (!$statement->execute()) {
		  die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
			return 0;
		}

		desconectar_bd($conexion_bd);
		return 1;

	}



//editar usuario personal

function editar_usuarioP($idUsuario,$password) {
$conexion_bd = conectar_bd();

//Prepara la consulta
$dml = 'UPDATE usuario SET password=(?) WHERE id=(?)';
if ( !($statement = $conexion_bd->prepare($dml)) ) {
	die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
	return 0;
}

//Unir los parámetros de la función con los parámetros de la consulta
//El primer argumento de bind_param es el formato de cada parámetro
if (!$statement->bind_param("si", $password, $idUsuario)) {
	die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
	return 0;
}

//Executar la consulta
if (!$statement->execute()) {
  die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
	return 0;
}


$_SESSION["Contraseña"] = $password;

// autenticar_bd($usuario, $password);
desconectar_bd($conexion_bd);
  return 1;
}

//editar cuenta personal
function editar_usuarioPer($idUsuario, $pass) {
$conexion_bd = conectar_bd();

//Prepara la consulta
$dml = 'UPDATE usuario SET password=(?) WHERE id=(?)';
if ( !($statement = $conexion_bd->prepare($dml)) ) {
	die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
	return 0;
}

//Unir los parámetros de la función con los parámetros de la consulta
//El primer argumento de bind_param es el formato de cada parámetro
if (!$statement->bind_param("si", $pass, $idUsuario)) {
	die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
	return 0;
}

//Executar la consulta
if (!$statement->execute()) {
  die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
	return 0;
}


$_SESSION["Contraseña"] = $pass;

// autenticar_bd($usuario, $password);
desconectar_bd($conexion_bd);
  return 1;
}

function recuperar_id($user) {

	$conexion_bd = conectar_bd();


	$consulta = "SELECT id FROM usuario WHERE usuario ='$user'";
	$resultados = $conexion_bd->query($consulta);
	while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
		desconectar_bd($conexion_bd);
		return $row["id"];
	}

	desconectar_bd($conexion_bd);
	return 0;
  }

 function recuperar_idC($pass) {

	$conexion_bd = conectar_bd();


	$consulta = "SELECT id FROM usuario WHERE password ='$pass'";
	$resultados = $conexion_bd->query($consulta);
	while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
		desconectar_bd($conexion_bd);
		return $row["id"];
	}

	desconectar_bd($conexion_bd);
	return 0;
  }

function buscarUsuarioRepetido($user){
	$conexion_bd = conectar_bd();

	$busqueda="SELECT * FROM usuario WHERE usuario='$user'";
	  $resultados = mysqli_query($conexion_bd,$busqueda);

	if(mysqli_num_rows($resultados)>0){
		return 1;

	}else{
		return 0;
	}

	desconectar_bd($conexion_bd);

}


	//---------------------------------------------------------------
	//-----------------------------PRUEBAS---------------------------
	//---------------------------------------------------------------

// Recuperar areas y actividades del banco de datos de pruebas y generar tabla
function crear_tabla_prueba ($idseccion, $idprueba) {
	$conexion_bd = conectar_bd();

	$seccion = recuperar($idseccion, "seccion", "ID", "nombre");
	$resultado = "  <input type='hidden' name='seccionActual' id='seccionActual' value='".$idseccion."'>
								<table class='table table-borderless'>
										<thead>
											<tr>
												<td scope='col'>#</td>
												<th scope='col'>".$seccion."</th>
												<th scope='col'><i class='material-icons fails'>close</i></th>
												<th scope='col'><i class='material-icons tries'>hdr_weak</i></th>
												<th scope='col'><i class='material-icons succeed'>check</i></th>
												<th scope='col'><i class='material-icons' onclick='comentar_prueba()''>comment</i></th>
											</tr>
										</thead>";

	$consulta = "SELECT nombre_actividad, calificacion from actividad a, valorar_actividad v WHERE a.ID = v.id_actividad and v.id_seccion = ".$idseccion." and id_prueba = ".$idprueba;
	$resultados = $conexion_bd->query($consulta);

	$i = 1;
	while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
			$resultado .= "<tr>
				<td scope='row'>".$i."</td>
				<td>".$row['nombre_actividad']."</td>
				<td>
					<div class='form-check form-check-inline'>
						<input class='form-check-input' type='radio' name='".$row['nombre_actividad']."' ";
						if ($row['calificacion'] == 1) {
							$resultado .= "checked";
						}
						$resultado .= " value=1>

					</div>
				</td>
				<td>
					<div class='form-check form-check-inline'>
					<input class='form-check-input' type='radio' name='".$row['nombre_actividad']."' ";
					if ($row['calificacion'] == 2) {
						$resultado.= "checked";
					}
					$resultado .= " value=2>
					</div>
				</td>
				<td>
					<div class='form-check form-check-inline'>
					<input class='form-check-input' type='radio' name='".$row['nombre_actividad']."' ";
					if ($row['calificacion'] == 3) {
						$resultado.= "checked";
					}
					$resultado .= " value=3>
					</div>
				</td>
				<td>
					<i class='material-icons' onclick='comentar_prueba()''>comment</i>
				</td>
			</tr>";
			$i += 1;
			$resultado .= "</tr> ";
	}
			$resultado .= "<input type='hidden' name='contadorAct' id='contadorAct' value='".($i-1)."'>";

	mysqli_free_result($resultados); //Liberar la memoria

	desconectar_bd($conexion_bd);
	$resultado .= "</tbody></table>";
	return $resultado;
}

//Generar card de beneficiaria
function crear_card_beneficiaria ($idBeneficiaria) {
	$conexion_bd = conectar_bd();

	$resultado = "<div class='row d-flex justify-content-center '>
									<div class='card mb-3 border-top-0 border-left-0 col-xs-4 cardCompleta'>
										<div class='row no-gutters'>
											<div class='col-md-4'>
												<img src='../images/malala.jpg' class='card-img rounded-circle foto-prueba' alt='Foto beneficiaria'>
											</div>
											<div class='col-8'>
												<div class='card-body'>";

	$consulta = 'SELECT nombreCompleto, diagnosticoInt, diagnosticoMotriz, fechaNacimiento, fechaIngreso from beneficiarias where idBeneficiaria = '.$idBeneficiaria;
	$resultados = $conexion_bd->query($consulta);
	while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
		$resultado .= "<h5 class='card-title'>".$row['nombreCompleto']."</h5>";
		$resultado .= "<p class='card-text'> DX Intelectual: ".$row['diagnosticoInt'];
		$resultado .= "<br>DX Motriz: ".$row['diagnosticoMotriz'];

		$edad = calculaEdad($row['fechaNacimiento']);
		$resultado .= "<br>Edad: ".$edad." años</p>";

		$row['fechaIngreso'] = (new DateTime($row['fechaIngreso']))->format('d-m-Y');
		$resultado .= "<p class='card-text'><small class='text-muted'>Fecha de ingreso: ".$row['fechaIngreso']."</small></p>";

	}

	$resultado .= "</div></div></div></div></div>";
	desconectar_bd($conexion_bd);
	return $resultado;
}

//Actualiza los datos del plan de seguimiento de la beneficiaria, ingresando sus logros y $prerequisito con base en la llave primaria
function llenar_plan_seguimiento ($id_prueba, $id_beneficiaria, $id_seccion, $prerequisito, $logro) {
	$conexion_bd = conectar_bd();

	//Prepara la consulta
	$dml = 'UPDATE valorar_seccion SET prerequisito_objetivo=(?), logro_dificultad=(?)  WHERE id_prueba=(?) and
	id_beneficiaria=(?) and id_seccion=(?)';

	if ( !($statement = $conexion_bd->prepare($dml)) ) {
			die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
			return 0;
	}

	//Unir los parámetros de la función con los parámetros de la consulta
	//El primer argumento de bind_param es el formato de cada parámetro
	if (!$statement->bind_param("ssiii", $prerequisito, $logro, $id_prueba, $id_beneficiaria, $id_seccion)) {
			die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
			return 0;
	}

	//Executar la consulta
	if (!$statement->execute()) {
		die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
			return 0;
	}

	desconectar_bd($conexion_bd);
		return 1;
}

function calcular_seccion($benefActual) {
	$edadBenef = calculaEdad(recuperar($benefActual, "beneficiarias", "idBeneficiaria", "fechaNacimiento"));
	if ($edadBenef > 6) {
		$seccionActual = 20;
	} else {
		$seccionActual = 1;
	}
	return $seccionActual;
}

//update de la actividad de la prueba que esta llevando a cabo.
function actualizar_actividad($idprueba, $idbenef, $idseccion, $idactividad, $calificacion, $observacion='') {
	$conexion_bd = conectar_bd();

	//Prepara la consulta
	$dml = 'UPDATE valorar_actividad SET calificacion=(?)  WHERE id_prueba=(?) and
	id_beneficiaria=(?) and id_seccion=(?) and id_actividad=(?) ';

	if ( !($statement = $conexion_bd->prepare($dml)) ) {
			die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
			return 0;
	}

	//Unir los parámetros de la función con los parámetros de la consulta
	//El primer argumento de bind_param es el formato de cada parámetro
	if (!$statement->bind_param("iiiii", $calificacion, $idprueba, $idbenef, $idseccion, $idactividad)) {
			die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
			return 0;
	}

	//Executar la consulta
	if (!$statement->execute()) {
		die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
			return 0;
	}

	desconectar_bd($conexion_bd);
		return 1;
}



//Update de la actividad de la prueba que esta llevando a cabo.
function actualizar_seccion($idprueba, $idbenef, $idseccion, $calificacion_seccion, $observacion='') {
	$conexion_bd = conectar_bd();

	//Prepara la consulta
	$dml = 'UPDATE valorar_seccion SET calificacion_seccion=(?)  WHERE id_prueba=(?) and
	id_beneficiaria=(?) and id_seccion=(?) ';

	if ( !($statement = $conexion_bd->prepare($dml)) ) {
			die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
			return 0;
	}

	//Unir los parámetros de la función con los parámetros de la consulta
	//El primer argumento de bind_param es el formato de cada parámetro
	if (!$statement->bind_param("iiii", $calificacion_seccion, $idprueba, $idbenef, $idseccion)) {
			die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
			return 0;
	}

	//Executar la consulta
	if (!$statement->execute()) {
		die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
			return 0;
	}

	desconectar_bd($conexion_bd);
		return 1;
}
//
//
// function recuperar_calif_act($idprueba, $idbenef, $idseccion, $idact) {
// 		$conexion_bd = conectar_bd();
//
// 		$consulta = "SELECT calificacion FROM valorar_actividad WHERE id_prueba ='$idprueba' and id_beneficiaria ='$idbenef' and id_seccion ='$idseccion' and id_actividad ='$idact'";
// 		$resultados = $conexion_bd->query($consulta);
// 		while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
// 			desconectar_bd($conexion_bd);
// 			return $row["calificacion"];
// 		}
//
// 		desconectar_bd($conexion_bd);
// 		return 0;
// }

//Insertar en tabla valorar_seccion para creacion de nueva prueba
function insertar_seccion($idprueba, $idbenef, $idseccion, $calif_seccion, $evaluador, $date, $observacion='') {
	$conexion_bd = conectar_bd();

	//Prepara la consulta
	$dml = 'INSERT INTO valorar_seccion (id_prueba, id_beneficiaria, id_seccion, calificacion_seccion, fecha, evaluador) VALUES (?, ?, ?, ?, ?, ?)';

	if ( !($statement = $conexion_bd->prepare($dml)) ) {
			die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
			return 0;
	}

	//Unir los parámetros de la función con los parámetros de la consulta
	//El primer argumento de bind_param es el formato de cada parámetro
	if (!$statement->bind_param("iiiiss", $idprueba, $idbenef, $idseccion, $calif_seccion, $date, $evaluador)) {
			die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
			return 0;
	}

	//Executar la consulta
	if (!$statement->execute()) {
		die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
			return 0;
	}

	desconectar_bd($conexion_bd);
		return 1;
}

//Insertar en tabla valorar_seccion para creacion de nueva prueba
function insertar_actividad($idprueba, $idbenef, $idseccion, $idact,  $calif_act, $date, $observacion='') {
	$conexion_bd = conectar_bd();


	//Prepara la consulta
	$dml = 'INSERT INTO valorar_actividad (id_prueba, id_beneficiaria, id_seccion, id_actividad, fecha, calificacion) VALUES (?, ?, ?, ?, ?, ?)';

	if ( !($statement = $conexion_bd->prepare($dml)) ) {
			die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
			return 0;
	}

	//Unir los parámetros de la función con los parámetros de la consulta
	//El primer argumento de bind_param es el formato de cada parámetro
	if (!$statement->bind_param("iiiisi", $idprueba, $idbenef, $idseccion, $idact, $date, $calif_act)) {
			die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
			return 0;
	}

	//Executar la consulta
	if (!$statement->execute()) {
		die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
			return 0;
	}

	desconectar_bd($conexion_bd);
		return 1;
}

function recuperar_ultima_prueba() {
	$conexion_bd = conectar_bd();

	$consulta = 'SELECT id_prueba from valorar_actividad order by id_prueba desc limit 1';
	$resultados = $conexion_bd->query($consulta);
	while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
		return $row;
		desconectar_bd($conexion_bd);
	}

	desconectar_bd($conexion_bd);
	return 0;
}

function insert_act_sec ($inicio, $final, $pruebaActual, $noseccion, $date) {
	for ($i=$inicio; $i <= $final; $i++) {
		insertar_actividad($pruebaActual, $_SESSION["benefactual"], $noseccion, $i, 0, $date);
	}
	insertar_seccion($pruebaActual, $_SESSION["benefactual"], $noseccion, 0, $_SESSION["usuario"], $date);
}

function recuperar_id_actividad ($idprueba, $idbenef, $idseccion) {
	$conexion_bd = conectar_bd();

	$consulta = 'SELECT id_actividad from valorar_actividad where  id_prueba='.$idprueba.' and id_beneficiaria='.$idbenef.' and id_seccion ='.$idseccion.' limit 1';
	$resultados = $conexion_bd->query($consulta);
	while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
		return $row[0];
		desconectar_bd($conexion_bd);
	}

	desconectar_bd($conexion_bd);
	return 0;
}



// CONSULTAR BENEFICIARIAS ACTIVAS
function consultarBeneficiarias($idMotivoIngreso="", $idBeneficiaria=""){

  $conexion_bd = conectar_bd();

  $resultado =  "<div class=\"row\"><div class=\"miTabla table-wrapper-scroll-y my-custom-scrollbar mx-auto text-center\"><table class='table table-hover table-striped table-responsive btn-table'><thead><tr><th>Nombre</th><th>Edad</th><th>Fecha de ingreso</th><th>Motivo de ingreso</th><th>Diagnóstico Intelectual</th></tr></thead>";

  $consulta = 'Select idBeneficiaria, nombreCompleto, edad, fechaIngreso, M.motivoIngreso as motivoIngreso, diagnosticoInt From beneficiarias as B, motivosIngreso as M Where M.idMotivoIngreso = B.idMotivoIngreso AND B.beneficiariaActiva <> 0';

  if ($idMotivoIngreso != "") {
        $consulta .= " AND M.idMotivoIngreso= ".$idMotivoIngreso;
  }

  if ($idBeneficiaria != "") {
  		$consulta .= " AND B.idBeneficiaria = ".$idBeneficiaria;
  }

  $resultados = $conexion_bd->query($consulta);
  $resultado .= "<br>";

  while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)){
        $resultado .= "<tr>";
        $resultado .= "<td>".$row['nombreCompleto']."</td>";
        $resultado .= "<td>".$row['edad']."</td>";
        $resultado .= "<td>".$row['fechaIngreso']."</td>";
        $resultado .= "<td>".$row['motivoIngreso']."</td>";
        $resultado .= "<td>".$row['diagnosticoInt']."</td>";
        $resultado .= "<td>"."<a href='../beneficiarias/verBeneficiaria.php?idBeneficiaria=".$row['idBeneficiaria']."'>&#9776;</a>"."</td>";
        if($_SESSION["usuario"] === "Administradora")
		{
        // VER MAS DE BENEFICIARIA pasar beneficiariaActiva === 1
        $resultado .= "<td>"."<a href='verBeneficiaria.php?idBeneficiaria=".$row['idBeneficiaria']."'>&#9776;</a>"."</td>";
        	// MODIFICAR DATOS DE BENEFICIARIA
        	$resultado .= "<td>"."<a href='modificarBeneficiaria.php?editar=general&idBeneficiaria=".$row['idBeneficiaria']."'>&#9881;</a>"."</td>";
        	// EGRESAR BENEFICIARIA
        	$tituloModal =  str_replace(' ', '', $row['nombreCompleto']);
        	$resultado .= "<td>"."<button type='button' class='btn' data-toggle='modal' data-target='#".$tituloModal."'>";
        	$resultado .= "&#9940;</button >"."</td>";
        	// INCLUIR MODAL DE EGRESO
        	include("egresar.html");
        }
        $resultado .= "</tr>";
  }

  mysqli_free_result($resultados); //Liberar la memoria

  desconectar_bd($conexion_bd);

  $resultado .= "</tbody></table><br>";
  return $resultado;
}

// CONSULTAR BENEFICIARIAS EGRESADAS
function consultarBeneficiariasEgresadas($idMotivoEgreso="", $idDestino="", $idBeneficiaria=""){

  $conexion_bd = conectar_bd();

  $resultado =  "<div class=\"row\"><div class=\"miTabla table-wrapper-scroll-y my-custom-scrollbar mx-auto text-center\"><table class='table table-hover table-striped table-responsive btn-table'><thead><tr><th>Nombre</th><th>Edad</th><th>Fecha de egreso</th><th>Motivo de egreso</th><th>Destino</th></tr></thead>";

  $consulta = 'Select idBeneficiaria, beneficiariaActiva, nombreCompleto, edad, fechaEgreso, M.motivoEgreso as motivoEgreso, D.nombreDestino as nombreDestino From beneficiarias as B, motivosEgreso as M, destinos as D Where M.idMotivoEgreso = B.idMotivoEgreso AND D.idDestino = B.idDestino AND B.beneficiariaActiva = "0"';

  if ($idMotivoEgreso != "") {
        $consulta .= " AND M.idMotivoEgreso= ".$idMotivoEgreso;
  }

  if ($idDestino != "") {
        $consulta .= " AND D.idDestino= ".$idDestino;
  }

  if ($idBeneficiaria != "") {
  		$consulta .= " AND B.idBeneficiaria = ".$idBeneficiaria;
  }

  $resultados = $conexion_bd->query($consulta);
  $resultado .= "<br>";

  while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)){
        $resultado .= "<tr>";
        $resultado .= "<td>".$row['nombreCompleto']."</td>";
        $resultado .= "<td>".$row['edad']."</td>";
        $resultado .= "<td>".$row['fechaEgreso']."</td>";
        $resultado .= "<td>".$row['motivoEgreso']."</td>";
        $resultado .= "<td>".$row['nombreDestino']."</td>";
        // VER MAS DE BENEFICIARIA -- pasar beneficiariaActiva===0
        $resultado .= "<td>"."<a href='verBeneficiaria.php?idBeneficiaria=".$row['idBeneficiaria']."'>&#9776;</a>"."</td>";
        //if($_SESSION["usuario"] === "Administradora")
		//{
        	// MODIFICAR DATOS DE BENEFICIARIA
        	$resultado .= "<td>"."<a href='modificarBeneficiaria.php?editar=egreso&idBeneficiaria=".$row['idBeneficiaria']."'>&#9881;</a>"."</td>";

        	// REINGRESAR BENEFICIARIA
        	$tituloModal =  str_replace(' ', '', $row['nombreCompleto']);
        	$resultado .= "<td>"."<button type='button' class='btn' data-toggle='modal' data-target='#".$tituloModal."'>";
        	$resultado .= "&#128260;</button >"."</td>";
        	// INCLUIR MODAL DE EGRESO
        	include("reingresar.html");
        //}
        $resultado .= "</tr>";
  }

  $resultado .= "</tbody></table><br>";
  return $resultado;

  mysqli_free_result($resultados); //Liberar la memoria

  desconectar_bd($conexion_bd);
}

  //Función para ingresar una nueva beneficiaria

  function registrarBeneficiaria($nombreCompleto, $fechaNacimiento, $edad, $fechaIngreso, $idMotivoIngreso, $otroMotivoIngreso, $nombreCanalizador, $consideracionesIngreso, $diagnosticoInt, $diagnosticoMotriz, $edadMental, $antecedentes, $vinculosFam, $situacionJuridica, $convivencias, $tutela, $idEscolaridad, $gradoEscolar){
    $conexion_bd = conectar_bd();

    //Preparar consulta

    $registrar = 'INSERT INTO beneficiarias (nombreCompleto, fechaNacimiento, edad, fechaIngreso, idMotivoIngreso, otroMotivoIngreso, nombreCanalizador, consideracionesIngreso, diagnosticoInt, diagnosticoMotriz, edadMental, antecedentes, vinculosFam, situacionJuridica, convivencias, tutela, idEscolaridad, gradoEscolar) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

    if ( !($statement = $conexion_bd->prepare($registrar))) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
    }

    //Unir los parámetros
    if (!$statement->bind_param("ssisisssssisssssis", $nombreCompleto, $fechaNacimiento, $edad, $fechaIngreso, $idMotivoIngreso, $otroMotivoIngreso, $nombreCanalizador, $consideracionesIngreso, $diagnosticoInt, $diagnosticoMotriz, $edadMental, $antecedentes, $vinculosFam, $situacionJuridica, $convivencias, $tutela, $idEscolaridad, $gradoEscolar)){
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
    }


    //Ejecutar el registro de la beneficiaria
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
    }

    desconectar_bd($conexion_bd);
    return 1;
  }

//Funcion para crear cada seccion del plan de seguimiento dependiendo del area y de la habilidad a evaliar
function crear_plan($AreaHab, $id) {
	$resultado = '<div class="flex-row d-flex justify-content-center ">
	<div class="p-2 w-75">
	<div class="accordion PlanSeccion" id="accordionPlanSeg">
	  <div class="card PlanSeccion">
	    <div class="card-header" id="headingOne">
	      <h2 class="mb-0">
					<div class="flex-row d-flex justify-content-center">
	        <button class="btn btn-link PlanSeccion" type="button" data-toggle="collapse" data-target="#'.$id.'" aria-expanded="true" aria-controls="collapseOne">
	          '.$AreaHab.'
	        </button>
					</div>
	      </h2>
	    </div>

	    <div id="'.$id.'" class="collapse interior" aria-labelledby="headingOne" data-parent="#accordionPlanSeg">
	      <div class="flex-row d-flex justify-content-center">
	        <div class="p-2 flex-fill">
	          Pre-requisitos/Objetivos
	          <textarea class="form-control planSeg" ></textarea>
	        </div>
	        <div class="p-2 flex-fill">
	          Logros y Dificultades
	          <textarea class="form-control planSeg" ></textarea>
	        </div>
	      </div>
	      <div class="d-flex flex-row justify-content-end">
	          <button type="button" class="btn btn-outline-success" onclick="">Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>
	</div>
	</div>';

	return $resultado;
}

function enviarCorreo($nombreEnvía, $recipiente) {
	$email = new \SendGrid\Mail\Mail();
	$email->setFrom("a01704889@itesm.mx", "$nombreEnvía");
	$email->setSubject("Esta es la segunda prueba");
	$email->addTo("$nombreEnvía", "EXAMPLE recipient");
	$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
	$email->addContent(
			"text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
	);
	$sendgrid = new \SendGrid('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');
	try {
			$response = $sendgrid->send($email);
			print $response->statusCode() . "\n";
			print_r($response->headers());
			print $response->body() . "\n";
	} catch (Exception $e) {
			echo 'Caught exception: '. $e->getMessage() ."\n";
	}
}


  //Función para modificar los datos ingresados de una beneficiaria

  function modificarBeneficiaria($idBeneficiaria, $nombreCompleto, $fechaNacimiento, $edad, $fechaIngreso, $idMotivoIngreso, $otroMotivoIngreso, $nombreCanalizador, $consideracionesIngreso, $diagnosticoInt, $diagnosticoMotriz, $edadMental, $antecedentes, $vinculosFam, $situacionJuridica, $convivencias, $tutela, $idEscolaridad, $gradoEscolar){
    $conexion_bd = conectar_bd();

    //Preparar la consulta
    $modificar = 'UPDATE beneficiarias SET nombreCompleto=(?), fechaNacimiento=(?), edad=(?), fechaIngreso=(?), idMotivoIngreso=(?), otroMotivoIngreso=(?), nombreCanalizador=(?), consideracionesIngreso=(?), diagnosticoInt=(?), diagnosticoMotriz=(?), edadMental=(?), antecedentes=(?), vinculosFam=(?), situacionJuridica=(?), convivencias=(?), tutela=(?), idEscolaridad=(?), gradoEscolar=(?) WHERE idBeneficiaria=(?)';

    if ( !($statement = $conexion_bd->prepare($modificar))) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
    }

    //Unir parámetros de consulta
    if (!$statement->bind_param("ssisisssssisssssisi", $nombreCompleto, $fechaNacimiento, $edad, $fechaIngreso, $idMotivoIngreso, $otroMotivoIngreso, $nombreCanalizador, $consideracionesIngreso, $diagnosticoInt, $diagnosticoMotriz, $edadMental, $antecedentes, $vinculosFam, $situacionJuridica, $convivencias, $tutela, $idEscolaridad, $gradoEscolar, $idBeneficiaria)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
    }

    //Ejecutar consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
    }

    desconectar_bd($conexion_bd);
    return 1;
  }

  //Función para egresar a una beneficiaria

  function egresarBeneficiaria($idBeneficiaria, $fechaEgreso, $idMotivoEgreso, $otroMotivoEgreso, $consideracionesEgreso, $idDestino, $especificacionesDestino, $nombreReceptor, $logros){
    $conexion_bd = conectar_bd();

    //Preparar la consulta
    $egresar = 'UPDATE beneficiarias SET fechaEgreso=(?), idMotivoEgreso=(?), otroMotivoEgreso=(?), consideracionesEgreso=(?), idDestino=(?), especificacionesDestino=(?), nombreReceptor=(?), logros=(?), beneficiariaActiva = 0 WHERE idBeneficiaria=(?)';

    if ( !($statement = $conexion_bd->prepare($egresar))) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
    }

    //Unir parámetros de consulta
    if (!$statement->bind_param("sississsi", $fechaEgreso, $idMotivoEgreso, $otroMotivoEgreso, $consideracionesEgreso, $idDestino, $especificacionesDestino, $nombreReceptor, $logros, $idBeneficiaria, )) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
    }

    //Ejecutar consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
    }

    desconectar_bd($conexion_bd);
    return 1;
  }

  function reingresarBeneficiaria($idBeneficiaria, $fechaReingreso, $motivoReingreso){
    $conexion_bd = conectar_bd();

    //Preparar la consulta
    $egresar = 'UPDATE beneficiarias SET fechaIngreso=(?), motivoReingreso=(?), beneficiariaActiva = 1 WHERE idBeneficiaria=(?)';

    if ( !($statement = $conexion_bd->prepare($egresar))) {
      die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
      return 0;
    }

    //Unir parámetros de consulta
    if (!$statement->bind_param("ssi", $fechaReingreso, $motivoReingreso, $idBeneficiaria)) {
      die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
      return 0;
    }

    //Ejecutar consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 0;
    }

    desconectar_bd($conexion_bd);
    return 1;
  }

  function obtenerBeneficiarias($tabla, $campo, $id=false){
    $conexion_bd = conectar_bd();

    $array = "";
    $consulta = 'SELECT DISTINCT '.$campo.' FROM '.$tabla;

    if($id){
    	$consulta .= ' ORDER BY '.$campo;
    }
    $resultados = $conexion_bd->query($consulta);
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)){
      $array .= $row["$campo"].",";
    }

    mysqli_free_result($resultados);

    desconectar_bd($conexion_bd);

    $array = explode(",", $array);
    return $array;
  }

  //Obtener el campo a modificar

  function obtenerCampo($idBeneficiaria, $campo){
  $conexion_bd = conectar_bd();

    $consultar = "SELECT $campo FROM beneficiarias WHERE idBeneficiaria='$idBeneficiaria'";
    $resultados = $conexion_bd->query($consultar);
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
      closeDB($conexion_bd);
      return $row["$campo"];
    }

    desconectar_bd($conexion_bd);
    return 0;
  }

?>
