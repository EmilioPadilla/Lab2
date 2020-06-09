/*
  Poner siempre el drop table if exists antes de crear una tabla
  Poner primero las tablas que tienen llaves foráneas y después poner las tablas que solo tienen la llave primaria
*/

/*
-------------------------------------------------------------
--- E S T R U C T U R A  D E  L A S  T A B L A S  C M G   ---
-------------------------------------------------------------
------------------------------------------------------------
         --- ESTRUCTURA DE LAS TABLAS DE MEDICOS---
-------------------------------------------------------------
*/

-- Crear tabla Medico
DROP TABLE IF EXISTS Medico;
DROP TABLE IF EXISTS medico;
CREATE TABLE `medico` (
  `idMedico` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idEspecialidad` int(11) NOT NULL,
  `nombre` varchar(50),
  `apellido` varchar(50),
  `direccion` varchar(100),
  `telefono` char(10),
  `celular` char(10),
  `correo` varchar(50)
);
-- Crear tabla Especialidad
DROP TABLE IF EXISTS Especialidad;
DROP TABLE IF EXISTS especialidad;
CREATE TABLE `especialidad` (
  `idEspecialidad` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` char(50)
);

-- Crear tabla para ficha medica
DROP TABLE IF EXISTS genera_Ficha_Medica;
CREATE TABLE `genera_Ficha_Medica` (
  `idFichaMed` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idEmpleado` int(11) NOT NULL,
  `idBeneficiaria` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nombreDoc` varchar(80) NOT NULL,
  `medicamentos` text NOT NULL,
  `fechaSigCita` date NOT NULL
);


DROP TABLE IF EXISTS ausentismo;
CREATE TABLE `ausentismo` (
  `idEmpleado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `motivoAus` text DEFAULT NULL
);

DROP TABLE IF EXISTS vacaciones;
CREATE TABLE `vacaciones` (
  `idEmpleado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `antiguedad` int(11) NOT NULL,
  `diasVacaciones` int(11) NOT NULL,
  `fechaSalida` date NOT NULL,
  `fechaRegreso` date NOT NULL
);

DROP TABLE IF EXISTS salario;
CREATE TABLE `salario` (
  `idEmpleado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `salarioDiario` decimal(8,2) NOT NULL,
  `compensacion` decimal(8,2) NOT NULL
);

DROP TABLE IF EXISTS archivoperteneceempleado;

DROP TABLE IF EXISTS archivoempleado;
CREATE TABLE `archivoempleado` (
  `idArchivo` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idEmpleado` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `categoria` varchar(30) DEFAULT NULL,
  `pathArchivo` varchar(255) DEFAULT NULL,
  `comentarios` varchar(255) DEFAULT NULL
);

DROP TABLE IF EXISTS benef_empleado;
CREATE TABLE `benef_empleado` (
  `idBenefN` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `porcentaje` numeric(3,2) NOT NULL
);

DROP TABLE IF EXISTS beneficiarionomina;
CREATE TABLE `beneficiarionomina` (
  `idBenefN` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(50) ,
  `parentesco` varchar(50) ,
  `rfc` char(30) ,
  `direccion` varchar(100)
);


DROP TABLE IF EXISTS empleado;
CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idPuesto` int(11) NOT NULL,
  `idEstCivil` int(11) DEFAULT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'activo',
  `nombre` varchar(100) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `estadoNacimiento` varchar(50) NOT NULL,
  `curp` char(25) DEFAULT NULL,
  `rfc` char(30) DEFAULT NULL,
  `segSocial` bigint(40) DEFAULT NULL,
  `infonavit` bigint(40) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` char(10) DEFAULT NULL,
  `celular` char(10) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `fechaI` date DEFAULT NULL,
  `voluntario` tinyint(1) NOT NULL DEFAULT 0,
  `diasT` varchar(10) DEFAULT NULL,
  `horasT` time DEFAULT NULL,
  `escolaridad` varchar(70) DEFAULT NULL,
  `nBeneficiarios` int(3) DEFAULT NULL,
  `fegreso` date DEFAULT NULL,
  `motivoegreso` varchar(100) DEFAULT NULL
);


DROP TABLE IF EXISTS puesto;
CREATE TABLE `puesto` (
  `idPuesto` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(50)
);

DROP TABLE IF EXISTS estadocivil;
CREATE TABLE `estadocivil` (
  `idEstCivil` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(50) NOT NULL
);

/*
-- Crear tabla de prueba donde guardar datos de seccion
*/
DROP TABLE IF EXISTS valorar_seccion;
CREATE TABLE `valorar_seccion` (
  `id_prueba` int(10) NOT NULL COMMENT 'Categoriza las distintas pruebas de una beneficiaria',
  `id_beneficiaria` int(10) NOT NULL COMMENT 'Llave foranea de tabla beneficiaria',
  `id_seccion` int(10) NOT NULL COMMENT 'Llave foranea de tabla seccion',
  `fecha` datetime DEFAULT NULL COMMENT 'fecha de evaluación de la seccion ',
  `observacion` varchar(200) DEFAULT NULL COMMENT 'Observacion de la seccion',
  `calificacion_seccion` int(10) DEFAULT NULL COMMENT 'Calificación general calculada a partir de actividades dentro de seccion',
  `prerequisito_objetivo` varchar(300) DEFAULT NULL,
  `logro_dificultad` varchar(300) DEFAULT NULL,
  `evaluador` varchar(50) DEFAULT NULL,
  PRIMARY KEY (id_prueba, id_beneficiaria, id_seccion)
)COMMENT='Guarda datos de seccion de cada prueba de cada beneficiaria';

/*
-- Crear tabla de prueba donde guardar datos de actividades
*/
DROP TABLE IF EXISTS valorar_actividad;
CREATE TABLE `valorar_actividad` (
  `id_prueba` int(10) NOT NULL,
  `id_beneficiaria` int(10) NOT NULL,
  `id_seccion` int(10) NOT NULL,
  `id_actividad` int(10) NOT NULL,
  `fecha` datetime DEFAULT NULL COMMENT 'fecha de realización de actividad',
  `calificacion` int(10) DEFAULT NULL COMMENT '1 -> No lo logra.    2 -> En proceso.   3 -> Lo logra',
  `observacion` varchar(200) DEFAULT NULL COMMENT 'observacion a recordar de la actividad',
  PRIMARY KEY (id_prueba, id_beneficiaria, id_seccion, id_actividad)
) COMMENT='Guarda valores de las actividades de la prueba de la benefic';


/*
-- Crear tabla de banco de datos de actividades
*/
DROP TABLE IF EXISTS actividad;
CREATE TABLE `actividad` (
  `ID` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_seccion` int(10) DEFAULT NULL,
  `nombre_actividad` varchar(102) DEFAULT NULL
);

/*
-- Crear tabla de banco de datos de secciones
*/
DROP TABLE IF EXISTS seccion;
CREATE TABLE `seccion` (
  `ID` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `categoria` varchar(100)  COMMENT 'Division en la que se encuentra el area o habilidad',
  `nombre` varchar(100)  COMMENT 'Area o habilidad que contiene rubros'
);



-- Estructura de tabla para la tabla `archivosBeneficiarias`
DROP TABLE IF EXISTS archivosBeneficiarias;
CREATE TABLE `archivosBeneficiarias` (
  `idArchivo` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `categoria` varchar(30) ,
  `pathArchivo` varchar(500) ,
  `comentarios` text ,
  `idBeneficiaria` int(11) ,
  `fechaCarga` date
);
-- Estructura de tabla para la tabla `beneficiarias`
DROP TABLE IF EXISTS beneficiarias;
CREATE TABLE `beneficiarias` (
  `idBeneficiaria` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `beneficiariaActiva` tinyint(1) ,
  `nombreCompleto` varchar(50) ,
  `fechaNacimiento` date DEFAULT NULL,
  `edad` int(2) DEFAULT NULL,
  `antecedentes` text DEFAULT NULL,
  `diagnosticoInt` varchar(100) DEFAULT NULL,
  `diagnosticoMotriz` varchar(100) DEFAULT NULL,
  `edadMental` int(2) DEFAULT NULL,
  `fechaIngreso` date DEFAULT NULL,
  `idMotivoIngreso` int(11) NOT NULL,
  `otroMotivoIngreso` varchar(150) DEFAULT NULL,
  `nombreCanalizador` varchar(100) DEFAULT NULL,
  `consideracionesIngreso` text DEFAULT NULL,
  `vinculosFam` varchar(50) DEFAULT NULL,
  `convivencias` text DEFAULT NULL,
  `tutela` varchar(50) DEFAULT NULL,
  `situacionJuridica` varchar(150) DEFAULT NULL,
  `idEscolaridad` int(11) DEFAULT NULL,
  `gradoEscolar` varchar(15) DEFAULT NULL,
  `fechaEgreso` date DEFAULT NULL,
  `idMotivoEgreso` int(11) DEFAULT NULL,
  `otroMotivoEgreso` varchar(150) DEFAULT NULL,
  `consideracionesEgreso` text DEFAULT NULL,
  `idDestino` int(11) DEFAULT NULL,
  `especificacionesDestino` text DEFAULT NULL,
  `nombreReceptor` varchar(50) DEFAULT NULL,
  `logros` text DEFAULT NULL,
  `motivoReingreso` text DEFAULT NULL
);

-- Estructura de tabla para la tabla `destinos`
DROP TABLE IF EXISTS destinos;
CREATE TABLE `destinos` (
  `idDestino` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombreDestino` varchar(50)
);

-- Estructura de tabla para la tabla `escolaridad`
DROP TABLE IF EXISTS escolaridad;
CREATE TABLE `escolaridad` (
  `idEscolaridad` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nivelEscolar` varchar(15)
);

-- Estructura de tabla para la tabla `motivosEgreso`
DROP TABLE IF EXISTS motivosEgreso;
CREATE TABLE `motivosEgreso` (
  `idMotivoEgreso` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `motivoEgreso` varchar(50)
);

-- Estructura de tabla para la tabla `motivosIngreso`
DROP TABLE IF EXISTS motivosIngreso;
CREATE TABLE `motivosIngreso` (
  `idMotivoIngreso` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `motivoIngreso` varchar(50)
);


-- Table structure for table `donante_tipoDonante`
DROP TABLE IF EXISTS donante_tipoDonante;

-- Table structure for table `contactoDonante`
--
DROP TABLE IF EXISTS contactoDonante;
CREATE TABLE `contactoDonante` (
  `idContacto` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idDonante` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `telefono` char(20) DEFAULT NULL,
  `extension` int(10) DEFAULT NULL,
  `celular` char(20) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL
);

-- Table structure for table `donacion`
DROP TABLE IF EXISTS donacion;
CREATE TABLE `donacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_donante` int(11) NOT NULL,
  `tipoDonacion` char(50) DEFAULT NULL,
  `valor` int(11) NOT NULL,
  `medioPago` char(50) NOT NULL,
  `descripcion` char(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ;


-- tabla donante
DROP TABLE IF EXISTS donantes;

CREATE TABLE `donantes` (
  `idDonante` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idTipo` int(11) NOT NULL,
  `fechaRegistro` datetime DEFAULT current_timestamp(),
  `contactoInterno` text DEFAULT NULL,
  `nombreDonante` varchar(50) DEFAULT NULL,
  `correoParticular` varchar(200) DEFAULT NULL,
  `telefonoParticular` char(20) DEFAULT NULL,
  `extensionParticular` int(10) DEFAULT NULL,
  `celularParticular` char(20) DEFAULT NULL,
  `fechaNacParticular` date DEFAULT NULL,
  `razonSocial` char(100) DEFAULT NULL,
  `RFCEntidad` varchar(50) DEFAULT NULL,
  `direccionEntidad` char(200) DEFAULT NULL,
  `cpEntidad` varchar(50) DEFAULT NULL,
  `fechaFinDonaciones` date DEFAULT NULL,
  `motivoFinDonaciones` text DEFAULT NULL
);

-- tabla TipodeDonante
DROP TABLE IF EXISTS tipodeDonante;
CREATE TABLE `tipodeDonante` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` char(50) DEFAULT NULL
);


-- Table structure for table `desempenia`
DROP TABLE IF EXISTS desempenia;
CREATE TABLE `desempenia` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table structure for table `obtiene`
DROP TABLE IF EXISTS obtiene;
CREATE TABLE `obtiene` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `rol_id` int(11) NOT NULL,
  `privilegio_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
);

-- Table structure for table `privilegio`
DROP TABLE IF EXISTS privilegio;
CREATE TABLE `privilegio` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
);

-- Table structure for table `rol`
DROP TABLE IF EXISTS rol;
CREATE TABLE `rol` (
  `id` int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(80) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table structure for table `usuario`
DROP TABLE IF EXISTS usuario;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





-- Crear tabla plantillaReporte
DROP TABLE IF EXISTS plantillaReporte;
CREATE TABLE `plantillaReporte` (
  `idPlantilla` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` char(50),
  `tipoGrafica` int(11),
  `query` text
);
/*
-------------------------------------------------------------
     --- L L A V E S  D E  L A S  T A B L A S  C M G   ---
-------------------------------------------------------------
*/

-- Llaves de Medico
ALTER TABLE `medico`
  ADD KEY `idEspecialidad` (`idEspecialidad`);

ALTER TABLE `genera_Ficha_Medica`
  ADD KEY `idEmpleado` (`idEmpleado`),
  ADD KEY `idBeneficiaria` (`idBeneficiaria`);

ALTER TABLE `archivoempleado`
  ADD KEY `idEmpleado` (`idEmpleado`);

ALTER TABLE `ausentismo`
  ADD PRIMARY KEY (`fecha`),
  ADD KEY `idEmpleado` (`idEmpleado`);

ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`fecha`),
  ADD KEY `idEmpleado` (`idEmpleado`);

ALTER TABLE `salario`
  ADD PRIMARY KEY (`fecha`),
  ADD KEY `idEmpleado` (`idEmpleado`);

ALTER TABLE `benef_empleado`
  ADD KEY `idBenefN` (`idBenefN`),
  ADD KEY `idEmpleado` (`idEmpleado`);

ALTER TABLE `empleado`
  ADD KEY `idPuesto` (`idPuesto`),
  ADD KEY `idEstCivil` (`idEstCivil`);


-- Indices de la tabla `archivosBeneficiarias`
ALTER TABLE `archivosBeneficiarias`
  ADD KEY `idBeneficiaria` (`idBeneficiaria`);

-- Indices de la tabla `beneficiarias`
ALTER TABLE `beneficiarias`
  ADD KEY `idMotivoIngreso` (`idMotivoIngreso`),
  ADD KEY `idEscolaridad` (`idEscolaridad`),
  ADD KEY `idMotivoEgreso` (`idMotivoEgreso`),
  ADD KEY `idDestino` (`idDestino`);




ALTER TABLE `actividad`
  ADD KEY `id_seccion` (`id_seccion`);


ALTER TABLE `valorar_actividad`
  MODIFY `id_prueba` int(10) NOT NULL COMMENT 'Categoriza las distintas pruebas de una beneficiaria',
  ADD KEY `id_actividad` (`id_actividad`),
  ADD KEY `id_seccion` (`id_seccion`),
  ADD KEY `id_beneficiaria` (`id_beneficiaria`);


