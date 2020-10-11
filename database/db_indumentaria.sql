-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 11, 2020 at 03:12 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_indumentaria`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `coleccion` varchar(35) NOT NULL,
  `url_img` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id`, `coleccion`, `url_img`) VALUES
(1, 'Colección Otoño 2020', 'https://images.pexels.com/photos/1777321/pexels-photo-1777321.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260'),
(13, 'Colección primavera 2021', 'https://decoracionyjardines.com/wp-content/uploads/2015/04/Flores-para-decorar-en-primavera-1.jpg'),
(15, 'Colección otoño 2021', 'https://imagenes.milenio.com/KwMz7kuKcaOBJB0C8rrPu40Myy8=/936x566/https://www.milenio.com/uploads/media/2019/09/20/el-de-septiembre-es-la_0_10_500_312.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `color` varchar(10) NOT NULL,
  `talle` varchar(10) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `tipo`, `color`, `talle`, `id_categoria`) VALUES
(7, 'Zapatillas', 'Rojo Flama', 'XXXL', 1),
(10, 'Pantalon', 'Verde', 'X', 1),
(13, 'Camisa', 'Amarillo', 'XS', 1),
(14, 'Zapatillas', 'Gris', 'XS', 1),
(16, 'Buzo', 'Negro', 'XXXL', 15),
(17, 'Zapatillas', 'Gris', 'XXXL', 13),
(18, 'Camisa', 'Amarillo', 'XS', 13),
(19, 'Jean', 'Gris', 'S', 13),
(20, 'Camisa', 'Amarillo', 'XS', 13),
(21, 'Zapatillas', 'Gris', 'XS', 13),
(22, 'Buzo', 'Verde', 'XXL', 1),
(23, 'Sueter', 'Verde', 'XS', 15),
(24, 'Camisa', 'Gris', 'XXXL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(50) NOT NULL,
  `user` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `user`, `email`, `password`, `admin`) VALUES
(1, 'usuario', 'usuario@uno.com', '$2y$10$yppTcGTXlZWE4scjl8lVce5aaMm.ZlMPDkeiqG5fCie32LnVBrEM.', 0),
(2, 'administradorUno', 'admin@uno.com', '$2y$10$guxOazOWv/DwW5U48k04SOJWClIZ11UgSq6DFwr4dCk', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo` (`id_categoria`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
