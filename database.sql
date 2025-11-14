-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-11-2025 a las 16:05:45
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `itech_parcial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscriptores`
--

DROP TABLE IF EXISTS `inscriptores`;
CREATE TABLE IF NOT EXISTS `inscriptores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edad` int NOT NULL,
  `sexo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pais_residencia` int NOT NULL,
  `nacionalidad` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temas_interes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_pais_residencia` (`id_pais_residencia`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inscriptores`
--

INSERT INTO `inscriptores` (`id`, `nombre`, `apellido`, `edad`, `sexo`, `id_pais_residencia`, `nacionalidad`, `correo`, `telefono`, `temas_interes`, `observaciones`, `fecha_registro`) VALUES
(2, 'Fernando', 'Jiménez', 22, 'Masculino', 8, 'españa', 'fernando.jimenez@utp.ac.pa', '1234-1234', 'Análisis de Datos, Computación Cuántica, Ciberseguridad', NULL, '2025-11-14 15:42:11'),
(3, 'Lionel', 'Messi', 37, 'Masculino', 5, 'argentina', 'leomessi@gmail.com', '8567-6799', 'Análisis de Datos, Computación Cuántica, Diseño Web, Pruebas de Software, Ciberseguridad', 'Muy interesantes todos los temas.', '2025-11-14 15:43:42'),
(4, 'Cristiano', 'Reinaldo', 40, 'Masculino', 5, 'Portugal', 'cr7@gmail.com', '8567-8989', 'Computación Cuántica, Diseño Web, Pruebas de Software', NULL, '2025-11-14 15:51:50'),
(5, 'Jon', 'Jones', 40, 'Masculino', 7, 'Estados Unidos', 'jonjones@gmail.com', '6000-8721', 'Análisis de Datos, Diseño Web, Pruebas de Software, Ciberseguridad', NULL, '2025-11-14 15:52:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE IF NOT EXISTS `paises` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre`) VALUES
(1, 'Belice'),
(2, 'Costa Rica'),
(3, 'El Salvador'),
(4, 'España'),
(5, 'Guatemala'),
(6, 'Honduras'),
(7, 'Nicaragua'),
(8, 'Panamá');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
