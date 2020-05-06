<?php
  //------------------------------------------------------------
   //        --- FUNCIONES GENERALES---
  //-------------------------------------------------------------

	//conectarse a la bd
	function conectar_bd()
	{
		$conexion_bd = mysqli_connect("mysql1008.mochahost.com.", "dawbdorg_1704889", "1704889", "dawbdorg_A01704889");
		$conexion_bd->set_charset("utf8");
		if($conexion_bd == NULL)
			die("La base de datos SEGUNDOEXAMENPARCIAL está en mantenimiento, vuelve a intentarlo más tarde...");

		return $conexion_bd;
	}

	//desconectarse de la bd
	function desconectar_bd($conexion_bd)
	{
		mysqli_close($conexion_bd);
	}



	function select_buscar($tabla, $id, $col_descripcion, $seleccion=0) {
    $conexion_bd = conectar_bd();

    $consulta = "SELECT $id, $col_descripcion FROM $tabla";
    $resultados = $conexion_bd->query($consulta);

    $resultado = '<label>'.$tabla.'...</label>
                  <div class="input-field col s12"><select name='.$tabla.' id='.$tabla.'>
                    <option value="" disabled selected>Selecciona una opción</option>';
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        $resultado .= '<option value="'.$row["$id"].'" ';
        if($seleccion === $row["$id"]) {
            $resultado .= 'selected';
        }
        $resultado .= '>'.$row["$col_descripcion"].'</option>';
    }

		$resultado .=  '</select></div><br>';
		mysqli_free_result($resultados); #Liberar espacio de memoria
		desconectar_bd($conexion_bd); #Desconectarme de BD
		return $resultado;
	}

	//Funcion para desplegar materiales dentro de la base de datos.
		function consultar_incidentes() {
			$conexion_bd = conectar_bd();
			$consulta = 'SELECT distinct I.idIncidente as id_incidente, T.nombreTipo as nombre_tipo, L.nombreLugar as nombre_lugar, I.fecha as i_fecha
										FROM lugar as L, tipo as T, incidente as I
										WHERE I.idtipo = T.idtipo AND I.idLugar = L.idLugar
										ORDER BY I.fecha';


			$resultados = $conexion_bd->query($consulta);
			$tabla = "<table>
									<thead>
											<tr>
													<th>No. de Incidente</th>
													<th>Tipo de Incidente</th>
													<th>Lugar del Incidente</th>
													<th>Fecha de registro</th>
											</tr>
									</thead>
									<tbody>";

			while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
				$tabla .= '<tr>';
				$tabla .= '<td>'.$row['id_incidente'].'</td>';
				$tabla .= '<td>'.$row['nombre_tipo'].'</td>';
				$tabla .= '<td>'.$row['nombre_lugar'].'</td>';
				$tabla .= '<td>'.$row['i_fecha'].'</td>';
				$tabla .= '</tr>';
			}
			$tabla .= '</tbody></table>';

			mysqli_free_result($resultados); #Liberar espacio de memoria
			desconectar_bd($conexion_bd); #Desconectarme de BD

			return $tabla;
		}

		function agregar_incidente($idLugar, $idTipo){
			$conexion_bd = conectar_bd();

			//preparar consulta
			$dml_insertar = 'CALL agregarIncidente(?,?,?)';
			if(!($statement = $conexion_bd->prepare($dml_insertar)))
			{
				die("Error: (".$conexion_bd->errno.") ".$conexion_bd->error);
				return 0;
			}

			//Definir zona horaria a insertar dentro de la tabla
			date_default_timezone_set('America/Mexico_City');
			$date = date('Y/m/d h:i:s', time());

			//unir parámetros de la función con la consulta
			//el primer arg es el formato de cada parámetro
			if(!$statement->bind_param("iis", $idLugar, $idTipo, $date))
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


  function esqueleto_SP($idPersona, $idEstado){
      $conexion_bd = conectar_bd();

      //preparar consulta
      $dml_insertar = 'CALL creaMaterial(?,?)';
      if(!($statement = $conexion_bd->prepare($dml_insertar)))
      {
        die("Error: (".$conexion_bd->errno.") ".$conexion_bd->error);
        return 0;
      }

      //unir parámetros de la función con la consulta
      //el primer arg es el formato de cada parámetro
      if(!$statement->bind_param("ii", $idPersona, $idEstado))
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








 ?>
