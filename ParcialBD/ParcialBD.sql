-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 06, 2020 at 05:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ParcialBD`
--

-- --------------------------------------------------------

--
-- Table structure for table `incidente`
--
DROP TABLE IF EXISTS `incidente`;
CREATE TABLE `incidente` (
  `idIncidente` int(11) NOT NULL,
  `idLugar` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lugar`
--
DROP TABLE IF EXISTS `lugar`;
CREATE TABLE `lugar` (
  `idLugar` int(11) NOT NULL,
  `nombreLugar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--
DROP TABLE IF EXISTS `tipo`;
CREATE TABLE `tipo` (
  `idTipo` int(11) NOT NULL,
  `nombreTipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incidente`
--
ALTER TABLE `incidente`
  ADD PRIMARY KEY (`idIncidente`),
  ADD KEY `idLugar` (`idLugar`),
  ADD KEY `idTipo` (`idTipo`);

--
-- Indexes for table `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`idLugar`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`idTipo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incidente`
--
ALTER TABLE `incidente`
  MODIFY `idIncidente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lugar`
--
ALTER TABLE `lugar`
  MODIFY `idLugar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incidente`
--
ALTER TABLE `incidente`
  ADD CONSTRAINT `incidente_ibfk_1` FOREIGN KEY (`idLugar`) REFERENCES `lugar` (`idLugar`),
  ADD CONSTRAINT `incidente_ibfk_2` FOREIGN KEY (`idTipo`) REFERENCES `tipo` (`idTipo`);
COMMIT;


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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- Cargar datos a tablas
INSERT INTO `lugar` (`idLugar`, `nombreLugar`) VALUES
('1', 'Centro turístico'),
('2', 'Laboratorios'),
('3', 'Restaurante'),
('4', 'Centro operativo'),
('5', 'Triceratops'),
('6', 'Dilofosaurios'),
('7', 'Velociraptors'),
('8', 'TRex'),
('9', 'Planicie de los herbívoros');


-- Cargar datos a tablas
INSERT INTO `tipo` (`idTipo`, `nombreTipo`) VALUES
('1', 'Falla eléctrica'),
('2', 'Fuga de herbívoro'),
('3', 'Fuga de Velociraptors'),
('4', 'Fuga de TRex'),
('5', 'Robo de ADN'),
('6', 'Auto descompuesto'),
('7', 'Visitantes en zona no autorizada');


INSERT INTO `incidente` (`idIncidente`, `idLugar`, `idTipo`, `fecha`) VALUES
('1', '1', 1, current_timestamp()),
('2',  '1', 2, current_timestamp());
