-- Agregar store procedure
DELIMITER //
CREATE PROCEDURE `agregarIncidente`(
Lugar INT(11),
Tipo INT(11),
pfecha timestamp
)
BEGIN
	INSERT INTO incidente (idLugar, idTipo, fecha) values (Lugar, Tipo, pfecha);
END //
DELIMITER ;
