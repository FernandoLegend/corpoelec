-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-01-2024 a las 16:42:17
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_certificacion`
--

CREATE TABLE `datos_certificacion` (
  `id` int(255) NOT NULL,
  `certificacion` varchar(255) NOT NULL,
  `cursos_talleres` varchar(255) NOT NULL,
  `areas` varchar(255) NOT NULL,
  `estado_certificado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datos_certificacion`
--

INSERT INTO `datos_certificacion` (`id`, `certificacion`, `cursos_talleres`, `areas`, `estado_certificado`) VALUES
(3, 'No', '', '', 'No entregado'),
(4, 'Si', '', '', 'No entregado'),
(5, 'Si', 'Mantenimiento de equipos computarizados', 'Cableria', 'Entregado'),
(1, 'No', '', '', 'Ninguno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_educativos`
--

CREATE TABLE `datos_educativos` (
  `id` int(255) NOT NULL,
  `nivel_instruccion` varchar(255) NOT NULL,
  `carrera` varchar(255) NOT NULL,
  `estudios` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datos_educativos`
--

INSERT INTO `datos_educativos` (`id`, `nivel_instruccion`, `carrera`, `estudios`) VALUES
(1, 'Bachiller', 'Ing en Informatica, Lic en Conatuduria', 'Informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE `datos_personales` (
  `id` int(8) NOT NULL,
  `fecha` date NOT NULL,
  `participar_estudiante` varchar(3) NOT NULL,
  `participar_docente` varchar(3) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `estado_civil` varchar(10) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` int(2) NOT NULL,
  `lugar_nacimiento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabla de manejo de datos personales corpoelec';

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id`, `fecha`, `participar_estudiante`, `participar_docente`, `nombres`, `apellidos`, `cedula`, `genero`, `estado_civil`, `fecha_nacimiento`, `edad`, `lugar_nacimiento`) VALUES
(1, '0000-00-00', 'Si', 'No', 'Fernanado Andres', 'Marin Velasquez', '28721624', 'Masculino', 'Soltero(a)', '2003-11-22', 20, 'Tucupita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidad`
--

CREATE TABLE `entidad` (
  `id` int(15) NOT NULL,
  `estado_trbj` varchar(255) NOT NULL,
  `municipio_trbj` varchar(255) NOT NULL,
  `parroquia_trbj` varchar(255) NOT NULL,
  `sector_trbj` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `tiempo_servicio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entidad`
--

INSERT INTO `entidad` (`id`, `estado_trbj`, `municipio_trbj`, `parroquia_trbj`, `sector_trbj`, `cargo`, `tiempo_servicio`) VALUES
(3, 'Delta Amacuro', 'Tucupita', 'Leonardo Ruiz Pineda', 'Calle la Planta', 'Liniero', '9 AÃ±os'),
(4, 'Delta Amacuro', 'Tucupita', 'Leonardo Ruiz Pineda', 'Calle la Planta', 'Director General de toa esa mrd', '5 AÃ±os'),
(5, 'Delta Amacuro', 'Tucupita', 'Leonardo Ruiz Pineda', 'Calle la Planta', 'Director General de toa esa mrd', 'Dos AÃ±os'),
(1, 'Delta Amacuro', 'Tucupita', 'Leonardo Ruiz Pineda', 'Calle la Planta', 'Director General de toa esa mrd', 'Dos AÃ±os');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facilitador`
--

CREATE TABLE `facilitador` (
  `id` int(255) NOT NULL,
  `componente` varchar(255) NOT NULL,
  `posee_experiencia` varchar(255) NOT NULL,
  `tiempo_experiencia` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `gerente` varchar(255) NOT NULL,
  `nro_personal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facilitador`
--

INSERT INTO `facilitador` (`id`, `componente`, `posee_experiencia`, `tiempo_experiencia`, `division`, `gerente`, `nro_personal`) VALUES
(3, 'Si', 'No', '', 'Comercial', 'Kevin Crespo', 'M-31231231'),
(4, 'Si', 'No', '', 'Formacion', 'Kevin Crespo', 'M-1452423'),
(5, 'Si', 'Si', '', 'Comercial', 'Kevin Crespo', '765765-M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacionycomunicacion`
--

CREATE TABLE `ubicacionycomunicacion` (
  `id` int(8) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `municipio` varchar(255) NOT NULL,
  `parroquia` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `nrocelular` varchar(15) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabla de localizacion de datos corpoelec';

--
-- Volcado de datos para la tabla `ubicacionycomunicacion`
--

INSERT INTO `ubicacionycomunicacion` (`id`, `estado`, `municipio`, `parroquia`, `sector`, `nrocelular`, `correo`) VALUES
(3, 'Delta Amacuro', 'Tucupita', 'San Rafael', 'Raul Leoni II', '04249512406', 'fernandomarin200375@gmail.com'),
(4, 'Delta Amacuro', 'Tucupita', 'San Rafael', 'Raul Leoni II', '0424952124056', 'lisethvelasquez2015@gmail.com'),
(5, 'Delta Amacuro', 'EWEWE', 'aaaa', 'adasd', '321', 'fernandomarin200375@gmail.com'),
(1, 'Delta Amacuro', 'Tucupita', 'San Rafael', 'Raul Leoni II', '04249512406', 'fernandomarin200375@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
