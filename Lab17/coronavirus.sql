-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2020 at 04:10 AM
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
-- Database: `coronavirus`
--

-- --------------------------------------------------------

-- Table structure for table `caso`
--
DROP TABLE IF EXISTS `caso`;
CREATE TABLE `caso` (
  `id` int(11) NOT NULL,
  `lugar_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `caso`
--

INSERT INTO `caso` (`id`, `lugar_id`, `created_at`) VALUES
(1, 2, '2020-03-27 01:34:34'),
(2, 3, '2020-03-27 01:34:34'),
(3, 4, '2020-03-27 01:34:47'),
(4, 4, '2020-03-27 01:34:47'),
(5, 5, '2020-03-27 01:34:57'),
(6, 5, '2020-03-27 01:34:57'),
(7, 5, '2020-03-27 01:35:04'),
(8, 5, '2020-03-27 01:35:04'),
(9, 5, '2020-03-27 01:35:11'),
(10, 5, '2020-03-27 01:35:11'),
(11, 6, '2020-03-27 01:35:18'),
(12, 5, '2020-03-27 01:35:18'),
(13, 2, '2020-04-03 19:16:29'),
(14, 5, '2020-04-03 20:35:15'),
(15, 5, '2020-04-04 05:54:55'),
(16, 1, '2020-04-12 21:51:27'),
(17, 1, '2020-04-12 21:53:04'),
(18, 1, '2020-04-12 21:53:32'),
(19, 1, '2020-04-12 21:57:12'),
(20, 1, '2020-04-12 21:58:22'),
(21, 1, '2020-04-12 22:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `desempenia`
--
DROP TABLE IF EXISTS `desempenia`;
CREATE TABLE `desempenia` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desempenia`
--

INSERT INTO `desempenia` (`id`, `usuario_id`, `rol_id`, `created_at`) VALUES
(1, 1, 1, '2020-04-03 00:24:38'),
(2, 2, 2, '2020-04-03 00:24:38'),
(3, 3, 3, '2020-04-12 23:30:30'),
(4, 4, 2, '2020-04-12 23:33:30'),
(5, 5, 1, '2020-04-13 01:12:02'),
(6, 6, 3, '2020-04-13 01:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--
DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id`, `nombre`) VALUES
(1, 'Infectado'),
(2, 'Muerto'),
(3, 'Recuperado'),
(4, 'Negativo');

-- --------------------------------------------------------

--
-- Table structure for table `lugar`
--
DROP TABLE IF EXISTS `lugar`;
CREATE TABLE `lugar` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lugar`
--

INSERT INTO `lugar` (`id`, `nombre`) VALUES
(1, 'Queretarock'),
(2, 'Celayork'),
(3, 'Chiapaslovakia'),
(4, 'Michigan'),
(5, 'CDMX'),
(6, 'Colombia');

-- --------------------------------------------------------

--
-- Table structure for table `obtiene`
--
DROP TABLE IF EXISTS `obtiene`;
CREATE TABLE `obtiene` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obtiene`
--

INSERT INTO `obtiene` (`id`, `rol_id`, `permiso_id`, `created_at`) VALUES
(1, 1, 2, '2020-04-03 00:22:58'),
(2, 1, 1, '2020-04-03 00:22:58'),
(3, 2, 1, '2020-04-03 00:23:09'),
(4, 3, 1, '2020-04-12 22:27:40'),
(5, 3, 2, '2020-04-12 22:27:40'),
(6, 3, 3, '2020-04-12 22:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `permiso`
--
DROP TABLE IF EXISTS `permiso`;
CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(80) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permiso`
--

INSERT INTO `permiso` (`id`, `nombre`, `descripcion`, `created_at`) VALUES
(1, 'ver', NULL, '2020-04-03 00:20:33'),
(2, 'registrar', NULL, '2020-04-03 00:20:33'),
(3, 'administrar', NULL, '2020-04-12 22:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` varchar(80) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `descripcion`, `created_at`) VALUES
(1, 'laboratorista', NULL, '2020-04-03 00:21:05'),
(2, 'usuario_registrado', NULL, '2020-04-03 00:21:05'),
(3, 'admin', NULL, '2020-04-12 22:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `tiene`
--
DROP TABLE IF EXISTS `tiene`;
CREATE TABLE `tiene` (
  `caso_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiene`
--

INSERT INTO `tiene` (`caso_id`, `estado_id`, `created_at`) VALUES
(1, 1, '2020-03-27 01:36:35'),
(2, 1, '2020-03-27 01:36:35'),
(3, 1, '2020-03-27 01:36:51'),
(4, 1, '2020-03-27 01:36:51'),
(5, 1, '2020-03-27 01:37:19'),
(6, 1, '2020-03-27 01:37:19'),
(7, 1, '2020-03-27 01:37:48'),
(7, 2, '2020-03-27 01:38:03'),
(8, 1, '2020-03-27 01:38:03'),
(9, 1, '2020-03-27 01:38:12'),
(9, 3, '2020-03-27 01:38:20'),
(10, 4, '2020-03-27 01:38:32'),
(11, 1, '2020-03-27 01:38:46'),
(12, 1, '2020-03-27 01:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` longtext NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `password`, `nombre`, `created_at`) VALUES
(1, 'hulk', 'e62dd6c40250a6631dc6b041ad9c1b346b28ac0f7ca35db43fac12c87caac7464a33286ea588784ee1a585bd70480de1e97299d729492f5850637d6383ab7c7d', 'Bruce Banner', '2020-04-03 00:24:18'),
(2, 'lalo', '31d490a56c702837147343b35eb0c75adbae94327c70fb14607a8f6d591badaf8d046f0d2a806e6a294bbdcc406ae0a10106fffe1ec2effe1a9b9e60ddea04d7', 'Eduardo', '2020-04-03 00:24:18'),
(3, 'eric', '0f81a727b4f34041863af773bd92735e294cf7efb6a8f4d4ce0058e5de84ef9b23bbdd84847a5583e7d6f0efd23444017227f9dacd42244045235d9aca913ff5', 'eric', '2020-04-12 23:30:29'),
(4, 'prueba', '45ce5aed3aa5f3acbf166efe152514c3f5f0ef30559e475d0988199b162374c54716050bd1b0ed14d40f45e5377efe72f255963ab503a272067eb306b6254698', 'prueba', '2020-04-12 23:33:30'),
(5, 'lab', '04cfd86bc6c5f24ead43a179cdb995c8f5f425c6ebea925042c72342657acbbf6915baf429f9732b311c3b95438a411b8cf49bd7dda4b7193f2bc7076fca1171', 'lab', '2020-04-13 01:12:01'),
(6, 'admin', '8450eca01665516d9aeb5317764902b78495502637c96192c81b1683d32d691a0965cf037feca8b9ed9ee6fc6ab8f27fce8f77c4fd9b4a442a00fc317b8237e6', 'admin', '2020-04-13 01:14:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caso`
--
ALTER TABLE `caso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caso_lugar_index` (`lugar_id`);

--
-- Indexes for table `desempenia`
--
ALTER TABLE `desempenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desempenia_index` (`usuario_id`,`rol_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obtiene`
--
ALTER TABLE `obtiene`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`,`permiso_id`),
  ADD KEY `permiso_id` (`permiso_id`);

--
-- Indexes for table `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiene`
--
ALTER TABLE `tiene`
  ADD KEY `caso_id` (`caso_id`),
  ADD KEY `estado_id` (`estado_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caso`
--
ALTER TABLE `caso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `desempenia`
--
ALTER TABLE `desempenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lugar`
--
ALTER TABLE `lugar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `obtiene`
--
ALTER TABLE `obtiene`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `caso`
--
ALTER TABLE `caso`
  ADD CONSTRAINT `caso_lugar` FOREIGN KEY (`lugar_id`) REFERENCES `lugar` (`id`);

--
-- Constraints for table `desempenia`
--
ALTER TABLE `desempenia`
  ADD CONSTRAINT `desempenia_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `desempenia_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);

--
-- Constraints for table `obtiene`
--
ALTER TABLE `obtiene`
  ADD CONSTRAINT `obtiene_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `obtiene_ibfk_2` FOREIGN KEY (`permiso_id`) REFERENCES `permiso` (`id`);

--
-- Constraints for table `tiene`
--
ALTER TABLE `tiene`
  ADD CONSTRAINT `tiene_caso` FOREIGN KEY (`caso_id`) REFERENCES `caso` (`id`),
  ADD CONSTRAINT `tiene_estado` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
