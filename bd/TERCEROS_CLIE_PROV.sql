-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-11-2020 a las 23:54:18
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TERCEROS_CLIE_PROV`
--

CREATE TABLE `TERCEROS_CLIE_PROV` (
  `id` int(12) NOT NULL,
  `Nit_Terc` varchar(12) NOT NULL,
  `Nombre_Terc` varchar(100) NOT NULL,
  `Dir_Terc` varchar(30) NOT NULL,
  `Correo_Terc` varchar(100) NOT NULL,
  `Tel_Terc` varchar(15) NOT NULL,
  `Tipo_Clie_Prov_Terc` varchar(50) DEFAULT NULL,
  `Observ_Terc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `TERCEROS_CLIE_PROV`
--
ALTER TABLE `TERCEROS_CLIE_PROV`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `TERCEROS_CLIE_PROV`
--
ALTER TABLE `TERCEROS_CLIE_PROV`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
