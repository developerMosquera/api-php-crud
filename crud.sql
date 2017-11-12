-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-11-2017 a las 14:05:19
-- Versión del servidor: 10.0.31-MariaDB-0ubuntu0.16.04.2
-- Versión de PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos`
--

CREATE TABLE `conceptos` (
  `ID` int(11) NOT NULL,
  `CONCEPTO` int(11) NOT NULL,
  `DESCRIPCION` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contabilidad`
--

CREATE TABLE `contabilidad` (
  `ID` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ESTADO` smallint(6) NOT NULL DEFAULT '1',
  `CONCEPTO` smallint(6) NOT NULL,
  `VALOR` double NOT NULL DEFAULT '0',
  `FECHA_CREADO` date NOT NULL,
  `FECHA_EJECUCION` date NOT NULL,
  `DIA_EJECUCION` int(2) NOT NULL DEFAULT '0',
  `DESCRIPCION` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USER` int(11) NOT NULL,
  `TOKEN` varchar(32) NOT NULL,
  `USUARIO` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `ESTADO` smallint(6) NOT NULL DEFAULT '0',
  `FECHA_EXPIRA` date NOT NULL,
  `FECHA_CREACION` datetime NOT NULL,
  `FECHA_ACTUALIZACION` datetime NOT NULL,
  `NOMBRES` varchar(50) NOT NULL,
  `APELLIDOS` varchar(50) NOT NULL,
  `CEDULA` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_accesos`
--

CREATE TABLE `usuarios_accesos` (
  `ID_USER` int(11) NOT NULL,
  `ACCESOS` varchar(255) NOT NULL,
  `ALGO` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CONCEPTO` (`CONCEPTO`);

--
-- Indices de la tabla `contabilidad`
--
ALTER TABLE `contabilidad`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_USER` (`ID_USER`),
  ADD KEY `DIA_EJECUCION` (`DIA_EJECUCION`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USER`),
  ADD KEY `USUARIO` (`USUARIO`),
  ADD KEY `PASS` (`PASSWORD`),
  ADD KEY `TOKEN` (`TOKEN`);

--
-- Indices de la tabla `usuarios_accesos`
--
ALTER TABLE `usuarios_accesos`
  ADD PRIMARY KEY (`ID_USER`),
  ADD KEY `ACCESOS` (`ACCESOS`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `contabilidad`
--
ALTER TABLE `contabilidad`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `usuarios_accesos`
--
ALTER TABLE `usuarios_accesos`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
