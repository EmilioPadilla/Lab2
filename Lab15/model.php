<?php
  function connectBD() {
    $conexion_bd = mysqli_connect("localhost", "root", "", "Lab14");
    if ($conexion_bd == NULL){
      //Es mejor practica solo poner que estamos trabajando en la solucion.
      die("No se pudo establecer conexion con la base de datos");
    }
    return $conexion_bd;
  }



  function disconnectBD($conexion_bd) {
    mysqli_close($conexion_bd);
  }



//Funcion para desplegar materiales dentro de la base de datos.
//@param $Mat_Clave: Si se ingresa la clave de materiales, buscara dentro de la base de datos con este criterio agregado
//@param $Prov_RFC: Si se ingresa el RFC de Proveedores, buscara dentro de la base de datos con este criterio agregado
//@param $Proy_Numero: Si se ingresa el $Proy_Numero de proyectos, buscara dentro de la base de datos con este criterio agregado
  function consultar_existencia($Mat_Clave = "", $Prov_RFC= "", $Proy_Numero = "") {
    $conexion_bd = connectBD();
    $consulta = 'SELECT M.Clave as m_clave, Pv.RFC as pv_rfc, Py.Numero as py_numero,E.Fecha as e_fecha, E.Cantidad as e_cantidad
                  FROM Materiales as M, Proyectos as Py, Proveedores as Pv, Entregan as E
                  WHERE E.Clave = M.Clave AND E.RFC = Pv.RFC AND E.Numero = Py.Numero';

    if ($Mat_Clave != "") {
      $consulta .= " AND E.Clave =".$Mat_Clave;
    }

    if ($Prov_RFC != "") {
      $consulta .= " AND E.RFC='".$Prov_RFC."'";
    }

    if ($Proy_Numero != "") {
      $consulta .= " AND E.numero =".$Proy_Numero;
    }


    $resultados = $conexion_bd->query($consulta);
    $tabla = '<table class="table table-responsive">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Clave</th>
                    <th scope="col">RFC</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Cantidad</th>
                  </tr>
                </thead>
                <tbody>';

    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
      $tabla .= '<tr>';
      $tabla .= '<td>'.$row['m_clave'].'</td>';
      $tabla .= '<td>'.$row['pv_rfc'].'</td>';
      $tabla .= '<td>'.$row['py_numero'].'</td>';
      $tabla .= '<td>'.$row['e_fecha'].'</td>';
      $tabla .= '<td>'.$row['e_cantidad'].'</td>';
      $tabla .= '<td><a href="controller_actualizar_entrega.php?e_fecha='.$row['e_fecha'].'">'."<i class='material-icons'>update</i>"."</a></td>";
      $tabla .= '</tr>';
    }
    $tabla .= '</tbody></table>';

    mysqli_free_result($resultados); #Liberar espacio de memoria
    disconnectBD($conexion_bd); #Desconectarme de BD

    return $tabla;
  }


//Funcion que busca dentro de la tabla dependiendo de los valores seleccionados
  function select_buscar($tabla, $id, $col_descripcion, $seleccion=0) {
    $conexion_bd = connectBD();

    $consulta = "SELECT $id, $col_descripcion FROM $tabla";
    $resultados = $conexion_bd->query($consulta);

    $resultado = '<label>'.$tabla.'...</label>
                  <select class="form-control-sm form-control" name='.$tabla.'>
                    <option value="" disabled selected>Selecciona una opción</option>';
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        $resultado .= '<option value="'.$row["$id"].'" ';

        if($seleccion == $row["$id"]) {
            $resultado .= 'selected';
        }

        $resultado .= '>'.$row["$col_descripcion"].'</option>';


    }

    $resultado .=  '</select>';
    mysqli_free_result($resultados); #Liberar espacio de memoria
    disconnectBD($conexion_bd); #Desconectarme de BD
    return $resultado;
  }



