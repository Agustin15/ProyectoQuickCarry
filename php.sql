-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2023 a las 21:09:31
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `nombre`, `apellido`, `usuario`, `correo`, `contrasenia`) VALUES
(1, 'Agustin', 'Miranda', 'agus15', 'agus@gmail.com', 'agus1504'),
(2, 'Agustina', 'Franco', 'agus88', 'agus@gmail.com', 'agus987'),
(3, 'Sebas', 'Cancela', 'sebaCancela3', 'seba@gmail.com', 'Cancela222'),
(4, 'Juan Manuel', 'Pereira', 'juanma19', 'juanma@gmail.com', 'juanma123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camionerosquickcarry`
--

CREATE TABLE `camionerosquickcarry` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `numCamionero` varchar(50) NOT NULL,
  `matricula` varchar(50) NOT NULL,
  `cedula` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `camionerosquickcarry`
--

INSERT INTO `camionerosquickcarry` (`id`, `nombre`, `apellido`, `usuario`, `numCamionero`, `matricula`, `cedula`, `correo`, `contrasenia`) VALUES
(1, 'Jorge', 'Rodriguez', 'jorgito', '1', 'SAW2222', '35678923', 'jorge@gmail.com', 'jorge456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionarioscrecom`
--

CREATE TABLE `funcionarioscrecom` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `numFuncio` int(11) NOT NULL,
  `cedula` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `funcionarioscrecom`
--

INSERT INTO `funcionarioscrecom` (`id`, `nombre`, `apellido`, `usuario`, `numFuncio`, `cedula`, `correo`, `contrasenia`) VALUES
(1, 'Lucas', 'Lopez', 'luquitas', 1, '44169129', 'lucas@gmail.com', 'lukass88');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `numLote` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cantidadPaquetes` int(50) NOT NULL,
  `camionMatricula` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`numLote`, `nombre`, `cantidadPaquetes`, `camionMatricula`, `direccion`) VALUES
(1, 'lapiceras', 7, 'SAW2222', 'Rivera 3674');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `camionerosquickcarry`
--
ALTER TABLE `camionerosquickcarry`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `funcionarioscrecom`
--
ALTER TABLE `funcionarioscrecom`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`numLote`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `camionerosquickcarry`
--
ALTER TABLE `camionerosquickcarry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `funcionarioscrecom`
--
ALTER TABLE `funcionarioscrecom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `numLote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
