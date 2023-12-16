-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2023 a las 15:30:47
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `nombre`, `apellido`, `usuario`, `correo`, `contrasenia`) VALUES
(1, 'Agustin', 'Miranda', 'agustinMiranda', 'agus@gmail.com', '54169129'),
(2, 'Sebastian', 'Cancela', 'sebastianCancela', 'seba@gmail.com', '53602699'),
(3, 'Juan Manuel', 'Pereyra', 'juanPereyra', 'juanma@gmail.com', '56121553'),
(4, 'Agustina', 'Franco', 'agustinaFranco', 'agusFran@gmail.com', '55741174');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `numAlmacen` int(11) NOT NULL,
  `direccion` varchar(90) NOT NULL,
  `departamento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacenes`
--

INSERT INTO `almacenes` (`numAlmacen`, `direccion`, `departamento`) VALUES
(1, 'Wilson Ferreira Aldunate 340 55000', 'Artigas'),
(2, 'Héctor Miranda 278 90000', 'Canelones'),
(3, 'Treinta y Tres, 37000 Melo', 'Cerro Largo'),
(4, 'Domingo Baqué 465 70000', 'Colonia'),
(5, 'Joaquin Suarez 169 97000', 'Durazno'),
(6, 'Av. Artigas 1037 94000 ', 'Florida'),
(7, 'Dr. Luis Alberto de Herrera 1039 85000', 'Flores'),
(8, 'Intendente Lois 30000', 'Lavalleja'),
(9, ' Av. Franklin Delano Roosevelt 20000', 'Maldonado'),
(10, 'Av. Luis Alberto de Herrera 1290', 'Montevideo'),
(11, 'Bulevar General Artigas 770 60000', 'Paysandu'),
(12, '25 de Mayo 3242 Fray Bentos', 'Rio negro'),
(13, 'Monseñor Jacinto Vera 1169 40000', 'Rivera'),
(14, '18 de Julio 1481,Rocha', 'Rocha'),
(15, 'Av. Carlos Reyles 1952 50000 ', 'Salto'),
(16, '80000 San José de Mayo', 'San Jose'),
(17, 'Don Bosco 734 75000', 'Mercedes'),
(18, 'Doctor Domingo Catalina 130 45000', 'Tacuarembo'),
(19, 'Manuel Lavalleja 1050 33000', 'Treinta y Tres'),
(20, 'Bulevar General Artigas 1825,11800 Montevideo', 'Montevideo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camiones`
--

CREATE TABLE `camiones` (
  `matricula` varchar(7) NOT NULL,
  `altura` double NOT NULL,
  `numeroRuedas` int(11) NOT NULL,
  `peso` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camiones`
--

INSERT INTO `camiones` (`matricula`, `altura`, `numeroRuedas`, `peso`) VALUES
('FTP3345', 5, 10, 17),
('MTP1567', 3, 6, 13),
('QTP7342', 4, 10, 16),
('RTP5421', 4, 8, 16),
('STP9876', 4, 8, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camionetas`
--

CREATE TABLE `camionetas` (
  `matricula` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camionetas`
--

INSERT INTO `camionetas` (`matricula`) VALUES
('ATL4917'),
('CTL3281'),
('LTL7742'),
('PTL6270'),
('STL2256');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chofercamion`
--

CREATE TABLE `chofercamion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `numChoferCamion` int(11) NOT NULL,
  `matriculaCamion` varchar(7) NOT NULL,
  `cedula` varchar(8) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasenia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chofercamion`
--

INSERT INTO `chofercamion` (`id`, `nombre`, `apellido`, `usuario`, `numChoferCamion`, `matriculaCamion`, `cedula`, `correo`, `contrasenia`) VALUES
(1, 'Jorge', 'Errandonea', 'jorgeErrandonea', 1, 'FTP3345', '27657676', 'jorge@gmail.com', '$2y$10$RMjXVf0WCf2MvF8v8D0TNuCbKwrX8WeeaFeBWqOyjh6uHwOaRZ8pe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chofercamioneta`
--

CREATE TABLE `chofercamioneta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `numChoferCamioneta` int(11) NOT NULL,
  `matriculaCamioneta` varchar(7) DEFAULT NULL,
  `cedula` varchar(8) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasenia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientecrecom`
--

CREATE TABLE `clientecrecom` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `contrasenia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientecrecom`
--

INSERT INTO `clientecrecom` (`idCliente`, `nombre`, `apellido`, `usuario`, `correo`, `direccion`, `contrasenia`) VALUES
(1, 'Tonny', 'Alvarez', 'tonny33', 'tonny@gmail.com', 'Solano García 2466', '$2y$10$IWWh/0hUxaHUDZ7r7xFVM.DwGp2N77m01h2XrW/O1AF0EuGA6TBT6');

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
  `cedula` varchar(8) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasenia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `funcionarioscrecom`
--

INSERT INTO `funcionarioscrecom` (`id`, `nombre`, `apellido`, `usuario`, `numFuncio`, `cedula`, `correo`, `contrasenia`) VALUES
(1, 'Lucas', 'Gonzalez', 'lucasGonzalez', 1, '36565465', 'lucas@gmail.com', '$2y$10$DSoK8kpVg1PHC.D05ZnkIev/49k98OOWLDraG.uy60NGB5i3Jaktq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionariosquickcarry`
--

CREATE TABLE `funcionariosquickcarry` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `numFuncio` int(11) NOT NULL,
  `cedula` varchar(8) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasenia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `funcionariosquickcarry`
--

INSERT INTO `funcionariosquickcarry` (`id`, `nombre`, `apellido`, `usuario`, `numFuncio`, `cedula`, `correo`, `contrasenia`) VALUES
(1, 'Maria', 'Demichelis', 'mariaDemichelis', 1, '48279142', 'maria@gmail.com', '$2y$10$tQdb.in3g6dWRn/hKZIysesK3K19Vnyp5Fxmf52BhKmY.Mg.v7W82');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `numLote` int(11) NOT NULL,
  `matriculaCamioneta` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `idPaquete` int(11) NOT NULL,
  `numLote` int(11) DEFAULT NULL,
  `idCliente` int(11) NOT NULL,
  `numAlmacen` int(11) DEFAULT NULL,
  `matriculaCamion` varchar(7) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `destino` varchar(90) NOT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `fechaPedido` datetime DEFAULT NULL,
  `codigoRastreo` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`idPaquete`, `numLote`, `idCliente`, `numAlmacen`, `matriculaCamion`, `nombre`, `estado`, `destino`, `fechaEntrega`, `fechaPedido`, `codigoRastreo`) VALUES
(1, NULL, 1, NULL, NULL, 'Collar', 'Pedido', 'Solano García 2466', NULL, '2023-11-13 22:34:44', NULL),
(2, NULL, 1, NULL, NULL, 'Guitarra', 'Pedido', 'Solano García 2466', NULL, '2023-11-13 22:36:44', NULL),
(3, NULL, 1, NULL, NULL, 'Monitor', 'Pedido', 'Solano García 2466', NULL, '2023-11-13 22:38:44', NULL),
(4, NULL, 1, NULL, NULL, 'Camisa', 'Pedido', 'Solano García 2466', NULL, '2023-11-13 22:40:44', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `idTarea` int(11) NOT NULL,
  `matriculaCamion` varchar(7) NOT NULL,
  `descripcion` varchar(90) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trayecto`
--

CREATE TABLE `trayecto` (
  `idTrayecto` int(11) NOT NULL,
  `matriculaCamion` varchar(7) NOT NULL,
  `numAlmacen` int(11) NOT NULL,
  `ruta` int(11) NOT NULL,
  `fechaTrayecto` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `matricula` varchar(7) NOT NULL,
  `capacidadCarga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`matricula`, `capacidadCarga`) VALUES
('ATL4917', 20),
('CTL3281', 14),
('FTP3345', 60),
('LTL7742', 16),
('MTP1567', 40),
('PTL6270', 12),
('QTP7342', 46),
('RTP5421', 54),
('STL2256', 10),
('STP9876', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE `visita` (
  `idVisita` int(11) NOT NULL,
  `matriculaCamionVisita` varchar(7) NOT NULL,
  `numAlmacen` int(11) NOT NULL,
  `fechaVisita` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`numAlmacen`);

--
-- Indices de la tabla `camiones`
--
ALTER TABLE `camiones`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `camionetas`
--
ALTER TABLE `camionetas`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `chofercamion`
--
ALTER TABLE `chofercamion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_matriculaChoferCamion` (`matriculaCamion`);

--
-- Indices de la tabla `chofercamioneta`
--
ALTER TABLE `chofercamioneta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_matriculaCamionetaChofer` (`matriculaCamioneta`);

--
-- Indices de la tabla `clientecrecom`
--
ALTER TABLE `clientecrecom`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `funcionarioscrecom`
--
ALTER TABLE `funcionarioscrecom`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `funcionariosquickcarry`
--
ALTER TABLE `funcionariosquickcarry`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`numLote`),
  ADD KEY `fk_matriculaCamionetaLote` (`matriculaCamioneta`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`idPaquete`),
  ADD KEY `fk_almacenPaquete` (`numAlmacen`),
  ADD KEY `fk_lotePaquete` (`numLote`),
  ADD KEY `fk_idClientePaquete` (`idCliente`),
  ADD KEY `fk_matriculaCamionPaquete` (`matriculaCamion`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`idTarea`),
  ADD KEY `fk_matriculaCamionTarea` (`matriculaCamion`);

--
-- Indices de la tabla `trayecto`
--
ALTER TABLE `trayecto`
  ADD PRIMARY KEY (`idTrayecto`),
  ADD KEY `fk_matriculaCamion` (`matriculaCamion`),
  ADD KEY `fk_almacenTrayecto` (`numAlmacen`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`idVisita`),
  ADD KEY `fk_visitaCamion` (`matriculaCamionVisita`),
  ADD KEY `fk_almacenVisita` (`numAlmacen`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `numAlmacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `chofercamion`
--
ALTER TABLE `chofercamion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `chofercamioneta`
--
ALTER TABLE `chofercamioneta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientecrecom`
--
ALTER TABLE `clientecrecom`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `funcionarioscrecom`
--
ALTER TABLE `funcionarioscrecom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `funcionariosquickcarry`
--
ALTER TABLE `funcionariosquickcarry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `idPaquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
  MODIFY `idTarea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trayecto`
--
ALTER TABLE `trayecto`
  MODIFY `idTrayecto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `visita`
--
ALTER TABLE `visita`
  MODIFY `idVisita` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `camiones`
--
ALTER TABLE `camiones`
  ADD CONSTRAINT `fk_matriculaVehiculoCamiones` FOREIGN KEY (`matricula`) REFERENCES `vehiculos` (`matricula`);

--
-- Filtros para la tabla `chofercamion`
--
ALTER TABLE `chofercamion`
  ADD CONSTRAINT `fk_matriculaChoferCamion` FOREIGN KEY (`matriculaCamion`) REFERENCES `camiones` (`matricula`);

--
-- Filtros para la tabla `chofercamioneta`
--
ALTER TABLE `chofercamioneta`
  ADD CONSTRAINT `fk_matriculaCamionetaChofer` FOREIGN KEY (`matriculaCamioneta`) REFERENCES `camionetas` (`matricula`);

--
-- Filtros para la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `fk_matriculaCamionetaLote` FOREIGN KEY (`matriculaCamioneta`) REFERENCES `camionetas` (`matricula`);

--
-- Filtros para la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `fk_almacenPaquete` FOREIGN KEY (`numAlmacen`) REFERENCES `almacenes` (`numAlmacen`),
  ADD CONSTRAINT `fk_idClientePaquete` FOREIGN KEY (`idCliente`) REFERENCES `clientecrecom` (`idCliente`),
  ADD CONSTRAINT `fk_lotePaquete` FOREIGN KEY (`numLote`) REFERENCES `lotes` (`numLote`),
  ADD CONSTRAINT `fk_matriculaCamionPaquete` FOREIGN KEY (`matriculaCamion`) REFERENCES `camiones` (`matricula`);

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `fk_matriculaCamionTarea` FOREIGN KEY (`matriculaCamion`) REFERENCES `camiones` (`matricula`);

--
-- Filtros para la tabla `trayecto`
--
ALTER TABLE `trayecto`
  ADD CONSTRAINT `fk_almacenTrayecto` FOREIGN KEY (`numAlmacen`) REFERENCES `almacenes` (`numAlmacen`),
  ADD CONSTRAINT `fk_matriculaCamion` FOREIGN KEY (`matriculaCamion`) REFERENCES `camiones` (`matricula`);

--
-- Filtros para la tabla `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `fk_almacenVisita` FOREIGN KEY (`numAlmacen`) REFERENCES `almacenes` (`numAlmacen`),
  ADD CONSTRAINT `fk_visitaCamion` FOREIGN KEY (`matriculaCamionVisita`) REFERENCES `camiones` (`matricula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
