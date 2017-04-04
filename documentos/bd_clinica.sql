-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2017 a las 18:59:42
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
-- Estructura de tabla para la tabla `tb_ayuda`
--

CREATE TABLE `tb_ayuda` (
  `id_ayuda` int(11) NOT NULL,
  `ayuda` varchar(100) NOT NULL,
  `texto` text NOT NULL,
  `url` varchar(100) NOT NULL,
  `palabras_claves` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_ayuda`
--

INSERT INTO `tb_ayuda` (`id_ayuda`, `ayuda`, `texto`, `url`, `palabras_claves`) VALUES
(1, 'Casos de uso', 'Los diagramas de casos de uso sirven para especificar la comunicación y el comportamiento de un sistema mediante su interacción con los usuarios y/u otros sistemas. O lo que es igual, un diagrama que muestra la relación entre los actores y los casos de uso en un sistema. Una relación es una conexión entre los elementos del modelo, por ejemplo la especialización y la generalización son relaciones. Los diagramas de casos de uso se utilizan para ilustrar los requerimientos del sistema al mostrar cómo reacciona a eventos que se producen en su ámbito o en él mismo.', 'img/casos de uso.png', 'sistema, interaccion, usuarios, relacion, actores, conexion, modelo, especializacion, generalización.'),
(2, 'diagrama de componentes', 'Un diagrama de componentes representa cómo un sistema de software es dividido en componentes y muestra las dependencias entre estos componentes. Los componentes físicos incluyen archivos, cabeceras, bibliotecas compartidas, módulos, ejecutables, o paquetes. Los diagramas de Componentes prevalecen en el campo de la arquitectura de software pero pueden ser usados para modelar y documentar cualquier arquitectura de sistema.', 'img/diagrama de componentes.png', 'sistema, software, componentes, dependencias, físicos, archivos, cabeceras, bibliotecas compartidas, módulos, ejecutables, paquetes, arquitectura de software, documentar.'),
(3, 'diagrama de distribucion', 'En el diagrama de distribución es donde representamos la estructura de hardware donde estará nuestro sistema o software, para ello cada componente lo podemos representar como nodos, el nodo es cualquier elemento que sea un recurso de hardware, es decir, es nuestra denominación genérica para nuestros equipos.', 'img/diagrama de distribucion.png', 'estructura de hardware, sistema, software, nodos, hardware, denominación genérica, equipos.'),
(4, 'clases del proyecto', 'En informática, una clase es una plantilla para la creación de objetos de datos según un modelo predefinido. Las clases se utilizan para representar entidades o conceptos, como los sustantivos en el lenguaje. Cada clase es un modelo que define un conjunto de variables -el estado, y métodos apropiados para operar con dichos datos -el comportamiento. Cada objeto creado a partir de la clase se denomina instancia de la clase.', 'img/clases.png', 'informática, clase, plantilla, datos, modelo predefinido, clases, entidades, conceptos, sustantivos, lenguaje, modelo, conjunto, variables, estado, métodos apropiados, operar, comportamiento, instancia de la clase.'),
(5, 'modelo entidad relacion (mer)', 'es una herramienta para el modelado de datos que permite representar las entidades relevantes de un sistema de información así como sus interrelaciones y propiedades.', 'img/mer.png', 'herramienta, modelado de datos, bases de datos, entidades, sistema de información, interrelaciones,propiedades.');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `documento` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_relacion` int(11) NOT NULL,
  `id_ayuda` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_ayuda`
--
ALTER TABLE `tb_ayuda`
  ADD PRIMARY KEY (`id_ayuda`);

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
-- Indices de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `id_relacion` (`id_relacion`),
  ADD KEY `id_ayuda` (`id_ayuda`);

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

--
-- Filtros para la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD CONSTRAINT `tb_usuario_ibfk_1` FOREIGN KEY (`id_relacion`) REFERENCES `tb_relacion` (`id_relacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_usuario_ibfk_2` FOREIGN KEY (`id_ayuda`) REFERENCES `tb_ayuda` (`id_ayuda`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