//Funcion para insertar en la BD Entregan. Es necesario hacer un select para insertar en $Clave $RFC y $Numero
//@param $Clave: id de la tabla Materiales en BD
//@param $RFC: id de la tabla Proveedores en BD
//@param $Numero: id clave de la tabla Proyectos en BD
//@param $Cantidad: Cantidad a insertar en BD
  function insertar_entrega($Clave, $RFC, $Numero, $Cantidad) {
    $conexion_bd = connectBD();

    //Preparar la consulta
    $dml = 'INSERT INTO Entregan (Clave,RFC,Numero, Fecha, Cantidad) VALUES (?,?,?,?,?) ';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 1;
    }

    //Definir zona horaria a insertar dentro de la tabla
    date_default_timezone_set('America/Mexico_City');
    $date = date('Y/m/d h:i:s', time());

    //Unir los parametros de la funcion con los parametros de la consulta
    if (!$statement->bind_param("sssss", $Clave,$RFC,$Numero, $date, $Cantidad)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 1;
    }

    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 1;
    }

    disconnectBD($conexion_bd);
    return 0;
  }


  //Funcion para insertar en la BD Entregan. Es necesario hacer un select para insertar en $Clave $RFC y $Numero
  //@param $Clave: id de la tabla Materiales en BD
  //@param $RFC: id de la tabla Proveedores en BD
  //@param $Numero: id clave de la tabla Proyectos en BD
  //@param $Cantidad: Cantidad a insertar en BD
  function eliminar_entrega($Clave, $RFC, $Numero, $Cantidad) {
    $conexion_bd = connectBD();

    //Preparar la consulta
    $dml = 'DELETE FROM Entregan WHERE Clave = ? AND RFC = ? AND Numero = ? AND Cantidad = ?';

    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 1;
    }

    //Unir los parametros de la funcion con los parametros de la consulta
    if (!$statement->bind_param("ssss", $Clave,$RFC,$Numero,$Cantidad)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 1;
    }

    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 1;
    }

    disconnectBD($conexion_bd);
    return 0;
  }


  //Funcion para insertar en la BD Entregan. Es necesario hacer un select para insertar en $Clave $RFC y $Numero
  //@param $Clave: id de la tabla Materiales en BD
  //@param $RFC: id de la tabla Proveedores en BD
  //@param $Numero: id clave de la tabla Proyectos en BD
  //@param $Cantidad: Cantidad a insertar en BD
  function actualizar_entrega($Clave, $RFC, $Numero, $Cantidad) {
    $conexion_bd = connectBD();

    //Preparar la consulta
    $dml = 'DELETE FROM Entregan WHERE Clave = ? AND RFC = ? AND Numero = ? AND Cantidad = ?';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 1;
    }

    //Unir los parametros de la funcion con los parametros de la consulta
    if (!$statement->bind_param("ssss", $Clave,$RFC,$Numero,$Cantidad)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 1;
    }

    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
      return 1;
    }

    disconnectBD($conexion_bd);
    return 0;
  }



  //función para editar un registro de caso de coronavirus
  //@param caso_id: id del caso que se va a editar
  //@param lugar_id: id de la tabla lugar en la base de datos
  function editar_entrega($fecha, $clave, $rfc, $numero, $cantidad) {
    $conexion_bd = connectBD();

    //Prepara la consulta
    $dml = 'UPDATE Entregan SET Clave=(?), RFC=(?), Numero=(?), Cantidad =(?) WHERE Fecha=(?)';

    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }

    //Unir los parámetros de la función con los parámetros de la consulta
    //El primer argumento de bind_param es el formato de cada parámetro
      if (!$statement->bind_param("isids", $clave, $rfc, $numero, $cantidad, $fecha)) {
          die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
          return 0;
      }



    //Executar la consulta
    if (!$statement->execute()) {
      die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }

    disconnectBD($conexion_bd);
      return 1;
  }



  //Consultar campo de entrega a partir de la Fecha
  function recuperar_campo($fecha, $campo) {
    $conexion_bd = connectBD();

    $sql = "SELECT $campo FROM Entregan WHERE Fecha = '$fecha'";
    $resultados = $conexion_bd->query($sql);
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
      disconnectBD($conexion_bd);
      return $row["$campo"];
    }

    disconnectBD($conexion_bd);
    return 0;
  }


 ?>
