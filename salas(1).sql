-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-11-2020 a las 21:25:34
-- Versión del servidor: 5.7.26
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `salas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artefacto`
--

DROP TABLE IF EXISTS `artefacto`;
CREATE TABLE IF NOT EXISTS `artefacto` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `id_sala` int(30) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_ingles` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `qr` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion_ingles` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero` int(3) DEFAULT NULL,
  `actualizado` date DEFAULT NULL,
  PRIMARY KEY (`id`,`video`),
  UNIQUE KEY `video` (`video`),
  UNIQUE KEY `nombre` (`nombre`),
  UNIQUE KEY `qr` (`qr`),
  UNIQUE KEY `numero` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Estructura de tabla para la tabla `sala`
--

DROP TABLE IF EXISTS `sala`;
CREATE TABLE IF NOT EXISTS `sala` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_ingles` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero` int(3) NOT NULL,
  `actualizado` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  UNIQUE KEY `numero` (`numero`),
  KEY `nombre_2` (`nombre`),
  KEY `nombre_3` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `contrasenia` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `contrasenia`) VALUES
(1, 'admin', '$2y$10$5eKQRWEjJ8kQiTlFRDdRIeNXT4txxyfdKjnowVXHT1hfJn2e1kV9i'),
(2, 'root', '$2y$10$XYdRk59gF/HYuHZn/SZome0PUNCkrTCwd00IYzUb9J0.sKJHn.j66'),
(3, 'test', '$2y$10$M.TqzVUT.oDJyAPMNzFGX.JpJakrI5yahFbtDAstXxNPJbxjZxniq'),
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
