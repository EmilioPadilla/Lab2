/*Crear tabla Materiales*/
DROP TABLE IF EXISTS Materiales;
CREATE TABLE `Materiales` (
 `Clave` decimal(5,0) NOT NULL,
 `Descripcion` varchar(50) DEFAULT NULL,
 `Costo` decimal(8,2) DEFAULT NULL,
 PRIMARY KEY (`Clave`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOAD DATA INFILE 'materiales.csv'
INTO TABLE Lab14.Materiales
FIELDS TERMINATED BY ',';


/*Crear tabla Proyectos*/
DROP TABLE IF EXISTS Proyectos;
CREATE TABLE `Proyectos` (
 `Numero` decimal(5,0) NOT NULL,
 `Denominacion` varchar(50) DEFAULT NULL,
 PRIMARY KEY (`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOAD DATA INFILE 'proyectos.csv'
INTO TABLE Lab14.Proyectos
FIELDS TERMINATED BY ',';


/*Crear tabla Proveedores*/
DROP TABLE IF EXISTS Proveedores;
CREATE TABLE `Proveedores` (
 `RFC` char(13) NOT NULL,
 `RazonSocial` varchar(50) DEFAULT NULL,
 PRIMARY KEY (`RFC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOAD DATA INFILE 'proveedores.csv'
INTO TABLE Lab14.Proveedores
FIELDS TERMINATED BY ',';



/*Crear tabla Entregan*/
DROP TABLE IF EXISTS Entregan;
CREATE TABLE `Entregan` (
 `Clave` decimal(5,0) NOT NULL,
 `RFC` char(13) NOT NULL,
 `Numero` decimal(5,0) NOT NULL,
 `Fecha` datetime NOT NULL,
 `Cantidad` decimal(8,2) DEFAULT NULL,
 PRIMARY KEY (`Clave`,`RFC`,`Numero`,`Fecha`),
 KEY `fkentreganrfc` (`RFC`),
 KEY `cfentregannumero` (`Numero`),
 CONSTRAINT `cfentregannumero` FOREIGN KEY (`Numero`) REFERENCES `Proyectos` (`Numero`),
 CONSTRAINT `entregan_ibfk_1` FOREIGN KEY (`Clave`) REFERENCES `Materiales` (`Clave`),
 CONSTRAINT `fkentreganrfc` FOREIGN KEY (`RFC`) REFERENCES `Proveedores` (`RFC`),
 CONSTRAINT `Cantidad` CHECK (`Cantidad` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Set Formato Fecha  */
LOAD DATA INFILE 'entregan.csv'
INTO TABLE Lab14.Entregan
FIELDS TERMINATED BY ','
(Clave,RFC,Numero, @Fecha,Cantidad)
SET Fecha = STR_TO_DATE(@Fecha, '%d/%m/%Y');
