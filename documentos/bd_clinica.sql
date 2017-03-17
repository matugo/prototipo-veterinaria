-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-03-2017 a las 18:14:33
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_enfermedad`
--

CREATE TABLE `tb_enfermedad` (
  `id_enfermedad` int(11) NOT NULL,
  `enfermedad` varchar(999) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_enfermedad`
--

INSERT INTO `tb_enfermedad` (`id_enfermedad`, `enfermedad`, `url`) VALUES
(1, 'Leptospirosis', 'img/leptospirosis.jpg'),
(2, 'Brucelosis', 'img/brucelosis.jpg'),
(3, 'Mastitis', 'img/mastitis.jpg'),
(4, 'Moquillo', 'img/moquillo.jpg'),
(5, 'Parvovirosis', 'img/parvovirus.jpg'),
(6, 'Coronavirus', 'img/coronavirus.jpg'),
(7, 'Piometra', 'img/piometra.jpg'),
(8, 'Tina', 'img/tina.jpg'),
(9, 'Tos Perruna', 'img/tos.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_relacion`
--

CREATE TABLE `tb_relacion` (
  `id_relacion` int(11) NOT NULL,
  `id_sintomas` int(11) NOT NULL,
  `id_enfermedad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_relacion`
--

INSERT INTO `tb_relacion` (`id_relacion`, `id_sintomas`, `id_enfermedad`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2),
(9, 9, 3),
(10, 10, 3),
(11, 11, 3),
(12, 3, 4),
(13, 1, 4),
(14, 12, 4),
(15, 13, 4),
(16, 16, 8),
(17, 17, 8),
(18, 1, 9),
(19, 4, 9),
(20, 14, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_sintomas`
--

CREATE TABLE `tb_sintomas` (
  `id_sintomas` int(11) NOT NULL,
  `sintomas` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_sintomas`
--

INSERT INTO `tb_sintomas` (`id_sintomas`, `sintomas`) VALUES
(1, 'tos'),
(2, 'dolor muscular'),
(3, 'vomitos'),
(4, 'problema respiratorios'),
(5, 'fiebre'),
(6, 'inflamacion testicular'),
(7, 'abortos'),
(8, 'esterilidad'),
(9, 'inflamacion'),
(10, 'glandulas'),
(11, 'mamas'),
(12, 'diarrea'),
(13, 'diarrea explosiva'),
(14, 'falta de apetito'),
(15, 'dificulta en el movimiento'),
(16, 'Zonas Sin Pelo'),
(17, 'Piel Abultada');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_enfermedad`
--
ALTER TABLE `tb_enfermedad`
  ADD PRIMARY KEY (`id_enfermedad`);

--
-- Indices de la tabla `tb_relacion`
--
ALTER TABLE `tb_relacion`
  ADD PRIMARY KEY (`id_relacion`),
  ADD KEY `id_sintomas` (`id_sintomas`),
  ADD KEY `id_enfermedades` (`id_enfermedad`);

--
-- Indices de la tabla `tb_sintomas`
--
ALTER TABLE `tb_sintomas`
  ADD PRIMARY KEY (`id_sintomas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_enfermedad`
--
ALTER TABLE `tb_enfermedad`
  MODIFY `id_enfermedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tb_relacion`
--
ALTER TABLE `tb_relacion`
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_relacion`
--
ALTER TABLE `tb_relacion`
  ADD CONSTRAINT `tb_relacion_ibfk_2` FOREIGN KEY (`id_sintomas`) REFERENCES `tb_sintomas` (`id_sintomas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_relacion_ibfk_3` FOREIGN KEY (`id_enfermedad`) REFERENCES `tb_enfermedad` (`id_enfermedad`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
