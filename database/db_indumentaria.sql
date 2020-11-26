-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2020 a las 18:01:05
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_indumentaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `coleccion` varchar(35) NOT NULL,
  `url_img` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `coleccion`, `url_img`) VALUES
(1, 'Colección Otoño 2020', 'https://images.pexels.com/photos/1777321/pexels-photo-1777321.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260'),
(13, 'Coleccion', 'https://decoracionyjardines.com/wp-content/uploads/2015/04/Flores-para-decorar-en-primavera-1.jpg'),
(15, 'Colección otoño 2021', 'https://imagenes.milenio.com/KwMz7kuKcaOBJB0C8rrPu40Myy8=/936x566/https://www.milenio.com/uploads/media/2019/09/20/el-de-septiembre-es-la_0_10_500_312.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `commentary`
--

CREATE TABLE `commentary` (
  `id` int(11) NOT NULL,
  `text` varchar(250) DEFAULT NULL,
  `star` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `commentary`
--

INSERT INTO `commentary` (`id`, `text`, `star`, `date`, `id_product`, `id_user`) VALUES
(2, 'COMENTARIO 2 EDITADO', 5, '2020-11-18', 1, 1),
(3, 'kjhvurfhdihfiisdhciohfkcjl<zxk´pjeiud1', 5, '2020-11-18', 1, 1),
(4, 'kjhvurfhdihfiisdhciohfkcjl<zxk´pjeiud1', 5, '2020-11-18', 1, 1),
(5, 'kjhvurfhdihfiisdhciohfkcjl<zxk´pjeiud1', 5, '2020-11-18', 1, 1),
(7, 'kjhvurfhdihfiisdhciohfkcjl<zxk´pjeiud1', 5, '2020-11-18', 1, 1),
(8, 'kjhvurfhdihfiisdhciohfkcjl<zxk´pjeiud1', 5, '2020-11-18', 1, 1),
(9, 'kjhvurfhdihfiisdhciohfkcjl<zxk´pjeiud1', 5, '2020-11-18', 1, 1),
(10, 'Algo que podamos reco', 5, '2020-11-18', 1, 1),
(11, 'kjhvurfhdihfiisdhciohfkcjl<zxk´pjeiud1', 5, '2020-11-18', 1, 1),
(12, 'COMENTARIO 2 EDITADO', 5, '2020-11-18', 7, 1),
(13, 'COMENTARIO 3 EDITADO', 5, '2020-11-18', 7, 1),
(14, 'COMENTARIO 5 EDITADO', 5, '2020-11-18', 7, 1),
(15, 'COMENTARIO 4 EDITADO', 5, '2020-11-18', 7, 1),
(16, 'Comentario 8', 3, '2020-11-25', 7, 0),
(17, 'Comentario 8', 3, '2020-11-25', 7, 0),
(18, 'kjhjadhfiohiñszx', 4, '2020-11-25', 7, 0),
(19, 'Comentario 8', 4, '2020-11-25', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `color` varchar(10) NOT NULL,
  `talle` varchar(10) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `tipo`, `color`, `talle`, `id_categoria`, `img`) VALUES
(7, 'Zapatillas', 'Rojo Flama', 'XXXL', 1, 'zapatilla.jpg'),
(10, 'Pantalon', 'Verde', 'X', 1, NULL),
(13, 'Camisa', 'rojo', 'M', 1, NULL),
(14, 'Zapatillas', 'Gris', 'XS', 1, NULL),
(16, 'Buzo', 'Negro', 'XXXL', 15, NULL),
(17, 'Zapatillas', 'Gris', 'XXXL', 13, NULL),
(18, 'Camisa', 'Amarillo', 'XS', 13, NULL),
(19, 'Jean', 'Gris', 'S', 13, NULL),
(21, 'Zapatillas', 'Gris', 'XS', 13, NULL),
(22, 'Buzo', 'Verde', 'XXL', 1, NULL),
(25, 'Camisa', 'Gris', 'XXXL', 13, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `img` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `admin`, `img`) VALUES
(1, 'usuario', 'usuario@uno.com', '$2y$10$yppTcGTXlZWE4scjl8lVce5aaMm.ZlMPDkeiqG5fCie32LnVBrEM.', 1, ''),
(2, 'administradorUno', 'admin@uno.com', '$2y$10$guxOazOWv/DwW5U48k04SOJWClIZ11UgSq6DFwr4dCk', 1, ''),
(15, 'usuario test', 'usuario@gmail.com', 'asdsdfsdfgdfhgsrthnsrth', 1, ''),
(16, 'leandro', 'lazarte@tudai.com', '$2y$10$/pOaAOR8eH2ZeSpkffhSPe7IDHu5Cdzm00xw1IDGlpCrwRs2ucoNS', 0, NULL),
(17, 'david', 'nunez@tudail.com', '$2y$10$Fss2jF70mOIWG5gOtIVgfObn2ALNdkB/Bw9G.jfjUbtOCK4rbIbCS', 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `commentary`
--
ALTER TABLE `commentary`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo` (`id_categoria`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `commentary`
--
ALTER TABLE `commentary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
