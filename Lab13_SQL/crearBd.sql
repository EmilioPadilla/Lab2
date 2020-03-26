/*
Destruir bases de datos en caso de que existan
*/
DROP TABLE IF EXISTS Materiales;
DROP TABLE IF EXISTS Proveedores;
DROP TABLE IF EXISTS Proyectos;
DROP TABLE IF EXISTS Entregan;

/*
Crear tablas
*/
CREATE TABLE Materiales (
  /*
  Not null asegura que siempre se cargue una entrada, Clave se incluya dentro de dicha entrada, esto evita errores futuros
  */
  Clave numeric(5) not null,
  Descripcion varchar(50),
  Costo numeric(8,2)
);

CREATE TABLE Proyectos
(
  Numero numeric(5) not null,
  Denominacion varchar(50)
);

CREATE TABLE Proveedores
(
  RFC char(13) not null,
  RazonSocial varchar(50)
);

CREATE TABLE Entregan
(
  Clave numeric(5) not null,
  RFC char(13) not null,
  Numero numeric(5) not null,
  Fecha DateTime not null,
  Cantidad numeric (8,2)
);

/*
Cargar archivos de tablas en bases de datos
*/
LOAD DATA INFILE 'materiales.csv'
INTO TABLE Lab12.Materiales
FIELDS TERMINATED BY ','
(Clave,Descripcion,Costo);

LOAD DATA INFILE 'proveedores.csv'
INTO TABLE Lab12.Proveedores
FIELDS TERMINATED BY ','
(RFC,RazonSocial);

LOAD DATA INFILE 'proyectos.csv'
INTO TABLE Lab12.Proyectos
FIELDS TERMINATED BY ','
(Numero,Denominacion);

LOAD DATA INFILE 'entregan.csv'
INTO TABLE Lab12.Entregan
FIELDS TERMINATED BY ','
(Clave,RFC,Numero, @Fecha,Cantidad)
SET Fecha = STR_TO_DATE(@Fecha, '%d/%m/%Y')
