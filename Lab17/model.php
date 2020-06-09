<?php 
  //función para conectarnos a la BD
  function conectar_bd() {
      $conexion_bd = mysqli_connect("localhost","root","","coronavirus");
      if ($conexion_bd == NULL) {
          die("No se pudo conectar con la base de datos");
      }
      return $conexion_bd;
  }

  //función para desconectarse de una bd
  //@param $conexion: Conexión de la bd que se va a cerrar
  function desconectar_bd($conexion_bd) {
      mysqli_close($conexion_bd);
  }

  //función para autenticar
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



  //Consulta los casos de coronavirus
  //@param $lugar: El lugar de donde proviene el caso
  //@param $estado: El estado de la infección del caso
  function consultar_casos($lugar="", $estado="") {
    $conexion_bd = conectar_bd();  
    
    $resultado =  "<table><thead><tr><th>Caso</th><th>Lugar</th><th>Estado actual</th><th>Fecha y hora</th></tr></thead>";
    
    $consulta = 'Select caso_id, L.nombre as L_nombre, E.nombre as E_nombre, T.created_at as T_created_at From estado as E, tiene as T, lugar as L, caso as C WHERE E.id = T.estado_id AND C.id = T.caso_id AND C.lugar_id = L.id';
    if ($lugar != "") {
        $consulta .= " AND lugar_id=".$lugar;
    }
    if ($estado != "") {
        $consulta .= " AND estado_id=".$estado;
    }
      
    $resultados = $conexion_bd->query($consulta);  

    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {

        $resultado .= "<tr>";
        $resultado .= '<td><a href="controlador_editar.php?caso_id='.$row['caso_id'].'">'.$row['caso_id']."</a></td>"; //Se puede usar el índice de la consulta
        $resultado .= "<td>".$row['L_nombre']."</td>"; //o el nombre de la columna
        $resultado .= "<td>".$row['E_nombre']."</td>";
        $resultado .= "<td>".$row['T_created_at']."</td>";
        $resultado .= "</tr>";
        
    }
    
    mysqli_free_result($resultados); //Liberar la memoria
  
    desconectar_bd($conexion_bd);   
      
    $resultado .= "</tbody></table>";
    return $resultado;
  }

  //consultar cuentas
  function consultar_usuarios() {
    $conexion_bd = conectar_bd();  
    
    $resultado =  "<table><thead><tr><th>idUsuario</th><th>Nombre</th><th>Usuario</th><th>Rol</th></tr></thead>";
    
    $consulta = 'SELECT u.id as id, u.usuario as usuario, u.nombre as nombre, r.nombre as rol';
    $consulta .= ' FROM usuario as u, desempenia as d, rol as r';
    $consulta .= ' WHERE u.id=d.usuario_id AND r.id=d.rol_id';
    $consulta .= ' ORDER BY u.id';

      
    $resultados = $conexion_bd->query($consulta);  

    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {

        $resultado .= "<tr>";
      //Se puede usar el índice de la consulta
        $resultado .= "<td>".$row['usuario']."</td>"; //o el nombre de la columna
        $resultado .= "<td>".$row['nombre']."</td>";
        $resultado .= "<td>".$row['rol']."</td>";
          $resultado .= '<td><a href="../controladores/controlador_editarU.php?id='.$row['id'].'">'.$row['id']."</a></td>"; 
          
        $resultado .= "</tr>";
        
    }
    
    mysqli_free_result($resultados); //Liberar la memoria
  
    desconectar_bd($conexion_bd);   
      
    $resultado .= "</tbody></table>";
    return $resultado;
  }

  //Crea un select con los datos de una consulta
  //@param $id: Campo en una tabla que contiene el id
  //@param $columna_descripcion: Columna de una tabla con una descripción
  //@param $tabla: La tabla a consultar en la bd
  function crear_select($id, $columna_descripcion, $tabla, $seleccion=0) {
    $conexion_bd = conectar_bd();  
      
    $resultado = '<div class="input-field"><select name="'.$tabla.'"><option value="" disabled selected>Selecciona una opción</option>';
            
    $consulta = "SELECT $id, $columna_descripcion FROM $tabla";
    $resultados = $conexion_bd->query($consulta);
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        $resultado .= '<option value="'.$row["$id"].'" ';
        if($seleccion == $row["$id"]) {
            $resultado .= 'selected';
        }
        $resultado .= '>'.$row["$columna_descripcion"].'</option>';
    }
        
    desconectar_bd($conexion_bd);
    $resultado .=  '</select><label>'.$tabla.'...</label></div>';
    return $resultado;
  }

  //función para insertar un registro de caso de coronavirus
  //@param lugar_id: id de la tabla lugar en la base de datos
  function insertar_caso($lugar_id) {
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'INSERT INTO caso (lugar_id) VALUES (?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("i", $lugar_id)) {
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

  //función para editar un registro de caso de coronavirus
  //@param caso_id: id del caso que se va a editar
  //@param lugar_id: id de la tabla lugar en la base de datos
  function editar_caso($caso_id, $lugar_id) {
    $conexion_bd = conectar_bd();
      
    //Prepara la consulta
    $dml = 'UPDATE caso SET lugar_id=(?) WHERE id=(?)';
    if ( !($statement = $conexion_bd->prepare($dml)) ) {
        die("Error: (" . $conexion_bd->errno . ") " . $conexion_bd->error);
        return 0;
    }
      
    //Unir los parámetros de la función con los parámetros de la consulta   
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param("ii", $lugar_id, $caso_id)) {
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

  //Consultar el id del lugar a partir del id de un caso
  //@param $caso_id: El id del caso
  function recuperar_lugar($caso_id) {
    $conexion_bd = conectar_bd();  
      
    $consulta = "SELECT lugar_id FROM caso WHERE id=$caso_id";
    $resultados = $conexion_bd->query($consulta);
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        desconectar_bd($conexion_bd);
        return $row["lugar_id"];
    }
        
    desconectar_bd($conexion_bd);
    return 0;
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
    $resultados = $conexion_bd->query("SELECT * from usuario");
    while ($row = mysqli_fetch_array($resultados, MYSQLI_BOTH)) {
        $resultado = $row["id"];
    }
    $id_u = $resultado;



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

?>