ALTER TABLE `valorar_seccion`
  MODIFY `id_prueba` int(10) NOT NULL COMMENT 'Categoriza las distintas pruebas de una beneficiaria',
  ADD KEY `id_seccion` (`id_seccion`),
  ADD KEY `id_beneficiaria` (`id_beneficiaria`);



-- Indexes for table `Donantes`
ALTER TABLE `donantes`
  ADD KEY `idTipo` (`idTipo`);

-- Indexes for table `contactoDonante`
ALTER TABLE `contactoDonante`
  ADD KEY `idDonante` (`idDonante`);

-- Indexes for table `donacion`
ALTER TABLE `donacion`
  ADD KEY `id_donante` (`id_donante`),
  ADD KEY `tipoDonacion` (`tipoDonacion`);

-- Indexes for table `desempenia`
ALTER TABLE `desempenia`
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indexes for table `obtiene`
ALTER TABLE `obtiene`
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `privilegio_id` (`privilegio_id`);
--



/*
-------------------------------------------------------------
--- C O N S T R A I N T S  D E  L A S  T A B L A S  C M G ---
-------------------------------------------------------------
*/

-- Constraints de relaciones de Medico
ALTER TABLE `medico`
  ADD CONSTRAINT `Medico_ibfk_1` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidad` (`idEspecialidad`) ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `genera_Ficha_Medica`
  ADD CONSTRAINT `genera_Ficha_Medica_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `genera_Ficha_Medica_ibfk_2` FOREIGN KEY (`idBeneficiaria`) REFERENCES `beneficiarias` (`idBeneficiaria`) ON UPDATE CASCADE;
  COMMIT;


ALTER TABLE `archivoempleado`
  ADD CONSTRAINT `archivoempleado_ibfk_2` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON UPDATE CASCADE;
  COMMIT;

ALTER TABLE `ausentismo`
  ADD CONSTRAINT `ausentismo_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON UPDATE CASCADE;

ALTER TABLE `salario`
  ADD CONSTRAINT `salario_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `vacaciones`
  ADD CONSTRAINT `vacaciones_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `benef_empleado`
--
ALTER TABLE `benef_empleado`
  ADD CONSTRAINT `benef_empleado_ibfk_1` FOREIGN KEY (`idBenefN`) REFERENCES `beneficiarionomina` (`idBenefN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `benef_empleado_ibfk_2` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON UPDATE CASCADE;
COMMIT;
--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`idPuesto`) REFERENCES `puesto` (`idPuesto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`idEstCivil`) REFERENCES `estadocivil` (`idEstCivil`) ON UPDATE CASCADE;
COMMIT;

-- Constraints for table `donacion`
ALTER TABLE `donacion`
  ADD CONSTRAINT `donacion_ibfk_1` FOREIGN KEY (`id_donante`) REFERENCES `donantes` (`idDonante`) ON UPDATE CASCADE;
COMMIT;

-- Constraints for table `contactoDonante`
ALTER TABLE `contactoDonante`
  ADD CONSTRAINT `contactoDonante_ibfk_1` FOREIGN KEY (`idDonante`) REFERENCES `donantes` (`idDonante`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

-- Constraints for table `donantes`
ALTER TABLE `donantes`
  ADD CONSTRAINT `donantes_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `tipodeDonante` (`idTipo`) ON UPDATE CASCADE;
COMMIT;

-- Constraints de Pruebas
ALTER TABLE `valorar_actividad`
  ADD CONSTRAINT `valorar_actividad_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `valorar_actividad_ibfk_2` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `valorar_actividad_ibfk_3` FOREIGN KEY (`id_beneficiaria`) REFERENCES `beneficiarias` (`idBeneficiaria`) ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `valorar_seccion`
  ADD CONSTRAINT `valorar_seccion_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `valorar_seccion_ibfk_2` FOREIGN KEY (`id_beneficiaria`) REFERENCES `beneficiarias` (`idBeneficiaria`) ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`ID`) ON UPDATE CASCADE;
COMMIT;


-- Filtros para la tabla `archivosBeneficiarias`
ALTER TABLE `archivosBeneficiarias`
  ADD CONSTRAINT `archivosBeneficiarias_ibfk_1` FOREIGN KEY (`idBeneficiaria`) REFERENCES `beneficiarias` (`idBeneficiaria`) ON UPDATE CASCADE;
COMMIT;
-- Filtros para la tabla `beneficiarias`
ALTER TABLE `beneficiarias`
  ADD CONSTRAINT `beneficiarias_ibfk_1` FOREIGN KEY (`idDestino`) REFERENCES `destinos` (`idDestino`),
  ADD CONSTRAINT `beneficiarias_ibfk_2` FOREIGN KEY (`idMotivoIngreso`) REFERENCES `motivosIngreso` (`idMotivoIngreso`),
  ADD CONSTRAINT `beneficiarias_ibfk_3` FOREIGN KEY (`idMotivoEgreso`) REFERENCES `motivosEgreso` (`idMotivoEgreso`),
  ADD CONSTRAINT `beneficiarias_ibfk_4` FOREIGN KEY (`idEscolaridad`) REFERENCES `escolaridad` (`idEscolaridad`);
COMMIT;

-- Constraints for table `desempenia`
ALTER TABLE `desempenia`
  ADD CONSTRAINT `desempenia_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `desempenia_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON UPDATE CASCADE;
COMMIT;
-- Constraints for table `obtiene`
ALTER TABLE `obtiene`
  ADD CONSTRAINT `obtiene_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `obtiene_ibfk_2` FOREIGN KEY (`privilegio_id`) REFERENCES `privilegio` (`id`) ON UPDATE CASCADE;
COMMIT;
/*
-------------------------------------------------------------
--- C A R G A  D E  D A T O S  A  T A B L A S  C M G ---
-------------------------------------------------------------
*/


  /*
  CARGAR DATOS A SECCION
  */

  INSERT INTO `seccion` (`ID`, `categoria`, `nombre`) VALUES
  (1, ' Área Motora', 'Recién nacido'),
  (2, 'Área Motora', '3-4 meses'),
  (3, 'Área Motora', '4-5 meses'),
  (4, 'Área Motora', '6 meses'),
  (5, 'Área Motora', '7-8 meses'),
  (6, 'Área Motora', '9 meses'),
  (7, 'Área Motora', '10-11 meses'),
  (8, 'Área Motora', '12 meses'),
  (9, 'Área Motora', '3 años'),
  (10, 'Áreas Académicas Funcionales y de Comunicación.', 'Atención Visual'),
  (11, 'Áreas Académicas Funcionales y de Comunicación.', 'Atención Auditiva'),
  (12, 'Áreas Académicas Funcionales y de Comunicación.', 'Cavidad Orofacial'),
  (13, 'Áreas Académicas Funcionales y de Comunicación.', 'Esquema Corporal'),
  (14, 'Áreas Académicas Funcionales y de Comunicación.', 'Lenguaje comprensivo'),
  (15, 'Áreas Académicas Funcionales y de Comunicación.', 'Comunicación'),
  (16, 'Áreas Académicas Funcionales y de Comunicación.', 'Imitación'),
  (17, 'Áreas Académicas Funcionales y de Comunicación.', 'Sigue Instrucciones'),
  (18, 'Áreas Académicas Funcionales y de Comunicación.', 'Precursor Numérico'),
  (19, 'Área Social', 'Preoperacional Temprana'),
  (20, 'Habilidades Académicas Funcionales', 'Sensopercepcion'),
  (21, 'Habilidades Académicas Funcionales', 'Discriminacion de Formas'),
  (22, 'Habilidades Académicas Funcionales', 'Nociones temporo-espaciales'),
  (23, 'Habilidades Académicas Funcionales', 'Lateralidad'),
  (24, 'Habilidades Académicas Funcionales', 'Memoria Auditiva'),
  (25, 'Habilidades Académicas Funcionales', 'Memoria Visual'),
  (26, 'Habilidades Académicas Funcionales', 'Prenumérico'),
  (27, 'Habilidades Académicas Funcionales', 'Esquema Corporal'),
  (28, 'Habilidades Académicas Funcionales', 'Escritura'),
  (29, 'Habilidades Académicas Funcionales', 'Lectura'),
  (30, 'Habilidades Académicas Funcionales', 'Calculo'),
  (31, 'Habilidades de Comunicación', 'Comunicación'),
  (32, 'Habilidades Sociales', 'Preoperacional Tardía'),
  (33, 'Habilidades Sociales', 'Operaciones Concretas'),
  (34, 'Habilidades Sociales', 'Operaciones Formales'),
  (35, 'Habilidades Sociales', 'Operaciones Formales Avanzadas'),
  (36, 'Habilidades de Autocuidado', 'Comida'),
  (37, 'Habilidades de Autocuidado', 'Vestido'),
  (38, 'Habilidades de Autocuidado', 'Higiene'),
  (39, 'Habilidades de Vida en el Hogar', 'Ropa'),
  (40, 'Habilidades de Vida en el Hogar', 'Alimento'),
  (41, 'Habilidades de Vida en el Hogar', 'Higiene'),
  (42, 'Habilidades de Vida en el Hogar', 'General'),
  (43, 'Habilidades de Autodirección', 'Autodirección'),
  (44, 'Habilidades de Uso de Recursos de la Comunidad', 'Uso de Recursos de la Comunidad'),
  (45, 'Habilidades de Ocio y Tiempo Libre', 'Ocio y Tiempo Libre'),
  (46, 'Habilidades de Trabajo', 'Trabajo'),
  (47, 'Habilidades de Salud y Seguridad', 'Salud y Seguridad');


  /*
  CARGAR DATOS A ACTIVIDAD
  */

  INSERT INTO `actividad` (`ID`, `id_seccion`, `nombre_actividad`) VALUES
  (1, 1, ' Posición de acostado inestable.'),
  (2, 1, 'Mantiene las piernas y los brazos en flexión'),
  (3, 1, 'Espalda redondeada'),
  (4, 1, 'La cara la mantiene dirigida hacia un lado'),
  (5, 1, 'Manos empuñadas con el pulgar atrapado'),
  (6, 1, 'Al moverle su cabeza o su cuerpo se modifica'),
  (7, 1, 'Mínimo movimiento'),
  (8, 2, 'Posición estable de acostado'),
  (9, 2, 'Disminucion del tono muscular de brazos y piernas'),
  (10, 2, 'Espalda alineada y recta'),
  (11, 2, 'Gira la cabeza libremente'),
  (12, 2, 'Dirige sus movimientos hacia el objeto que se le muestra.'),
  (13, 2, 'Inicia el contacto entre las plantas de los pies'),
  (14, 2, 'Inicia el volteo'),
  (15, 3, 'Apoya codos y eleva la cabeza en la línea media o (acostado boca abajo)'),
  (16, 3, 'Modifica constantemente su postura por interés visual'),
  (17, 3, 'Sigue la trayectoria del objeto con la mano sin cruzar línea media'),
  (18, 3, 'Apoya codo y muslo del lado contrario al que ve'),
  (19, 3, 'Intenta elevar el brazo del lado de la cara o apoyándose en el contrario.'),
  (20, 3, 'Realiza movimientos  natatorios al tratar de alcanzar un objeto.'),
  (21, 3, 'Comienza el rodado'),
  (22, 4, 'Se mantiene muy estable en posición de acostado.'),
  (23, 4, 'Eleva brazos llevándolos a la línea media o siendo sus movimientos mas dirigidos hacia lo que desea'),
  (24, 4, 'Empieza a desarrollar la prensión'),
  (25, 4, 'Logra el rodado ágil'),
  (26, 5, 'Se mantiene estable acostado de lado'),
  (27, 5, 'Consigue la posición de sentado'),
  (28, 5, 'Se sienta de lado liberando la mano contraria'),
  (29, 5, 'Realiza pinza fina o flexionando los últimos dedos'),
  (30, 5, 'Se arrastra sin usar piernas'),
  (31, 5, 'Se arrastra con brazos y piernas'),
  (32, 5, 'Gatea incoordinadamente o se sienta  y continúa'),
  (33, 6, 'Gatea coordinadamente'),
  (34, 6, 'Logra pararse'),
  (35, 7, 'Se para de manera  más estable'),
  (36, 7, 'Logra la marcha lateral'),
  (37, 7, 'Se agarra con una mano y con la otra toma objetos (al estar de pie)'),
  (38, 8, 'Da sus primeros pasos sólo cambiando de un mueble a otro.'),
  (39, 8, 'Camina independientemente'),
  (40, 8, 'Arrastra y/o empuja objetos'),
  (41, 9, 'Mantiene su columna bien alineada y con curvatura en la zona de la cintura.'),
  (42, 9, 'Apoya su peso formando arco del pie.'),
  (43, 9, 'Realiza movimientos más complejos de antebrazos (destapa botes o carga o etc.)'),
  (44, 9, 'Se para en un pie o con un grado de equilibrio mayor permitiendo una descarga de peso adecuada'),
  (45, 9, 'Inicia el brincado'),
  (46, 9, 'Realiza marcha adelante o atrás y lateral con precisión.'),
  (47, 10, 'Sigue objetos en movimiento'),
  (48, 10, 'Atiende objetos próximos y distantes'),
  (49, 10, 'Busca el objeto perdido'),
  (50, 11, 'Responde a un estímulo sonoro'),
  (51, 11, 'Busca la fuente sonora'),
  (52, 12, 'Presenta disociación d labio'),
  (53, 12, 'Presenta disociación de lengua'),
  (54, 12, 'Presenta disociación d mandíbula'),
  (55, 13, 'Reconoce cabeza'),
  (56, 13, 'Reconoce brazos'),
  (57, 13, 'Reconoce manos'),
  (58, 13, 'Reconoce piernas'),
  (59, 13, 'Reconoce pies'),
  (60, 13, 'Reconoce ojos'),
  (61, 13, 'Reconoce boca'),
  (62, 14, 'Discrimina sonidos del medio ambiente.'),
  (63, 14, 'Sigue órdenes de un comando'),
  (64, 14, 'Sigue órdenes de dos comandos'),
  (65, 15, 'Expresa placer-displacer'),
  (66, 15, 'Maneja código elemental de comunicación o  (si-no).'),
  (67, 15, 'Presenta patrón básico de respuesta en palabra hablada'),
  (68, 15, 'Presenta patrón básico de respuesta en palabra escrita'),
  (69, 15, 'Presenta patrón básico de respuesta en movimiento de cabeza'),
  (70, 15, 'Presenta patrón básico de respuesta en movimiento de brazos o manos'),
  (71, 15, 'Presenta patrón básico de respuesta en movimientos de piernas o pies'),
  (72, 15, 'Presenta patrón básico de respuesta en movimientos oculares'),
  (73, 15, 'Repite vocales y sílabas simples: a-e-i-o-u pa-ca-la-el-li-up-co-es-si-me-im-be-ib'),
  (74, 15, 'Repite sílabas complejas:bra-glo-tre-dru-blo-afa-puen-cuan-guen'),
  (75, 15, 'Repite palabras: gallina-bolsa-cuento-ventana-peso-casa-semáforo'),
  (76, 15, 'Elabora frases con cualquier sistema de comunicación'),
  (77, 15, 'Es capaz de elaborar respuestas utilizando frases simples: sujeto -verbo'),
  (78, 16, 'Imita de manera voluntaria movimientos'),
  (79, 16, 'Imita movimientos en forma diferida.'),
  (80, 17, 'Sigue órdenes de tres comandos'),
  (81, 18, 'Tiene concepto de  mucho-poco'),
  (82, 18, 'Ordena'),
  (83, 19, 'Fija y mantiene la mirada con el interlocutor.'),
  (84, 19, 'Sonrisa social  (3 meses de edad)'),
  (85, 19, 'Reconoce su imagen en el espejo (8 meses)'),
  (86, 19, 'Reconoce y responde a las voces familiares'),
  (87, 19, 'Reconoce o identifica a la madre o figura sustituta  (8-9 meses)'),
  (88, 19, 'Uso del  \"no\" indiscriminado'),
  (89, 19, 'Uso del  \"no\" adecuado'),
  (90, 19, 'Tiene conciencia de propiedad'),
  (91, 19, 'Puede estar con una persona conocida como el maestro o tíos o amigos de la familia o etc.'),
  (92, 19, 'Participa en la elección de sus alimentos o prendas de vestir y juguetes.'),
  (93, 20, 'Discrimina colores primarios: rojo o azul o amarillo'),
  (94, 20, 'Discrimina colores secundarios: naranja o verde o morado.'),
  (95, 20, 'Discrimina otros colores:  blanco o negro rosa o café'),
  (96, 21, 'Discrimina formas geométricas básicas: círculo o cuadrado o triángulo y rectángulo.'),
  (97, 22, 'Identifica día-noche'),
  (98, 22, 'Identifica ayer-hoy-mañana'),
  (99, 22, 'Conoce días de la semana'),
  (100, 22, 'Conoce meses del año'),
  (101, 22, 'Diferencia: arriba - abajo'),
  (102, 22, 'Diferencia: atrás - adelante'),
  (103, 23, 'Idenfica derecha e izquierda'),
  (104, 23, 'Identifica patrón cruzado'),
  (105, 23, 'Identifica derecha e izquierda en objetos'),
  (106, 24, 'Recuerda sonidos diferentes 1 o 2 o 3'),
  (107, 24, 'Recuerda secuencias de sonidos diferentes 2 o 3.'),
  (108, 25, 'Recuerda estímulos visuales 1 o 2 o 3'),
  (109, 25, 'Recuerda secuencias de estímulos visuales    2 o 3.'),
  (110, 26, 'Identifica grande o chico'),
  (111, 26, 'Identifica largo o corto'),
  (112, 26, 'Identifica lleno o vacío'),
  (113, 26, 'Puede hacer relación 1 a 1'),
  (114, 26, 'Puede clasificar'),
  (115, 26, 'Maneja concepto numérico'),
  (116, 27, 'Identifica partes finas como orejas'),
  (117, 27, 'Identifica partes finas como nariz'),
  (118, 27, 'Identifica partes finas como cejas'),
  (119, 27, 'Identifica partes finas como pestañas'),
  (120, 27, 'Identifica partes finas como dientes'),
  (121, 27, 'Identifica partes finas como codo'),
  (122, 27, 'Identifica partes finas muñeca'),
  (123, 27, 'Identifica partes finas como tobillo'),
  (124, 28, 'Respeta espacios gráficos.'),
  (125, 28, 'Reconoce vocales mayúsculas y minúsculas.'),
  (126, 28, 'Reconoce consonantes mayúsculas y minúsculas.'),
  (127, 28, 'Reconoce su nombre escrito.'),
  (128, 28, 'Escribe su nombre'),
  (129, 28, 'Escribe enunciados'),
  (130, 28, 'Escribe al dictado'),
  (131, 29, 'Lee sílabas'),
  (132, 29, 'Lee palabras'),
  (133, 29, 'Lee frases'),
  (134, 29, 'Comprende frases que él lee.'),
  (135, 29, 'Comprende textos que él lee.'),
  (136, 30, 'Realiza conteo'),
  (137, 30, 'Reconoce números anteriores y posteriores'),
  (138, 30, 'Tiene concepto de unidad'),
  (139, 30, 'Tiene concepto de decena'),
  (140, 30, 'Tiene concepto de centena'),
  (141, 30, 'Tiene concepto de unidad de millar'),
  (142, 30, 'Tiene concepto de decenas de millar'),
  (143, 30, 'Tiene concepto de centenas de millar'),
  (144, 30, 'Realiza secuencia numérica escrita.'),
  (145, 30, 'Resuelve sumas sencillas con unidades'),
  (146, 30, 'Resuelve sumas sencillas con decenas'),
  (147, 30, 'Resuelve sumas sencillas con centenas'),
  (148, 30, 'Resuelve restas sencillas con unidades'),
  (149, 30, 'Resuelve restas sencillas con decenas'),
  (150, 30, 'Resuelve restas sencillas con centenas'),
  (151, 30, 'Resuelve multiplicaciones con multiplicador de una cifra'),
  (152, 30, 'Resuelve multiplicaciones con multiplicador de dos cifras'),
  (153, 30, 'Resuelve multiplicaciones con multiplicador de tres cifras'),
  (154, 30, 'Resuelve divisiones con el divisor de una cifra'),
  (155, 30, 'Resuelve divisiones con el divisor de dos cifras'),
  (156, 30, 'Resuelve divisiones con el divisor de tres cifras'),
  (157, 30, 'Resuelve problemas sencillos de suma y resta'),
  (158, 30, 'Usa calculadora'),
  (159, 31, 'Repite palabras con sílabas trabadas o compuestas.'),
  (160, 31, 'Elabora frases complejas (utilizando cualquier sistema de comunicación)'),
  (161, 31, 'Elabora narraciones cortas de manera espontánea.'),
  (162, 31, 'Reconoce bromas o absurdos (Tomado de Terman - Merril)'),
  (163, 31, 'El perro vuela'),
  (164, 31, 'Los árboles hablan'),
  (165, 31, 'Un hombre tuvo gripa 2 veces; la primera se murió y la segunda se curó rápido *'),
  (166, 31, 'Cuando iba a la escuela me comí mi torta porque no tenía hambre*'),
  (167, 31, 'Utiliza sistemas alterativos de comunicación como lenguaje de señas'),
  (168, 31, 'Utiliza sistemas alterativos de comunicación como braille'),
  (169, 31, 'Utiliza sistemas alterativos de comunicación como tablero de comunicación manual'),
  (170, 31, 'Utiliza sistemas alterativos de comunicación como tablero de comunicación computarizado.'),
  (171, 32, 'Es sociable'),
  (172, 32, 'Participa e interactúa con personas tanto con hombres como mujeres de su edad  (sentido del grupo)'),
  (173, 33, 'Sigue reglas y tiene tolerancia a la frustración en el juego.'),
  (174, 33, 'Demuestra valores en sus relaciones (solidario y cooperador)'),
  (175, 33, 'Reconoce y corrige un error / pide disculpas'),
  (176, 33, 'Reconoce consecuencias de sus actos'),
  (177, 33, 'Respeta objetos que no le pertenecen'),
  (178, 34, 'Con los hermanos manifiesta conductas de afecto (abrazar o besar o etc.)'),
  (179, 34, 'Con los hermanos platica con ellos'),
  (180, 34, 'Con los hermanos realiza actividades con ellos'),
  (181, 34, 'Con los padres manifiesta conductas de afecto (abrazar o besar o etc.)'),
  (182, 34, 'Con los padres platica con ellos'),
  (183, 34, 'Con los padres realiza actividades con ellos'),
  (184, 34, 'Tiene un grupo de amistades fuera de la escuela'),
  (185, 34, 'Presenta pautas sociales de comunicación (gracias o por favor o con permiso o saludo)'),
  (186, 34, 'Realiza un festejo de cumpleaños de acuerdo a su edad: en casa o en CMG'),
  (187, 34, 'Reconoce y acepta sus defectos y cualidades'),
  (188, 34, 'En el nucelo familiar reconoce quiénes integran su familia o y se observa sí él se incluye como parte.'),
  (189, 34, 'En el grupo social tiene un grupo social de amigos o en la escuela u otros lugares.'),
  (190, 34, 'Actúa de acuerdo a su propio criterio (autodeterminación)'),
  (191, 34, 'Soluciona problemas cotidianos'),
  (192, 34, 'Asiste a fiestas con jóvenes de su edad'),
  (193, 35, 'Tiene conciencia de género'),
  (194, 35, 'Maneja higiene sexual: asea genitales'),
  (195, 35, 'Maneja higiene sexual: usa métodos anticonceptivos / preservativos.'),
  (196, 35, 'Sigue la reglas familiares'),
  (197, 35, 'Maneja sus emociones'),
  (198, 35, 'Expresa sus acuerdos y desacuerdos tomando en cuenta lo que él quiere.'),
  (199, 35, 'Asume con responsabilidad las consecuencias de sus actos'),
  (200, 35, 'Expresa de manera clara sus ideas y actua de acuerdo a ellas'),
  (201, 35, 'Expresa de manera clara sus ideas y escucha las ideas de otros aunque no esté de acuerdo con ellas.'),
  (202, 36, 'Come con la mano'),
  (203, 36, 'Bebe con vaso / taza'),
  (204, 36, 'Utiliza cubiertos'),
  (205, 36, 'Pone y retira la mesa para sí mismo'),
  (206, 36, 'Sacude migajas / limpia líquidos o comida derramada.'),
  (207, 36, 'Saca alimentos de la despensa o del refrigerador.'),
  (208, 36, 'Prepara alimentos para sí fríos'),
  (209, 36, 'Prepara alimentos para sí calientes'),
  (210, 37, 'Quita ropa de la parte inferior'),
  (211, 37, 'Quita ropa de la parte superior'),
  (212, 37, 'Pone ropa de la parte superior'),
  (213, 37, 'Pone ropa de la parte inferior'),
  (214, 37, 'Abotona/acordona/cierres/broches'),
  (215, 37, 'Elige su ropa según el clima'),
  (216, 38, 'Avisa si ensució sus pañales'),
  (217, 38, 'Controla esfínteres/babeo'),
  (218, 38, 'Utiliza correctamente el WC'),
  (219, 38, 'Realiza higiene personal'),
  (220, 38, 'Se baña /lava su pelo'),
  (221, 38, 'Se maquilla/rasura'),
  (222, 38, 'Conoce los cuidados específicos de distintas partes de su cuerpo'),
  (223, 39, 'Reconoce ropa limpia y sucia'),
  (224, 39, 'Lava a mano/ a máquina'),
  (225, 39, 'Tiende/plancha/guarda la ropa'),
  (226, 39, 'Repara la ropa'),
  (227, 39, 'Compra su propia ropa (negocio/catálogo)'),
  (228, 40, 'Guarda en alacena/ refrigerador/ estantes'),
  (229, 40, 'Realiza recetas sencillas.'),
  (230, 40, 'Usa distintos modos de cocción'),
  (231, 40, 'Reconoce el buen estado de los alimentos'),
  (232, 40, 'Puede balancear su dieta'),
  (233, 40, 'Realiza lista de faltantes / compras'),
  (234, 41, 'Barre/trapea/sacude'),
  (235, 41, 'Tiende cama'),
  (236, 41, 'Lava y ordena trastes'),
  (237, 41, 'Lava ventanas'),
  (238, 41, 'Ordena closet'),
  (239, 41, 'Saca la basura'),
  (240, 42, 'Utiliza el teléfono de casa'),
  (241, 42, 'Utiliza el teléfono público'),
  (242, 42, 'Utiliza el teléfono celular'),
  (243, 42, 'Utiliza artefactos eléctricos/ computadora'),
  (244, 42, 'En situaciones de riesgo reconoce'),
  (245, 42, 'En situaciones de riesgo soluciona'),
  (246, 42, 'Cambia focos / destapa drenajes.'),
  (247, 42, 'Realiza pasajes de silla de ruedas a la cama o baño  o etc.'),
  (248, 43, 'Tiene en su casa alguna responsabilidad'),
  (249, 43, 'Sabe cuales son sus actividades'),
  (250, 43, 'Conoce su dirección particular'),
  (251, 43, 'Reconoce horarios y fechas'),
  (252, 43, 'Conoce el uso del reloj'),
  (253, 43, 'Regula tiempos y puntualidad'),
  (254, 43, 'Avisa en caso de retrasos.'),
  (255, 43, 'Conoce su agenda semanal'),
  (256, 43, 'Administra su medicación.'),
  (257, 43, 'Conoce-recuerda fechas familiares'),
  (258, 43, 'Realiza recorridos habituales'),
  (259, 43, 'Planifica sus actividades de ocio'),
  (260, 43, 'Organiza sus reuniones o salidas'),
  (261, 44, 'Utiliza dinero sin noción de valor'),
  (262, 44, 'Sabe marcar teléfonos de emergencia'),
  (263, 44, 'Reconoce trayectos habituales cercanos (dentro de su colonia)'),
  (264, 44, 'Reconoce trayectos habituales lejanos (fuera de su colonia)'),
  (265, 44, 'Se traslada a lugares cercanos / lejanos'),
  (266, 44, 'Utiliza medios de transporte'),
  (267, 44, 'Conoce trayectos alternativos a los medios habituales'),
  (268, 44, 'Reconoce centros de salud más cercanos'),
  (269, 44, 'Sabe solicitar consulta médica'),
  (270, 44, 'Identifica-previene situaciones de riesgo'),
  (271, 44, 'Reconoce señalizaciones'),
  (272, 44, 'Participa en actividades comunitarias'),
  (273, 44, 'Conoce recursos y servicios de su comunidad'),
  (274, 45, 'Participa en juegos tradicionales'),
  (275, 45, 'Participa en juegos de mesa'),
  (276, 45, 'Realiza actividades preferidas en el hogar'),
  (277, 45, 'Realiza actividades preferidas en el exterior'),
  (278, 45, 'Realiza deportes'),
  (279, 45, 'Conoce la actualidad de su ciudad/país'),
  (280, 46, 'Cuida materiales de trabajo'),
  (281, 46, 'Cuida su aseo y aliño personal'),
  (282, 46, 'Mantiene orden en su ámbito laboral'),
  (283, 46, 'Acepta indicaciones'),
  (284, 46, 'Cumple normas de trabajo'),
  (285, 46, 'Recuerda/respeta secuencias'),
  (286, 46, 'Presenta resistencia a la fatiga'),
  (287, 46, 'Se ajusta a las exigencias del trabajo'),
  (288, 46, 'Presenta las habilidades sociales necesarias con los compañeros'),
  (289, 46, 'Presenta las habilidades sociales necesarias con los superiores'),
  (290, 46, 'Respeta horarios'),
  (291, 46, 'Avisa inasistencias'),
  (292, 46, 'Solicita autorizaciones'),
  (293, 46, 'Soluciona acertadamente situaciones problemáticas'),
  (294, 46, 'Reconoce/previene riesgos laborales'),
  (295, 46, 'Se traslada de manera independiente'),
  (296, 46, 'Porta y conoce uso de la identificación.'),
  (297, 47, 'Presenta reacciones instintivas ante el peligro'),
  (298, 47, 'Expresa sensaciones de malestar'),
  (299, 47, 'Identifica tipos de malestar'),
  (300, 47, 'Identifica situaciones de peligro y los evita'),
  (301, 47, 'Denuncia las agresiones que sufre'),
  (302, 47, 'Identifica horario de administración de sus medicamentos'),
  (303, 47, 'Templa el agua para bañarse'),
  (304, 47, 'Dice no a propuestas inconvenientes'),
  (305, 47, 'Reconoce alimentos en mal estado'),
  (306, 47, 'Anticipa situaciones de riesgo'),
  (307, 47, 'Lee fechas de vencimiento de medicamento y alimentos');

-- Volcado de datos para la tabla `destinos`
INSERT INTO `destinos` (`idDestino`, `nombreDestino`) VALUES
(1, 'Familia'),
(2, 'Casa Hogar Kolbe'),
(3, 'Casa Hogar Salvador Rivera Garcia'),
(4, 'DIF Estatal Queretaro'),
(5, 'San Juan del Rio'),
(6, 'Madre'),
(7, 'Otro'),
(8, 'No existe info');

-- Volcado de datos para la tabla `escolaridad`
INSERT INTO `escolaridad` (`idEscolaridad`, `nivelEscolar`) VALUES
(1, 'Sin escolarizar'),
(2, 'Preescolar'),
(3, 'Primaria'),
(4, 'Secundaria'),
(5, 'Bachiller');


-- Volcado de datos para la tabla `motivosEgreso`
INSERT INTO `motivosEgreso` (`idMotivoEgreso`, `motivoEgreso`) VALUES
(1, 'Reintegracion familiar'),
(2, 'Deceso'),
(3, 'Cambio de Casa Hogar'),
(4, 'Mala conducta'),
(5, 'Estancia imposible'),
(6, 'Adaptacion imposible'),
(7, 'No cubria perfil'),
(8, 'Petición de mama'),
(9, 'Baja por enfermedad'),
(10, 'Concluye primaria/edad'),
(11, 'Peticion DIF Queretaro'),
(12, 'Voluntad propia'),
(13, 'Peticion papa'),
(14, 'Otro');

-- Volcado de datos para la tabla `motivosIngreso`
INSERT INTO `motivosIngreso` (`idMotivoIngreso`, `motivoIngreso`) VALUES
(1, 'Violencia Familiar'),
(2, 'Omision de cuidados'),
(3, 'Apoyo a la mama'),
(4, 'No puede ser atendida'),
(5, 'Abandono'),
(6, 'Adopcion'),
(7, 'Abuso sexual'),
(8, 'Cambio de casa hogar'),
(9, 'Medida de proteccion'),
(10, 'Problemas economicos'),
(11, 'Peticion mama'),
(12, 'Peticion papa'),
(13, 'Peticion DIF Queretaro'),
(14, 'Peticion DIF SLP'),
(15, 'Abandono y abuso'),
(16, 'Transferida de casa hogar'),
(17, 'Otro');

INSERT INTO `beneficiarias` (`idBeneficiaria`, `beneficiariaActiva`, `nombreCompleto`, `fechaNacimiento`, `edad`, `antecedentes`, `diagnosticoInt`, `diagnosticoMotriz`, `edadMental`, `fechaIngreso`, `idMotivoIngreso`, `otroMotivoIngreso`, `nombreCanalizador`, `consideracionesIngreso`, `vinculosFam`, `convivencias`, `tutela`, `situacionJuridica`, `idEscolaridad`, `gradoEscolar`, `fechaEgreso`, `idMotivoEgreso`, `otroMotivoEgreso`, `consideracionesEgreso`, `idDestino`, `especificacionesDestino`, `nombreReceptor`, `logros`) VALUES
(1, 0, 'Elsa Caridad Basaldua Hernandez', '1993-08-01', '25', NULL, 'Paralisis cerebral', 'Afasia motora, retraso psicomotor', NULL, '2002-04-04', 3, NULL, 'Madre', 'Estando en la casa hogar San Pablo acudio diariamente a PROPACE por 3 anios, se vieron grandes mejorias.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL, '8', NULL, 'Madre', 'logros'),
(2, 0, 'Leticia Torres Maldonado', '1987-04-26', '32', NULL, 'Sindrome de Down', NULL, NULL, '2010-10-14', 17, 'Transferida de San Juan del Rio', 'DIF San Juan del Rio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, '2', NULL, NULL, NULL),
(3, 0, 'Liliana Cristobal Hernandez', NULL, NULL, NULL, NULL, NULL, NULL, '2010-08-12', 17, 'Ingreso provisional a la espera de recibir su aparato auditivo', 'DIF Estatal Queretaro', 'Sordo-muda', 'Abuela materna y tio', NULL, NULL, NULL, NULL, NULL, '2016-01-15', '1', NULL, NULL, '8', NULL, 'DIF Estatal Queretaro', NULL),
(4, 0, 'Maria Luisa Perez Acosta', '1997-01-01', '23', 'Problemas economicos, de agresion , violencia y abuso sexual por parte del tio', NULL, NULL, NULL, '2010-04-08', 1, NULL, 'DIF San Luis Potosi', 'Sin escolaridad', NULL, NULL, NULL, NULL, NULL, NULL, '2010-06-09', '14', 'No hay registro de motivo', NULL, '7', 'Villa Hidalgo, SLP', 'DIF San Luis Potosi', NULL),
(5, 0, 'Maria Guadalupe Verde Landeverde', '2004-12-23', '14', NULL, 'Discapacidad Intelectual Leve', NULL, NULL, '2010-07-30', 1, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2010-11-04', '6', NULL, NULL, '8', NULL, 'DIF Estatal Queretaro', NULL),
(6, 0, 'Erika Olvera Landeverde', '1999-07-18', '19', NULL, 'P.M.L.', NULL, NULL, '2009-10-09', 17, 'Omision de cuidados y maltrato por parte de la madre', 'DIF Estatal Queretaro', 'Fue reingresada provisionalmente el 27 de Enero de 2011 por el DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, '2010-11-04', '14', NULL, 'Egresada por segunda vez el 31-01-2011 por estancia imposible', '8', NULL, 'DIF Estatal Queretaro', NULL),
(7, 0, 'Mariela Ramirez Lopez', '1976-09-28', '42', 'Su madre trabajaba gran parte del dia y la dejaba sola', NULL, 'Trastornos paroxisticos', NULL, '2002-06-17', 17, 'La madre decidio que seria mejor integrarla por miedo a que le sucediera algo ya que estaba todo el dia sola.', 'Madre', 'Crisis convulsivas_', NULL, NULL, 'Madre', NULL, NULL, NULL, NULL, '14', 'No hay registro de motivo', NULL, '8', NULL, NULL, NULL),
(8, 0, 'Rita', NULL, NULL, 'Llego al municipio de Tizayuca, Hgo. como extraviada, a pesar de las busquedas no se han podido localizar a los familiares', 'Discapacidad Intelectual Moderada', NULL, NULL, '2002-06-04', 17, 'Transferida de DIF Hidalgo', 'DIF Hidalgo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', 'No hay registro de motivo', NULL, '8', NULL, NULL, NULL),
(9, 0, 'Emma San Agustin Tolentino', '1988-08-10', '30', 'Sus familiares no pudieron hacerse cargo de ella por no contar con los medios economicos necesarios ', NULL, NULL, NULL, '2002-09-23', 17, 'Transferida de DIF Hidalgo', 'DIF Hidalgo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2002-11-08', '1', NULL, 'No le fue posible adaptarse', '8', NULL, 'DIF Hidalgo', NULL),
(10, 0, 'Claudia Herminia Ramirez Garcia', '1989-02-04', '30', 'Madre esquizofrenica, padre alcoholico', 'Alteraciones de lenguaje y posible discapacidad intelectual', NULL, NULL, '2002-04-06', 2, NULL, 'Ministerios Pan de Vida', 'No existia lenguaje verbal, pobre interaccion social, torpeza motora', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', 'No hay registro de motivo', NULL, '8', NULL, NULL, NULL),
(11, 0, 'Aida Araceli Castro Beltran', NULL, NULL, NULL, NULL, NULL, NULL, '2009-10-05', 17, 'Severa desintegracion familiar', 'Madre', NULL, 'Madre', NULL, NULL, NULL, NULL, NULL, '2015-03-06', '8', NULL, NULL, '8', NULL, NULL, NULL),
(12, 0, 'Viridiana Benitez Espinoza', NULL, NULL, NULL, NULL, NULL, NULL, '2009-06-01', 17, 'Peticion DIF Ecatepec', 'DIF Ecatepec, D.F.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-01', '10', NULL, NULL, '8', NULL, 'DIF Ecatepec, D.F.', NULL),
(13, 0, 'Margarita Sisneros Pena', '1999-05-02', '20', NULL, 'P.M.L.', NULL, NULL, '2009-08-11', 17, 'Convenio de apoyo asistencial con el cual se daba proteccion a la menor.', 'DIF Estatal Queretaro', NULL, 'Madre', 'Visita familiar cada 3 meses', 'Madre', NULL, NULL, NULL, '2010-06-11', '1', NULL, NULL, '8', NULL, 'DIF Estatal Queretaro', NULL),
(14, 0, 'Diana Galindo Hernandez', NULL, NULL, NULL, 'Sindrome de Down', NULL, NULL, '2009-02-05', 3, NULL, 'Madre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL, '8', NULL, 'Madre', NULL),
(15, 0, 'Daima Neftali Perez Espindola', '1991-09-09', '27', 'Problemas economicos, afectivos, de abandono, agresion, violencia y abuso. Madre adicta y alcoholica, padre desinteresado completamente.', NULL, NULL, NULL, '2005-07-27', 5, NULL, 'DIF Cuautitlan Izcalli', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-09', '10', NULL, NULL, '8', NULL, 'DIF Cuautitlan Izcalli', NULL),
(16, 0, 'Sorayda Cayetano Molina', '1987-08-04', '31', NULL, NULL, NULL, NULL, '2005-05-20', 17, 'Peticion del DIF', 'Procuraduria Auxiliar en Materia de Asistencia Social', 'Nesecito de rehabilitacion en lenguaje', NULL, NULL, NULL, NULL, NULL, NULL, '2005-06-20', '12', NULL, NULL, '8', NULL, 'DIF Irapuato', NULL),
(17, 0, 'Rosa Rios Arciga', '2000-08-09', '18', NULL, 'Sindrome de Down', 'Retraso psicomotor leve', NULL, '2005-01-26', 17, 'Abandono economico por parte de la madre', 'Casa hogar \"Ciudad de los Ninios\"', 'Epilepsia criptogenica', 'Padre', '2 Visitas por parte de su padre, despues de llevarsela en la segunda no la regresa la fecha correspondiente', NULL, NULL, NULL, NULL, NULL, '13', NULL, 'Hay datos de padres adoptivos, sin embargo no hay registro del egreso de la joven', '8', NULL, 'Padre', NULL),
(18, 0, 'Maria del Carmen Reyes Mendoza', '1990-12-20', '28', 'Problemas economicos, afectivos, de abandono por parte de la madre, agresion y violencia', 'Discapacidad Intelectual Leve', NULL, NULL, '2005-08-15', 15, NULL, 'DIF Cuautitlan Izcalli', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-06-23', '6', NULL, NULL, '8', NULL, 'DIF Estatal Queretaro', NULL),
(19, 0, 'Dolores Jazmin Fernandez Hernandez', '1998-12-16', '20', 'Problemas economicos, de abandono, agresion y violencia', NULL, NULL, NULL, '2013-02-20', 17, 'Resolucion de situacion juridica por el abandono de la madre', 'DIF Guanajuato', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-03-03', '5', NULL, NULL, '8', NULL, NULL, NULL),
(20, 0, 'Jessica Viridiana Zamudio Granciano', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, 'Particular', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-25', '14', 'Situacion juridica resuelta', NULL, '7', 'DIF Celaya', 'Tia', NULL),
(21, 0, 'Lizbeth Padilla Garcia', '1997-06-01', '21', NULL, NULL, NULL, NULL, '2014-02-17', 13, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-08-05', '2', NULL, NULL, '8', NULL, 'DIF Estatal Queretaro', NULL),
(22, 0, 'Rosa Maria Broca Martinez', '2002-09-11', '16', 'Separacion de padres, problemas economicos, de agresion y violencia', 'Discapacidad Intelectual, sindrome de Turner', NULL, NULL, '2015-11-09', 3, NULL, 'Particular', 'Estrabismo convergente y obesidad.', NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-13', '4', NULL, NULL, '8', NULL, 'Madre', NULL),
(23, 0, 'Karina Idali Maya Gomez', '2000-01-01', '19', NULL, 'Discapacidad Intelectual Leve', NULL, NULL, '2014-06-27', 17, 'Brindar proteccion', 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-06-05', '4', NULL, NULL, '8', NULL, 'DIF Estatal Queretaro', NULL),
(24, 0, 'Diana Karen Jasso Castelan', '1995-06-13', '23', 'Abandono por parte del padre, problemas economicos', 'Retraso global del desarrollo, hiperactividad', NULL, NULL, '2006-06-09', 4, NULL, 'Madre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2006-09-19', '8', NULL, NULL, '6', NULL, 'Madre', NULL),
(25, 0, 'Catalina Rohm Sanchez', NULL, NULL, NULL, 'Depresion', NULL, NULL, '2006-09-06', 1, NULL, 'DIF Estatal Queretaro', 'Autolesion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL, '8', NULL, 'DIF Estatal Queretaro', NULL),
(26, 0, 'Ana Karen Ca_as Ruiz', '1993-01-22', '24', NULL, NULL, NULL, NULL, '2007-08-22', 16, NULL, 'Casa hogar \"Yolia\"', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11', '1', NULL, NULL, '8', NULL, 'Tia', NULL),
(27, 0, 'Diana Macias Salinas', '2000-10-18', '18', 'Abandono por parte del padre, problemas economicos, divorcio, agreion y violencia', 'Sindrome de Down', 'Artritis reumatoide', NULL, NULL, 4, NULL, 'Madre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, '8', NULL, NULL, NULL),
(28, 0, 'Alma Delia Trejo Barron', '1981-01-20', '38', NULL, 'Discapacidad Intelectual Leve', NULL, NULL, '2007-02-07', 15, NULL, 'DIF Corregidora', NULL, NULL, 'Pocas', NULL, NULL, NULL, NULL, '2008-07-22', '3', NULL, NULL, '5', NULL, NULL, NULL),
(29, 0, 'Lorena Berenice Garcia Martinez', '1988-09-07', '30', 'Problemas economicos ', NULL, NULL, NULL, '2007-01-07', 10, NULL, 'Madre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-10-02', '6', NULL, NULL, '8', NULL, NULL, NULL),
(30, 0, 'Guadalupe Jimenez Zarzoza', '1995-06-12', '23', 'Abandono', 'Discapacidad Intelectual Moderada', NULL, NULL, '2010-09-29', 17, 'Transferida de San Luis Potosi', 'DIF San Luis Potosi', 'Autolesion, impulsividad agresiva', NULL, 'Una visita por parte del DIF San Luis Potosi', NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL, '2', NULL, NULL, NULL),
(31, 0, 'Araceli Hernandez Ramirez', '1991-01-26', '28', NULL, 'Microcefalia', NULL, NULL, '2004-02-26', 4, NULL, 'DIF Amealco', NULL, NULL, 'Cinco visitas de su hermana', NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL, '2', NULL, NULL, NULL),
(32, 0, 'Esmeralda Dias Medina', '1995-06-14', '23', NULL, NULL, NULL, NULL, '2007-02-07', 17, 'Apoyo a religiosas', 'Religiosas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-02-23', '6', NULL, NULL, '8', NULL, NULL, NULL),
(33, 0, 'Esther Sara Garfias Garcia', '1978-03-02', '41', 'Divorcio, problemas economicos, afectivos, agresion y violencia', 'Psicotica', NULL, NULL, '2007-02-22', 2, NULL, 'Padre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-05-04', '5', NULL, NULL, '8', NULL, NULL, NULL),
(34, 0, 'Esthela Guerrero Zamudio', '1988-07-16', '30', NULL, 'Discapacidad Intelectual Leve', NULL, NULL, '2007-08-15', 17, 'Peticion DIF del Marques', 'DIF Municipio del Marques', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, '5', NULL, NULL, NULL),
(35, 0, 'Sandy Adriana Rodriguez Araujo', '1990-09-08', '28', 'Orfandad, problemas afectivos, agresion, abandono y violencia. Drogas y vida en la calle', 'Hemiparesia parcial compleja y danio cerebral', NULL, NULL, '2007-10-03', 16, NULL, 'DIF San Luis Potosi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-11-13', '5', NULL, NULL, '8', NULL, NULL, NULL),
(36, 0, 'Ana Berenice Hernandez Gomez*', '1985-08-14', '33', 'Agresion por parte del hermano, orfandad, problemas economicos, divorcio y violencia', NULL, 'Retraso psicomotor ', NULL, '2007-10-29', 17, 'Falta de atencion, no fue atendida. Sufrio maltrato', 'Madre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', 'No hay registro de motivo', NULL, '8', NULL, NULL, NULL),
(37, 0, 'Beatriz Cruz Cruz', NULL, NULL, 'Ambos padres eran alocholicos', 'Discapacidad Intelectual', NULL, NULL, '2002-12-05', 2, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-17', '3', NULL, NULL, '3', NULL, NULL, NULL),
(38, 0, 'Araceli Cano Gardu_o', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 'Peticion DIF Amealco', 'DIF Municipal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, '5', NULL, NULL, NULL),
(39, 0, 'Maria del Carmen Hernandez Nieto', '1998-06-26', '21', NULL, 'P.M.L.', NULL, NULL, '2011-11-04', 13, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, '5', NULL, NULL, NULL),
(40, 0, 'Marisol Nieves Cruz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, '5', NULL, NULL, NULL),
(41, 0, 'Maria del Carmen Guerrero Zamudio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 'DIF San Luis Potosi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, '5', NULL, NULL, NULL),
(42, 0, 'Juliana Monzerrat Vazquez Ramirez', '1994-01-12', '25', NULL, NULL, NULL, NULL, '2008-09-11', 5, NULL, 'DIF Irapuato', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2009-01-27', '4', NULL, NULL, '7', 'DIF Irapuato', 'Trabajadora Social', NULL),
(43, 0, 'Natalie Martinez Ferrusca', NULL, NULL, NULL, NULL, 'Atrofia muscular generalizada', NULL, NULL, 17, 'Fue victima de brutal maltrato fisico por parte de la madre', 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2008-04-17', '14', 'Expulsion/Reintegracion Familiar', 'Comportamiento abusivo, dependiente, caprichoso y manipulador', '8', NULL, 'DIF Estatal Queretaro', NULL),
(44, 0, 'Alma Jennifer Perez Santos', '2003-05-28', '16', NULL, 'Paralisis cerebral infantil, encefalopatia hipoxica, sindrome disquinetico', 'Epilepsia', NULL, '2008-05-14', 3, NULL, 'DIF Municipal Queretaro', 'Le diagnosticaron bronconeumonia a los dos anios. Conjuntivitis cronica', '.', NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL, '8', NULL, 'Madre', NULL),
(45, 0, 'Milagros Sandoval Gomez', NULL, NULL, NULL, NULL, NULL, NULL, '2008-04-04', 17, 'No tiene donde vivir', 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, '5', NULL, NULL, NULL),
(46, 0, 'Maria de Jesus Mata Arreguin', '1998-12-25', '20', NULL, 'P.M.L.', NULL, NULL, '2008-02-26', 2, NULL, 'DIF Estatal Queretaro', NULL, NULL, 'Una visita mensual por parte de su madre durante 4 meses', NULL, NULL, NULL, NULL, '2010-07-14', '11', NULL, NULL, '6', NULL, 'DIF Estatal Queretaro', NULL),
(47, 0, 'Maria Denisse Ortega Palacio', '2000-08-15', '18', 'Sufrio de anbandono, no tenia apellidos.', NULL, 'Paraparesia espastica familiar', NULL, '2008-10-14', 17, 'Omision de Cuidados y abandono', 'DIF Celaya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2010-11-17', '14', 'No hay registro de motivo', NULL, '8', NULL, 'DIF Celaya', NULL),
(48, 0, 'Maria Daniela Mata Arreguin', '2002-08-29', '16', NULL, 'P.M.L.', NULL, NULL, '2008-02-26', 2, NULL, 'DIF Estatal Queretaro', NULL, NULL, 'Una visita mensual por parte de su madre durante 4 meses', NULL, NULL, NULL, NULL, '2010-07-14', '11', NULL, NULL, '6', NULL, 'DIF Estatal Queretaro', NULL),
(49, 0, 'Maria Cruz Mata Arreguin', '2004-09-29', '14', NULL, 'P.M.L.', NULL, NULL, '2008-02-26', 2, NULL, 'DIF Estatal Queretaro', NULL, NULL, 'Una visita mensual por parte de su madre durante 4 meses', NULL, NULL, NULL, NULL, '2010-07-14', '11', NULL, NULL, '6', NULL, 'DIF Estatal Queretaro', NULL),
(50, 0, 'Columba Salinas Colchado', '1992-10-02', '26', NULL, NULL, NULL, NULL, '2008-08-15', 17, 'Omision de Cuidados y violacion por parte de sus progenitores', 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2008-08-20', '1', NULL, 'Manifesto conducta hostil ', '8', NULL, 'Tia', NULL),
(51, 0, 'Isabel Martinez Hernandez', '1987-07-08', '31', NULL, 'Discapacidad Intelectual Severa secundario a hipotiroidismo', NULL, NULL, '2012-05-18', 5, NULL, 'DIF San Luis Potosi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-14', '14', 'No hay registro de motivo', NULL, '5', NULL, NULL, NULL),
(52, 0, 'Irene Martinez Sanchez', NULL, NULL, 'El padre no la reconocio legalmente', 'Discapacidad Intelectual', NULL, NULL, '2012-03-06', 14, NULL, 'DIF San Luis Potosi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-02-20', '4', NULL, NULL, '5', NULL, NULL, NULL),
(53, 0, 'Teresa Fonseca Zavala', '2000-11-03', '19', NULL, 'Trastorno por deficit de atencion', 'Hiperactividad', NULL, '2011-03-07', 17, 'Asistencial', 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-13', '4', NULL, NULL, '8', NULL, 'DIF Estatal Queretaro', NULL),
(54, 0, 'Maria Guadalupe Rangel Perez', '2003-01-06', '17', 'Orfandad, abandono, problemas economicos, afectivos, agresion y violencia', 'Discapacidad Intelectual Leve, crisis de ausencia', NULL, NULL, '2011-07-18', 14, NULL, 'DIF San Luis Potosi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, ' Deceso 30-09-2017', '8', NULL, NULL, NULL),
(55, 0, 'Maria Guadalupe Marin Gonzalez', '1990-12-12', '28', NULL, NULL, NULL, NULL, '2011-01-05', 13, NULL, 'Consejo Estatal de la Mujer Toluca', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, '5', NULL, NULL, NULL),
(56, 0, 'Maria Antonia Martinez Cantero', '1997-08-30', '21', NULL, 'Discapacidad Intelectual Leve', 'Epilepsia', NULL, '2011-01-04', 17, 'Sin motivo', 'Casa de la Esperanza FEUIMTRA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', 'No hay registro de motivo', NULL, '8', NULL, NULL, NULL),
(57, 0, 'Judith Navarrete Aguilar', '1982-11-14', '36', 'Orfandad, abandono, problemas economicos, afectivos, agresion y violencia. La madre la dejaba encerrada para irse a trabajar', 'Discapacidad Intelectual', NULL, NULL, '2011-08-23', 17, 'Sin motivo', 'DIF Tuxtepec, Oaxaca', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', 'No hay registro de motivo', NULL, '2', NULL, NULL, NULL),
(58, 0, 'Erika Laura Moya Macias', '1975-10-14', '43', NULL, NULL, NULL, NULL, '2002-04-01', 11, NULL, 'Padres', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL, '8', NULL, 'Madre', NULL),
(59, 0, 'Clara Paz Romero', NULL, NULL, NULL, NULL, NULL, NULL, '2002-05-27', 4, NULL, 'Padres', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', 'No hay registro de motivo', NULL, '8', NULL, NULL, NULL),
(60, 0, 'Elsa Caridad Basaldua Hern_ndez', '1993-08-01', '25', NULL, 'Paralisis cerebral', NULL, NULL, '2002-04-04', 11, NULL, 'Particular', NULL, NULL, 'Visita mensual por parte de su madre los primeros dias', NULL, NULL, NULL, NULL, '2010-12-20', '5', NULL, 'Manifesto un cambio negativo en su conducta', '8', NULL, 'Madre', NULL),
(61, 0, 'Maria Concepcion Florencio Casas', '1988-12-08', '30', NULL, 'Paralisis cerebral', NULL, NULL, '2002-12-03', 4, NULL, 'Casa Hogar \"San Pablo\"', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, '5', NULL, NULL, NULL),
(62, 0, 'Juana Tolentino Monroy', '1992-12-19', '26', 'Abandono', 'Discapacidad Intelectual Moderada', NULL, NULL, '2002-07-10', 5, NULL, 'DIF Hidalgo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2008-04-15', '5', NULL, NULL, '8', NULL, 'DIF Hidalgo', NULL),
(63, 0, 'Maria Ofelia Keever Lazcano', '1980-12-10', '38', 'Ambos padres trabajan y no pueden hacerse cargo de la joven', NULL, NULL, NULL, '2002-05-02', 4, NULL, 'Padres', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', 'No hay registro de motivo', NULL, '8', NULL, NULL, NULL),
(64, 0, 'Maribel Valdez Antonino', '1982-02-09', '37', 'Escapo de su casa a los 15 anios para buscar trabajo, hasta que llego a la casa hogar \"Maria Goretti\" fue que se pudo ubicar a su familia', 'Hipoacusia sensorio neuronal severa bilateral', NULL, NULL, '2002-09-10', 2, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2006-05-30', '1', NULL, NULL, '8', NULL, 'Madre', NULL),
(65, 0, 'Susana Daniela Nieto Martinez', '1990-08-30', '28', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', 'No hay registro de motivo', NULL, '8', NULL, NULL, NULL),
(66, 0, 'Maria Isabel Nieto Martinez', '1994-04-15', '25', NULL, NULL, NULL, NULL, NULL, 2, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14', 'No hay registro de motivo', NULL, '8', NULL, NULL, NULL),
(67, 0, 'Tomasa Garcia Trejo', NULL, NULL, NULL, NULL, NULL, NULL, '2002-05-03', 17, 'Peticion DIF Hidalgo', 'DIF Hidalgo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, '5', NULL, NULL, NULL),
(68, 0, 'Adelfa Cano Fernandez', '1969-06-10', '50', NULL, NULL, 'Epilepsia', NULL, '2003-05-31', 17, 'Atencion adecuada a su estado de salud mental', 'Dispensario Parroquial', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, '5', NULL, NULL, NULL),
(69, 0, 'Teresa Flores Gonzalez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2006-09-15', '7', NULL, NULL, '8', NULL, 'DIF Estatal Queretaro', NULL),
(70, 0, 'Claudia Gabriela Estrella Martinez', NULL, NULL, NULL, NULL, NULL, NULL, '2006-09-27', 13, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL, '4', NULL, NULL, NULL),
(71, 0, 'Rosario Graciela Sanchez Barcenas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, 'Madre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-10-10', '6', NULL, 'Meses antes de su egreso habia escapado de la casa hogar', '8', NULL, 'Familia', NULL),
(72, 0, 'Maria Guadalupe Guerrero Zamudio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 'Sin motivo', 'DIF San Luis Potosi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-10-04', '6', NULL, NULL, '8', NULL, 'DIF del Marques', NULL),
(73, 0, 'Adelaida Olvera Martinez', '1983-08-22', '35', NULL, NULL, NULL, NULL, NULL, 17, 'Sin motivo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL),
(74, 0, 'Elidee Velazquez Cortinoviz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2005-01-30', '9', NULL, NULL, '2', NULL, NULL, NULL),
(75, 0, 'Ana Gabriela Padilla Garcia', NULL, NULL, NULL, NULL, NULL, NULL, '2014-02-17', 13, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL, '4', NULL, NULL, NULL),
(76, 0, 'Raquel Maya Nieto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 'DIF San Luis Potosi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-17', '3', NULL, NULL, '3', NULL, NULL, NULL),
(77, 0, 'Jazmin Hernandez Gonzalez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-17', '3', NULL, NULL, '3', NULL, NULL, NULL),
(78, 0, 'Julia Ortiz Trejo', '1994-07-18', '24', 'Madre alcoholica, descuidaba a sus hijos. La joven fue violentada sexualmente por diferentes personas', NULL, NULL, NULL, '2004-03-15', 17, 'Omision de cuidados, agresion sexual, malas condiciones de vida', 'DIF Estatal Queretaro', NULL, NULL, NULL, 'PREMAN', NULL, NULL, NULL, '2011-12-17', '3', NULL, NULL, '3', NULL, NULL, NULL),
(79, 0, 'Maria Reina Terrazas Frias', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 'DIF San Luis Potosi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-08-06', '6', NULL, NULL, '7', 'San Luis Potosi', NULL, NULL),
(80, 0, 'Monica Monserrat Vargas Hernandez', '1995-04-04', '24', NULL, 'Hidrocefalia ', 'Mielomeningocele', NULL, NULL, 3, NULL, 'Madre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, '8', NULL, NULL, NULL),
(81, 0, 'Rosario Morales Maldonado', NULL, NULL, 'Orfandad, problemas economicos', NULL, NULL, NULL, '2003-05-13', 4, NULL, 'Hermana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2005-12-06', '5', NULL, NULL, '8', NULL, 'Hermana', NULL),
(82, 0, 'Selene Rios Arciga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, 'Padre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2005-08-19', '13', NULL, NULL, '8', NULL, 'Padre', NULL),
(83, 0, 'Nancy Ramirez Reyes', NULL, NULL, NULL, 'Microcefalia y microencefalia. ', NULL, NULL, '2003-10-24', 4, NULL, 'DIF Hidalgo', 'Presento tendencia a crisis convulsivas._', NULL, NULL, NULL, NULL, NULL, NULL, '2004-01-27', '9', NULL, 'Se autolesionaba, manifesto signos importantes de agresividad.', '8', NULL, 'DIF Hidalgo', NULL),
(84, 0, 'Claudia Leticia Rodriguez Olguin', '1988-08-29', '30', 'Abuso sexual por parte de su padre y su hermano, ambos encarcelados. Problemas economicos debido al creciente alcoholismo del padre.', 'Discapacidad Intelectual Moderada', 'Soplo de corazon', NULL, '2003-07-01', 17, 'Fue abusada en varias ocasiones por su padre y su hermano drogadicto', 'DIF Municipal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2003-12-17', '14', 'Medida de seguridad', 'La joven ya se habia escapado de la casa hogar y un sujeto desconocido la regreso, sin embargo el mismo seguia acosandola. Como medida de seguridad se decidio que su madre se la llevara.', '8', NULL, 'Madre', NULL),
(85, 0, 'Karen Janeth Martinez Hernandez', '1989-12-05', '29', 'Abandono por parte del padre. Su madre fue participe de la violacion a la joven', 'Discapacidad Intelectual', NULL, NULL, '2003-07-09', 17, 'No habia un lugar idoneo para la joven en el municipio del ebano, SLP.', 'DIF San Luis Potosi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL, '7', 'San Luis Potosi', NULL, NULL),
(86, 0, 'Maria Concepcion Lopez Franco', '1981-07-12', '37', 'Madre con dificultades motrices, situacion economica precaria en la familia. Sufrio de un ataque sexual', 'Discapacidad Intelectual Leve', 'Problemas de motricidad en el hemisferio izquierdo', NULL, '2003-06-26', 17, 'Ambito familiar desfavorable', 'DIF Celaya', 'Crisis convulsivas. Pasados los 2 meses tuvo pulmonia.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, '5', NULL, NULL, NULL),
(87, 0, 'Maricela Medina Corona', NULL, NULL, 'Problemas economicos, afectivos y de abandono', 'Disfuncion cerebral, disgenesia del lenguaje', NULL, NULL, '2003-02-04', 17, 'Peticion de la tia', 'Tia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2005-02-25', '9', NULL, NULL, '8', NULL, 'Tia', NULL),
(88, 0, 'Fabiola Angeles Velazquez', NULL, NULL, 'Abuso sexual por parte de su hermanastro', NULL, NULL, NULL, '2003-10-22', 15, NULL, 'CECOSAM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2006-03-06', '12', NULL, 'Intento de suicidio.', '8', NULL, NULL, NULL),
(89, 0, 'Yanett Segundo Nieves', NULL, NULL, NULL, NULL, NULL, NULL, '2003-05-22', 2, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2003-05-27', '1', NULL, 'Su conducta en la casa hogar fue violenta, imposibilitando su estadia', '8', NULL, 'DIF Estatal Queretaro', NULL),
(90, 0, 'Adriana Rivera Cruz', '1995-01-17', '24', NULL, NULL, NULL, NULL, '2003-07-27', 13, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2004-01-07', '14', 'Requiere de un instituto adecuado a sus necesidades.', NULL, '8', NULL, 'Madre', NULL),
(91, 0, 'Magali Noemi Perez Camacho', '1987-02-19', '32', NULL, 'Trastorno esquizofrenidorme', NULL, NULL, '2003-08-22', 13, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, 'Tendencia a la agresividad, ansiedad, inquietud de dificil control', '8', NULL, 'DIF Estatal Queretaro', NULL),
(92, 0, 'Gabriela Valentina Lopez Cata_o', '1985-02-14', '34', NULL, 'Discapacidad Intelectual Leve', NULL, NULL, '2004-02-11', 3, NULL, 'Madre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2004-03-10', '14', 'Requiere de un instituto adecuado a sus necesidades.', NULL, '8', NULL, 'Madre', NULL),
(93, 0, 'Sarai Manuel Herculano', NULL, NULL, 'La joven declaro ser regalada por su madre a una seniora quien tiempo despues la abandono', NULL, NULL, NULL, '2004-05-18', 1, NULL, 'DIF Estatal Queretaro', 'Presento sindrome de ninio maltratado', NULL, NULL, NULL, NULL, NULL, NULL, '2006-07-06', '11', NULL, NULL, '8', NULL, 'DIF Estatal Queretaro', NULL),
(94, 0, 'Maria Fernanda Silva Negrete', NULL, NULL, 'Su estadia estaba programada para ser de una anio y medio aproximadamente ', 'Discapacidad Intelectual Leve', NULL, NULL, '2007-10-27', 17, 'Peticion por parte de la familia', 'Padres', 'Deficit de atencion, hiperactividad y trastorno de conducta', NULL, NULL, NULL, NULL, NULL, NULL, '2006-11-18', '8', NULL, NULL, '8', NULL, 'Madre', NULL),
(95, 0, 'Milagros del Carmen Sandoval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7', NULL, NULL, '4', NULL, NULL, NULL),
(96, 0, 'Ana Maria Lozano Hernandez', '1989-11-25', '29', 'Victima de abuso sexual durante anios por su medio hermano. Encontraron a la joven y a sus hermanos abandonados en su casa la cual se incendio; los padres no tenian idea de esto. Abandono total por parte de la madre, quien ejercia de prostituta. Padre alcoholico.', 'Discapacidad Intelectual Leve', NULL, NULL, '2004-06-18', 15, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, 'PREMAN', NULL, NULL, NULL, NULL, '14', 'No hay registro de motivo', NULL, '8', NULL, NULL, NULL),
(97, 0, 'Dolores Godinez Alejandra', NULL, NULL, 'Horfandad, abandono y problemas afectivos', 'Discapacidad Intelectual Leve', NULL, NULL, '2004-05-04', 5, NULL, NULL, 'Trastorno en control de impulsos', NULL, NULL, NULL, NULL, NULL, NULL, '2008-04-15', '9', NULL, NULL, '8', NULL, 'DIF Hidalgo', NULL),
(98, 0, 'Mariana Torres Lopez', '2003-10-26', '15', NULL, 'Disgenesia Cerebral (Polimicrogiria yatrofia frontal)', 'Retraso psicomotor ', NULL, '2003-11-04', 17, 'Ingreso temporal', 'DIF Estatal Queretaro', NULL, NULL, 'Convivencias domiciliarias por parte del matrimonio interesado en adoptar a la ninia, una cada quince dias.', 'Olivia Franco Rivera y Miguel Angel Rivera Castro', NULL, NULL, NULL, '2009-03-09', '14', 'Adopcion', NULL, '8', NULL, 'Olivia Franco Rivera y Miguel Angel Rivera Castro', NULL),
(99, 0, 'Ana Miriam Martinez Arias', '1966-02-24', '53', 'Padre alcoholico. Su madre fallecio cuando la joven tenia 22 anios. Falta de integracion familiar.', 'Discapacidad Intelectual Leve', NULL, NULL, '2004-01-09', 17, 'No se adaptaba a su familia', 'Familia (hermano y cuniada)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2004-07-19', '14', 'La joven manifesto el deseo de volver con su familia asi que su hermana se comprometio a hacerse cargo de ella', NULL, '7', 'Durango', 'Sobrina', NULL),
(100, 0, 'Claudia Valdez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, 'DIF Estatal Queretaro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 1, 'Alma Abril Torres Alvarado', '2009-10-02', '9', NULL, 'Paralisis Cerebral', NULL, NULL, '2015-07-21', 2, NULL, 'DIF Queretaro', NULL, NULL, NULL, 'procuraduria', NULL, '3', 'cuarto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 1, 'Alison Michelle Fabian Espinosa ', '2008-01-28', '11', NULL, 'Hiperactividad', NULL, NULL, '2014-07-21', 11, NULL, 'Sra. Berenice Epinosa Rivera', 'El comportamiento de la menor es muy complicado, es muy agresiva con ella misma y con sus companieras', 'Mama', NULL, 'mama', 'NA', '3', NULL, NULL, NULL, NULL, 'Pensando en lo mejor para la menor, se decidio entregarla a su mama al concluir la educacion primaria.', NULL, NULL, NULL, NULL),
(103, 1, 'Angelica Jimenez Lopez', '2005-03-21', '14', 'Abandono.', 'Hidrocefalia', NULL, NULL, '2007-04-04', 17, 'Exposicion de incapaces', 'DIF Queretaro', NULL, NULL, NULL, 'procuraduria', NULL, '3', 'sexto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 1, 'Antonia Hernandez Maldonado', '1992-12-18', '26', 'Se puso a disposicion del Ministerio P_blico por omision de cuidados, sufrio un mal trato por parte de su madre', 'P.M.L.', NULL, NULL, '2007-02-14', 2, NULL, 'DIF Queretaro', NULL, NULL, NULL, 'procuraduria', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 1, 'Ana Berenice Sumaya Martinez', '2006-07-26', '12', NULL, 'Discapacidad Intelectual', NULL, NULL, '2018-01-16', 17, 'Violacion equiparada ', 'DIF Queretaro', NULL, NULL, NULL, 'procuraduria', NULL, '3', 'sexto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 1, 'Carmen Cruz Agustin', '2004-06-08', '15', 'Habia estado antes en la casa hogar, sin embargo la trasladaron provisionalmente a SLP, el dia 04 de marzo de 2016, con la finalidad de poder darle la atencion medica necesaria para corregir su problema de estrabismo. ', 'Sindrome de Down', NULL, NULL, '2011-11-07', 5, NULL, 'DIF San Luis Potosi', 'La operaron el 06 de Abril de 2017 de una retroinsercion de ambos m_sculos rectos mediales (Cirugia de estrabismo)', NULL, NULL, 'procuraduria', NULL, '3', 'sexto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, 1, 'Cristina Gonzalez Robles', '1996-08-08', '22', NULL, 'Discapacidad Intelectual Leve', NULL, NULL, '2014-02-17', 2, NULL, 'DIF Queretaro', 'Deficiencia en su capacidad psicomotora', NULL, NULL, 'procuraduria', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 1, 'Damaris Loarca Flores', '2009-02-17', '10', NULL, 'Retraso infanti e hipoacusia ', NULL, NULL, '2015-05-21', 2, NULL, 'DIF Queretaro', 'Crisis epilepticas', NULL, NULL, 'procuraduria', NULL, '3', 'cuarto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 1, 'Edith Sanchez Bentolero', '1998-12-06', '20', NULL, 'Sidrome de Down', NULL, NULL, '2003-07-16', 16, NULL, 'San Luis de la Paz, Gto.', NULL, NULL, 'Su hermano la visito en el 2011', 'nadie', 'NA', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 1, 'Maria Estefania Ledesma Montes', '2007-10-24', '11', 'Ya habia estado en la casa hogar antes (2008); sin embargo, a peticion de DIF Queretaro, se dio de baja en el 2010.', 'Paralisis Cerebral', NULL, NULL, '2013-04-01', 17, 'Cedida en adopcion', 'DIF Queretaro', NULL, NULL, NULL, 'procuraduria', NULL, '3', 'quinto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 1, 'Gloria Isabel Salazar Ramirez', '2001-05-31', '18', NULL, 'Discapacidad Intelectual Leve', NULL, NULL, '2011-08-30', 14, NULL, 'DIF San Luis Potosi', NULL, NULL, NULL, 'Maria Guadalupe Sosa Rivera', 'perdida de patria potestad', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 1, 'Juana Guadalupe Estrada Ramirez', '1992-08-01', '26', 'El DIF le retiro la patria potestad de la ninia a la madre por el delito de omision de cuidados en el 2000.', 'P.M.L.', 'Trastorno de desarrollo motriz y enfermedad Hirschsprung', NULL, '2002-10-28', 2, NULL, 'DIF Queretaro', NULL, NULL, NULL, 'procuraduria', NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 1, 'Maria Isaura Hernandez Rodriguez', '1984-08-21', '34', NULL, 'Discapacidad Intelectual', NULL, NULL, '2011-01-05', 3, NULL, 'Sra. Rocio Hndez. Rodriguez', 'Estrabismo', NULL, NULL, 'Maria Aidet Hernandez Rodriguez', 'NA', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, 1, 'Lourdes Leticia Montoya Jimenez', '2001-02-19', '18', NULL, 'Discapacidad Intelectual Moderada', NULL, NULL, '2010-08-09', 2, NULL, 'DIF Queretaro', NULL, NULL, NULL, 'procuraduria', NULL, '4', 'tercero', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 1, 'Griselda Lucero Aguillon Aguilar', '2004-07-09', '15', NULL, 'Discapacidad Intelectual Leve', NULL, NULL, '2010-08-06', 2, NULL, 'DIF Queretaro', NULL, NULL, NULL, 'procuraduria', NULL, '4', 'primero', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 1, 'Maria Lizbeth Martinez Camacho', '1997-01-02', '22', NULL, 'P.M.L.', NULL, NULL, '2009-02-04', 7, NULL, 'DIF Queretaro', NULL, NULL, NULL, 'procuraduria', NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, 1, 'Marisol Carrizales Martinez', '2002-12-24', '16', 'Padres violentos, cuando encontraron a la joven ya la habian \"tirado\" antes en un basurero. ', 'Sindrome de Down', NULL, NULL, '2011-06-20', 5, NULL, 'DIF San Luis Potosi', 'Hipoacusia leve izquierda', NULL, NULL, 'procuraduria', 'perdida de patria potestad', '4', 'tercero', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, 1, 'Maria Sabina Ramirez Martinez', '2006-08-19', '12', 'Familia con extrema pobreza, habitos insalubres y alcoholismo de ambos padres. Se hablo de alcoholismo de la madre a_n durante los embarazos.', 'Retraso generalizado en el desarrollo', NULL, NULL, '2010-12-17', 2, NULL, 'DIF Queretaro', 'Retraso psicomotriz global severo', NULL, NULL, 'procuraduria', NULL, '3', 'quinto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 1, 'Mariana Vazquez Hernandez', '1995-12-31', '23', NULL, 'P.M.L.', NULL, NULL, '2004-05-21', 5, NULL, 'DIF Hidalgo', NULL, NULL, NULL, 'procuraduria', NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 1, 'Magdalena Manuel Lucas', '2000-01-20', '19', 'La encontraron, junto con sus hermanos, en precarias condiciones de salud e higiene. Padres alcoholicos, vendian las despensas proporcionadas por el gobierno para conseguir alcohol. Los ninios sufrian tambien de maltrato fisico.', 'Discapacidad Intelectual Leve', NULL, NULL, '2012-07-27', 14, NULL, 'DIF San Luis Potosi', NULL, NULL, 'Varias convivencias con su hermano', 'procuraduria', 'perdida de patria potestad', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, 1, 'Maria del Carmen Mendoza Olvera', '1980-07-16', '39', 'Victima de violencia y abuso sexual', 'Discapacidad Intelectual', NULL, NULL, '2018-02-19', 16, NULL, 'familiar', NULL, NULL, NULL, 'mayor de edad', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 1, 'Marisol Ledezma Gonzalez', '2005-06-26', '14', NULL, 'Discapacidad Intelectual Moderada', NULL, NULL, '2017-04-15', 2, NULL, 'DIF Queretaro', 'Sufre de deficit de atencion', NULL, NULL, 'procuraduria', NULL, '3', 'sexto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 1, 'Silvia Hernandez Soto', '1991-11-03', '27', NULL, 'P.M.L.', NULL, NULL, '2008-07-04', 1, NULL, 'DIF Queretaro', NULL, NULL, NULL, 'procuraduria', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 1, 'Tania Karina Ramirez Vazquez', '1996-05-05', '23', 'Violada en varias ocasiones por su novio (de entonces 20 anios), un cuniado del novio y su vecino.', 'Discapacidad Intelectual Leve', NULL, NULL, '2010-08-12', 17, 'Violacion equiparada y abusos deshonestos', 'DIF Queretaro', NULL, NULL, NULL, 'procuraduria', NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 1, 'Wendy Esmeralda Juarez Luna', '2003-09-28', '14', 'Se encontraba en una vivienda en condiciones no aptas para el correcto desarrollo de los ninios.', 'Encefalopia motora fija', NULL, NULL, '2011-06-14', 2, NULL, 'DIF Queretaro', 'Sufrio de estrabismo', NULL, 'Registro de una convivencia con sus hermanos', 'procuraduria', NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 1, 'Guadalupe Jimenez Zarzoza', '1995-06-12', '24', NULL, 'Discapacidad Intelectual Moderada', NULL, NULL, '2010-09-29', 14, NULL, 'DIF San Luis Potosi', NULL, NULL, NULL, 'procuraduria', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Volcado de datos para la tabla `archivosBeneficiarias`
INSERT INTO `archivosBeneficiarias` (`idArchivo`, `categoria`, `pathArchivo`, `comentarios`, `idBeneficiaria`, `fechaCarga`) VALUES
(1, 'ingreso', 'uploadsBeneficiarias/actaNacimiento_1.pdf', '', 1, '2020-01-10'),
(2, 'ingreso', 'uploadsBeneficiarias/curp_1.pdf', '', 1, '2020-01-10'),
(3, 'ingreso', 'uploadsBeneficiarias/imagenIngreso_1.jpg', '', 1, '2020-01-15'),
(4, 'ingreso', 'uploadsBeneficiarias/feBautismo_1.pdf', '', 1, '2020-01-10'),
(5, 'ingreso', 'uploadsBeneficiarias/boletaConf_1.pdf', '', 1, '2020-01-10'),
(6, 'ingreso', 'uploadsBeneficiarias/primeraCom_1.pdf', '', 1, '2020-01-11'),
(7, 'egreso', 'uploadsBeneficiarias/imagenEgreso_1.jpg', '', 1, '2020-04-14'),
(8, 'egreso', 'uploadsBeneficiarias/cartaRespEgreso_1.pdf', '', 1, '2020-04-10'),
(9, 'escolar', 'uploadsBeneficiarias/certificadoPrimaria_1.pdf', 'Certificado de primaria original', 1, '2020-01-10'),
(10, 'escolar', 'uploadsBeneficiarias/certificadoPreescolar_1.pdf', '', 1, '2020-01-10'),
(11, 'medico', 'uploadsBeneficiarias/valoracionMedica_1.pdf', '', 1, '2020-01-10'),
(12, 'seguimiento', 'uploadsBeneficiarias/images/fotoEvento_1.jpg', 'Foto de Elsa tomada en el evento de recaudacion de fondos', 1, '2020-01-31'),
(13, 'seguimiento', 'uploadsBeneficiarias/images/fotoTorneo_1.jpg', 'Foto de Elsa con un participante del torneo', 1, '2020-02-02'),
(14, 'seguimiento', 'uploadsBeneficiarias/images/fotoActividad_1.jpg', 'Foto tomada durante la actividad construye estrellas', 1, '2020-02-14'),
(15, 'ingreso', 'uploadsBeneficiarias/actaNacimiento_2.pdf', '', 2, '2020-01-10');


-- Dumping data for table `beneficiarionomina`


INSERT INTO `beneficiarionomina` (`idBenefN`, `nombre`, `parentesco`, `rfc`, `direccion`) VALUES
(1, 'Beatriz Magali Valdemar Mangas', 'Esposa', 'VAMB790603', 'Fraccionamiento del Bosque Querétaro'),
(2, 'Juana Cristina Mares Padilla', 'Hija', 'MAPJ920122UW4', 'Calle Placer, Qro, Qro'),
(3, 'Margarita Estrada Ayala', 'Hermana de Congregación', 'EAAM690321K1', 'Av. Pie de la Cuesta #2251,  Lomas de San Pedrito Peñuelas. Qro, Qro, 76148'),
(4, 'Maria Luisa Jimenez Hernandez', 'Madre', 'JIHL6303123G3', 'Placer #22, Lomas de San Pedrito Peñuelas,  Qro,  Qro, 76148'),
(5, 'Alejandra Medina Aguado', 'Hija', 'MEAA900318', 'Granate #202,  Lomas de San Pedrito Peñuelas, Qro, Qro, 76148'),
(6, 'Leslie Paredes Olvera', 'Pareja', 'COOJ8008126KA', 'Cerro del Tzirate #241, Las Americas, Qro, Qro, 76140'),
(7, 'Ma. Guadalupe Cruz Pardón', 'Mamá', '', 'Jardines de la Hacienda, Manzana 6, Lote 22'),
(8, 'María Margarita Farías Pérez', 'Mamá', 'FIPM610327QB6', 'Peña de Bernal #606, Las Américas, Qro, Qro, 76121'),
(9, 'Kilian Pineda Vega', 'Hijo', 'PIVK960911HQTNGL05', 'Santiago Maravatio #125');


-- Dumping data for table `puesto`
INSERT INTO `puesto` (`idPuesto`, `nombre`) VALUES
(1, ' Hermana'),
(2, ' Educadora'),
(3, ' Director General'),
(4, 'Director Administrativo'),
(5, 'Lavandería'),
(6, 'Cocina'),
(7, 'Empleado General'),
(8, 'Guardia Nocturna'),
(9, 'Intendencia'),
(10, 'Mantenimiento/Transporte'),
(11, 'Chofer'),
(12, 'Asistente Administratico');

INSERT INTO `estadocivil` (`idEstCivil`, `nombre`) VALUES
(1, 'Soltero'),
(2, 'Casado Bienes Mancomunados'),
(3, 'Divorciado'),
(4, 'Viudo'),
(5, 'Casado Bienes Separados'),
(6, 'Unión Libre');

-- Dumping data for table `empleado`


INSERT INTO `empleado` (`idEmpleado`, `idPuesto`, `idEstCivil`, `estado`, `nombre`, `fechaNacimiento`, `estadoNacimiento`, `curp`, `rfc`, `segSocial`, `infonavit`, `direccion`, `telefono`, `celular`, `correo`, `fechaI`, `voluntario`, `diasT`, `horasT`, `escolaridad`, `nBeneficiarios`, `fegreso`, `motivoegreso`) VALUES
(1, 2, 1, 'activo', 'Ana Laura Torres Hernández', '1982-02-07', 'Jalisco', 'TOHA820207MJCRRN08', 'TOHA820207DJ6', 2188253831, NULL, 'Av. Pie de la Cuesta #2251,  Lomas de San Pedrito Peñuelas. Qro, Qro, 76148', '4422434735', '4422501190', 'suoranahjbp@hotmail.com', '2000-04-30', 0, NULL, NULL, 'Licenciatura en Educacion', NULL, NULL, NULL),
(2, 5, 4, 'activo', 'Angélica Robles Padilla', '1970-07-25', 'Querétaro', 'PARA700725MQTDBN01', 'PARA700725531', 14877023201, 2208067535, 'Calle Placer mod. f 26-8, Lomas de San Pedrito Peñuelas, 76148. Qro, Qro.', '4424337415', '4424337415', 'katisakura345@hotmail.com', '2018-08-20', 0, NULL, NULL, 'Enfermer?a Auxliar', 1, NULL, NULL),
(3, 1, 1, 'activo', 'Ana Lourder Miramontes Cerda', '1984-07-25', 'Jalisco', 'MICA840725MJCRRN08', 'MICA840725DVA', 4008480222, NULL, 'Av. Pie de la Cuesta #2251, Lomas de San Pedrito Peñuelas. Qro, Qro, 76148', '4422434735', '4422434735', NULL, '2000-10-03', 0, NULL, NULL, 'Preparatoria', 1, NULL, NULL),
(4, 3, 1, 'activo', 'Margarita Estrada Ayala', '1969-03-21', 'Jalisco', 'MICA840725MJCRRN08', 'EAAM690321K1', 489698421, NULL, 'Av. Pie de la Cuesta #2251, Lomas de San Pedrito Peñuelas. Qro, Qro, 76148', '4422434735', '4422501308', 'casamariagoretti@gotmail.com', NULL, 0, NULL, NULL, 'Carrera Comercial', NULL, NULL, NULL),
(5, 6, 2, 'activo', 'Liliana Quintero Herrera', '1970-02-06', 'Distrito Federal', 'QUHL700206MDFNRL09', 'QUHL700206V56', 4590701606, NULL, 'Cerbatana #26, Lomas de San Pedrito Peñuelas, Qro, Qro, 76148', '4424232339', '4424232339', 'qhanalili@gmail.com', '2000-12-31', 0, NULL, NULL, 'Secundaria', NULL, NULL, NULL),
(6, 7, 2, 'activo', 'Johana Gutierrez Jimenez', '1988-06-02', 'Distrito Federal', 'GUJJ880602MDFTMH00', 'GUJJ880602MQ8', 14078819407, NULL, 'Calle Placer #22, Lomas de San Pedrito Peñuelas, Qro, Qro, 76148', '4426012832', '4426012832', 'kiss_3028@live.com.mx', '2000-08-01', 0, NULL, NULL, 'Secundaria', 1, NULL, NULL),
(7, 8, 1, 'activo', 'Maria Luisa Jimenez Hernandez', '1963-03-12', 'Distrito Federal', 'JIHL630312MDFMRS05', 'JIHL6303123G2', 14996302189, NULL, 'Calle Placer #22, Lomas de San Pedrito Peñuelas, Qro, Qro, 76148', '4423828619', '4423828619', 'malu_120363@live.com', '2000-09-01', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 5, 1, 'activo', 'Martha Tagle Reynoso', '1965-02-01', 'Guerrero', 'TARM640729MGRGYR08', 'TARM640729HZ7', 1406640018, NULL, 'Calle Placer #18, Lomas de San Pedrito Peñuelas, Qro, Qro, 76148', '4423904433', '4423904433', 'matagle_64@hotmail.com', '2000-10-07', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 9, NULL, 'activo', 'Socorro Aguado Lozada', '1965-11-16', 'Querétaro', 'AULS651116MQTGZC01', 'AULS651116RC9', 1483651582, 212000000000, 'Calle Cerbatana #23-3, Lomas de San Pedrito Peñuelas, Qro, Qro, 76128', '4422284283', '4422284283', NULL, '2000-08-30', 0, NULL, NULL, NULL, 1, NULL, NULL),
(10, 12, 1, 'activo', 'Ana Karen Trejo Farias', '2000-08-06', 'Querétaro', 'TEFA920806MQTRRN02', 'TEFA920806QL7', NULL, NULL, 'Peña de Bernal #606, Las Américas, Qro, Qro, 76121', '4428066475', '4424238067', 'karen_trejo13@hotmail.com', '2000-09-03', 0, NULL, NULL, 'Licenciatura en Mercadotecnia', 1, NULL, NULL),
(11, 10, 2, 'inactivo', 'Esteban Julián Ramírez Hernández', '1981-11-28', 'San Luis Potosí', 'RAHE811128HSPMRS00', 'RAHE811128C16', 43998188759, NULL, 'Faccionamiento del Bosque, Qro, Qro', '4425971525', '4425971525', 'ESTEBAN28111981@GMAIL.COM', '2000-02-21', 0, NULL, NULL, 'Preparatoria CCUM', 1, NULL, 'Esperando bebé'),
(12, 11, 6, 'inactivo', 'J. Francisco Corona Olvera', '1980-08-12', 'Querétaro', 'COOF800812HQTRLR29', 'COOJ8008126KA', 2188030049, NULL, 'Cerro del Tzirate # 241, Las Américas, 76140 Qro, Qro', NULL, '4424754463', 'coronaf9@gmail.com', '2000-03-12', 0, NULL, NULL, NULL, 1, '2019-11-22', 'Tema con Isabel'),
(13, 10, 6, 'inactivo', 'Armando Medina Cruz', '1979-10-27', 'Guanajuato', 'MECA791027HGTDRR05', 'MECA7910279K2', 2167971270, NULL, 'Jardines de la Hacienda #26, Las Maravillas, Qro, Qro, 76147', '4428394928', '4428394928', 'tonamedina79@gmail.com', '2000-08-26', 0, NULL, NULL, 'Secundaria', 1, '2019-09-07', 'Le ofrecieron trabajo como chofer de oxxo'),
(14, 5, 2, 'inactivo', 'Josefina Vega Navarro', '1972-03-20', '', 'VENJ720320MQTGVS06', 'VGNVJS72032022M400', 14907207634, NULL, 'Santiago Maravatio #125', '4424536874', '4424536874', NULL, '2000-04-11', 0, NULL, NULL, NULL, 1, NULL, NULL),
(15, 11, 2, 'inactivo', 'Juvenal Aguilar Rodriguez', '1973-01-09', 'Querétaro', 'AURJ730109HQTGDR08', 'AURJ730109Q86', NULL, NULL, 'Villas de Santiago, Santiago de Tuxtla', NULL, NULL, NULL, '2000-11-04', 0, NULL, NULL, NULL, NULL, '2015-06-07', 'Renuncia'),
(16, 11, NULL, 'inactivo', 'Luis Arias Jimenez', '1983-10-11', 'Querétaro', 'AIJL831110HQTRM501', 'AIJL8311103T9', 3158306708, NULL, 'Villas de Santiago, Santiago de Tuxtla', '4481113413', '4481113413', NULL, '2000-11-04', 0, NULL, NULL, NULL, NULL, '2016-11-30', 'Renuncia'),
(17, 10, 2, 'inactivo', 'Maria Cabello Breña', '1965-08-11', 'Querétaro', 'CABM650811MQTCRR06', 'CABM6508118S8', 14826522980, 212000000000, 'Lomas de San Pedrito Peñuelas', '4422432613', '4422432613', NULL, '2000-08-23', 0, NULL, NULL, NULL, NULL, '2015-09-01', 'Renuncia'),
(18, 7, NULL, 'inactivo', 'Rosario Ureña Castellanos', '1970-11-02', 'Oaxaca', 'UECR701102MOCRSS07', 'CABM6508118S8', NULL, NULL, 'Mujeres Independientes', '4423442579', '4423442579', 'rosaurena_castellanos@hotmail.com', '2000-08-23', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 12, NULL, 'inactivo', 'Manuel Molina Centeno', '1960-06-16', 'Querétaro', 'MOCM600616HGTLNN09', 'MOCM600416', NULL, NULL, 'Lomas de San Pedrito Peñuelas', '4423272249', '4423272249', NULL, '2000-01-01', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 5, NULL, 'inactivo', 'Silvia García Ortiz', '1967-05-18', 'Guanajuato', 'GA05670518MGTRRL02', 'GA05670518PB7', 1287672743, NULL, 'Lomas de San Pedrito Peñuelas', '4281270601', '4281270601', NULL, '2000-01-01', 0, NULL, NULL, NULL, NULL, '2018-02-26', 'Renuncia'),
(21, 11, 2, 'inactivo', 'Liborio Rico Martinez', '1966-07-23', 'Querétaro', 'RIML660723HQTCRB07', 'RIML660723', 14886615039, NULL, 'Acceso Homero #29, La Ecológica', '4424570642', '4281270601', NULL, '2000-10-10', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 5, 1, 'inactivo', 'Juana Olalde Pacheco', '1981-11-03', 'Querétaro', 'OLPCJN81110322M200', 'OAPJ811034J2', NULL, NULL, 'Andador 16, Menchaca II', '4427181496', '4227181496', NULL, '2000-01-01', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 11, 2, 'inactivo', 'Mauricio Aguilar Pacheco', '1976-06-23', 'Amealco', 'AURM760623HQT6DR05', 'AURM760623D80', NULL, NULL, 'Villas de Santiago, Santiago de Tuxtla', '4425596109', '4425596109', NULL, '2000-11-01', 0, NULL, NULL, NULL, NULL, '2016-07-04', 'Renuncia'),
(24, 11, 2, 'inactivo', 'J. Carmen Rivera Granados', '1992-07-31', 'Querétaro', 'RIGC920731HQTVRR05', 'RIGJ9207313N7', 19149241564, NULL, 'Mujeres Independientes', '4421079075', '4421079075', NULL, '2000-07-04', 0, NULL, NULL, NULL, NULL, '2016-10-08', 'Renuncia'),
(25, 7, 2, 'inactivo', 'Ma. Dolores Trenado Luna', '1967-06-30', 'Querétaro', 'TELD670630MQTRNL200', NULL, 1485670674, NULL, 'Epigmenio González, Buenos Aires', '4421079075', '4421079075', NULL, '2000-08-01', 0, NULL, NULL, NULL, NULL, '2017-05-30', 'Renuncia'),
(26, 11, 2, 'inactivo', 'David Ramírez Rodríguez', '1977-12-29', 'Guanajuato', 'RARD771229HGTMDV03', NULL, 1496771782, NULL, 'Unidad Nacional MZ #550', NULL, NULL, NULL, '2000-11-14', 0, NULL, NULL, NULL, NULL, '2014-09-16', 'Renuncia'),
(27, 12, NULL, 'inactivo', 'Laura Villegas Estrella', '1967-09-16', 'Querétaro', 'VIEL670916MQTGSR06', NULL, 1485680743, NULL, 'Lomas de San Pedrito Peñuelas', '4422433665', '4422433665', NULL, '2000-01-01', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 7, 2, 'inactivo', 'Luis Morales Luna', '1946-07-23', 'Querétaro', 'MOLL460723HQTRNS06', NULL, 163462307, NULL, 'Lomas de San Pedrito Peñuelas', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL);


-- Dumping data for table `benef_empleado`
INSERT INTO `benef_empleado` (`idBenefN`, `idEmpleado`, `porcentaje`) VALUES
(1, 11, '100'),
(2, 2, '100'),
(3, 3, '100'),
(4, 6, '100'),
(5, 9, '100'),
(6, 12, '100'),
(7, 13, '100'),
(8, 10, '100'),
(9, 14, '100');

-- Dumping data for table `Especialidad`

INSERT INTO `especialidad` (`idEspecialidad`, `nombre`) VALUES
(1, 'Pediatría'),
(2, 'Gastrointerología'),
(3, 'Cardiología'),
(4, 'Oncología'),
(5, 'Cirugía General'),
(6, 'Neuropediatría'),
(7, 'Paidopsiquiatría'),
(8, 'Dermatología');


-- Dumping data for table `Medico`
INSERT INTO `medico` (`idMedico`, `idEspecialidad`, `nombre`, `apellido`, `direccion`, `telefono`, `celular`, `correo`) VALUES
(1, 6, 'Laura', 'Mendoza', 'Hospital Santa Cruz, Avenida Circunvalación, Centro, Santiago de Querétaro, Qro.', '', '', ''),
(2, 3, 'Juan Diego', 'Rodríguez', 'Unidad Médica La Capilla, Prolongación Avenida Zaragoza, Los Virreyes, Santiago de Querétaro, Qro.', '', '', ''),
(3, 8, 'Judith', 'Perez Rendón', 'Unidad Médica La Capilla, Prolongación Avenida Zaragoza, Los Virreyes, Santiago de Querétaro, Qro.', '', '', ''),
(4, 7, 'Andy de la Luz', 'Flores Castillo', 'Clínica Especializada Carrizal, Los Morales, El Carrizal, Santiago de Querétaro, Qro.', '', '', '');


-- Dumping data for table `TipodeDonante`

INSERT INTO `tipodeDonante` (`idTipo`, `nombre`) VALUES
(1, ' Empresa'),
(2, ' Gobierno'),
(3, ' Particular'),
(4, ' Cargo a tarjetas'),
(5, ' Patronato'),
(6, ' Fundaciones'),
(7, ' Otros contactos');

-- Dumping data for table `donantes`
INSERT INTO `donantes` (`idDonante`, `idTipo`, `fechaRegistro`, `contactoInterno`, `nombreDonante`, `correoParticular`, `telefonoParticular`, `extensionParticular`, `celularParticular`, `fechaNacParticular`, `razonSocial`, `RFCEntidad`, `direccionEntidad`, `cpEntidad`, `fechaFinDonaciones`, `motivoFinDonaciones`) VALUES
(1, 2, '2020-04-22 21:01:29', 'admin', 'DIF Municipal', NULL, NULL, NULL, NULL, NULL, 'SISTEMA MUNICIPAL PARA EL DESARROLLO INTEGRAL DE LA FAMILIA', 'SMD860306MD8', 'Av. Bernardo Quintana Facc Centro Sur No. 10000 No. Int anexo &quot;A&quot;, Col. Fraccionamiento Centro Sur, Querétaro, Querétaro, México', '76090', NULL, NULL),
(2, 1, '2020-04-22 21:01:29', 'Gerardo Proal', 'Supraterra', NULL, NULL, NULL, NULL, NULL, 'SERVICIOS PANGEA/SUPRA TERRA SA DE CV', 'SPT1201175G3', 'Av Antea No. 1088 No. Int Piso 9, Col. Jurica, Querétaro, Querétaro, México', '76100', NULL, NULL),
(3, 1, '2020-04-22 21:01:29', 'Isabel', 'Martinrea', NULL, NULL, NULL, NULL, NULL, 'MARTINREA HONSEL MEXICO, S.A. DE C.V.', 'TME001025LP0', 'Av La Montaña No. 121, Col. Parque Industrial Querétaro, Querétaro, México', '76220', NULL, NULL),
(4, 3, '2020-04-22 21:01:29', 'Admin', 'Dra. Catherine Delano Frier', 'catherine.delanof@gmail.com', '4422138332', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 3, '2020-04-22 21:01:29', 'Admin', 'Sr. Ignacio Montenegro Yépiz', 'ignacio@montenegro.com.mx', NULL, NULL, '4422265055', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 5, '2020-04-22 21:01:29', NULL, 'Dr. Faustino Llamas', 'llamasf@hotmail.com', '4422121522', NULL, '4421818391', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, '2020-04-22 21:01:29', NULL, 'Tractebel', NULL, NULL, NULL, NULL, NULL, 'TRACTEBEL DIGAQRO, S. A. de C. V.', 'TDI660211CR7', 'Acceso III No. 107. Parque Industrial Benito Juárez. Qro Qro', '76120', NULL, NULL),
(8, 1, '2020-04-22 21:01:29', '', 'Fundación Dr. Simi', NULL, NULL, NULL, NULL, NULL, 'FUNDACION DEL DR. S I M I , A. C.', 'FDS0506076U9', 'Alemania # 10, Col. Independencia, Del. Benito Juárez, México, D.F.', '3630', NULL, NULL),
(9, 5, '2020-04-22 21:01:29', NULL, 'Marco Antonio Llamas', 'marcollamas92@yahoo.com.mx', NULL, NULL, '4422300835', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 4, '2020-04-22 21:01:29', NULL, 'Alejandra Parrodi Espinosa', 'alejandraparrodi@msn.com', '4422458384', NULL, NULL, '1990-11-26', NULL, NULL, NULL, NULL, NULL, NULL);


-- Dumping data for table `contactoDonante`

INSERT INTO `contactoDonante` (`idContacto`, `idDonante`, `nombre`, `apellido`, `cargo`, `correo`, `telefono`, `extension`, `celular`, `fechaNacimiento`) VALUES
(1, 1, 'Alejandro', 'Cano Alcalá', 'Director del SMDIF', 'alejandro.cano@municipiodequeretaro.gob.mx', NULL, NULL, NULL, NULL),
(2, 1, 'María Elena', 'Balderas', 'Coordinación de Vinculación con OSC', 'maria.balderas@municipiodequeretaro.gob.mx', '(442) 238-7700', 5223, NULL, NULL),
(3, 2, 'Mariana Rocio', 'Tucari Morales', NULL, 'mtucari@supraterra.com.mx', NULL, NULL, '(442) 263-3073', NULL),
(4, 3, 'Juan José', 'Nardiz', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 3, 'Ana Celia', 'Garcia Canizal', 'Gerente de RH', 'ana.garcia@martinrea.com', '(442) 229-4600', 656, '(442) 127-5098', NULL),
(6, 7, 'Mariana ', 'Mercado', NULL, 'mariana.mercado@gdfsuezna.com', '192-7400', 7465, NULL, NULL),
(7, 8, 'Lety', NULL, NULL, 'asis_qro@fundaciomndrsimi.org.mx', '214-1745', NULL, NULL, NULL);




-- Dumping data for table `privilegio`
INSERT INTO `privilegio` (`id`, `nombre`, `created_at`) VALUES
(1, ' ver beneficiarias', '2020-04-03 00:24:18'),
(2, 'modificar beneficiarias', '2020-04-03 00:24:18'),
(3, 'registrar beneficiarias', '2020-04-03 00:24:18'),
(4, 'eliminar beneficiarias', '2020-04-03 00:24:18'),
(5, ' registrar empleado', '2020-04-03 00:24:18'),
(6, ' modificar empleado', '2020-04-03 00:24:19'),
(7, ' eliminar empleado', '2020-04-03 00:24:20'),
(8, 'ver empleado', '2020-04-03 00:24:21'),
(9, ' registrar donante', '2020-04-03 00:24:22'),
(10, ' modificar donante', '2020-04-03 00:24:23'),
(11, ' eliminar donante', '2020-04-03 00:24:24'),
(12, 'ver donante', '2020-04-03 00:24:25'),
(13, 'subir foto beneficiaria', '2020-04-03 00:24:26');

-- Dumping data for table `rol`

INSERT INTO `rol` (`id`, `nombre`, `descripcion`, `created_at`) VALUES
(1, ' administrador', ' ', '2020-04-03 00:24:18'),
(2, ' empleadoGeneral', ' ', '2020-04-03 00:24:18'),
(3, ' empleadoPreferente', ' ', '2020-04-03 00:24:18');


-- Dumping data for table `usuario`
INSERT INTO `usuario` (`id`, `usuario`, `password`, `nombre`, `created_at`) VALUES
(1, 'eric', '$2y$10$BdSED8W6XI8DL/RxTJ4i7OX7OLE41AQOzfl9C2P/3Ii2YCvx6ElQm', 'Eric', '2020-04-27 14:28:01'),
(2, 'angie', '$2y$10$75xH6ceUcx4wGHUKZRtnpuFN7a.EVKRM1TM8Yy/WvdgWQDqDbJ53y', 'Angie', '2020-04-27 14:28:32'),
(3, 'emilio', '$2y$10$.K20MfOOJPlRpFidbAMt6e7WfolUy0vy3Sbt8iOUZoo3DbRrtx3ue', 'Emilio', '2020-04-27 14:28:47'),
(4, 'mariana', '$2y$10$NyEIN6R9R5RdKECDKPuOPug62tGs9EHmQ5rcW6SnSrcLShMfaCRzW', 'Mariana', '2020-04-27 14:30:01'),
(5, 'karla', '$2y$10$YeYN0KxpjSu2N8ifP.vFFewcqV7yqlks7EFhCprhkpYqwJybis5f.', 'Karla', '2020-04-27 14:47:38'),
(6, 'general', '$2y$10$dOURxsDuLi8BNatVDy1h/eyCmTZWirbC0VJH4mKQBUyZ7ixkerwVC', 'empleado general', '2020-04-28 00:29:13'),
(7, 'preferente', '$2y$10$h0toF2XvEsycxRILYr0IRuB8DF64GWU/KWP3Wcs1ludSrlhMoqrn.', 'Empleado preferente', '2020-04-28 00:29:41');


-- Dumping data for table `desempenia`
INSERT INTO `desempenia` (`id`, `usuario_id`, `rol_id`, `created_at`) VALUES
(1, 1, 1, '2020-04-27 09:28:01'),
(2, 2, 1, '2020-04-27 09:28:32'),
(3, 3, 1, '2020-04-27 09:28:47'),
(4, 4, 1, '2020-04-27 09:30:01'),
(5, 5, 1, '2020-04-27 09:47:38'),
(6, 6, 2, '2020-04-27 19:29:13'),
(7, 7, 3, '2020-04-27 19:29:41');


-- Dumping data for table `obtiene`
INSERT INTO `obtiene` (`id`, `rol_id`, `privilegio_id`, `created_at`) VALUES
(1, 1, 2, '2020-04-03 00:24:18'),
(2, 2, 3, '2020-04-03 00:24:18'),
(3, 3, 2, '2020-04-03 00:24:18');


-- Llenar tabla plantillaReporte
INSERT INTO `plantillaReporte` (`idPlantilla`, `nombre`, `tipoGrafica`, `query`) VALUES
(1, 'calendario para niñas', 0, ''),
(2, 'beneficiarias ingresadas', 3, 'select nombre from Beneficiarias'),
(3, 'porcentaje de donaciones', 2, 'select avg(cantidad) from Donativo'),
(4, 'beneficiarias por edad', 1, 'select edad from Beneficiarias')(4, 'beneficiarias por edad', 1, 'select edad from Beneficiarias'),
(5, 'Diagnosticos de beneficiarias activas', NULL, NULL),
(6, 'evaluación de pruebas', NULL, NULL),
(7, 'históricos de donaciones', NULL, NULL);
