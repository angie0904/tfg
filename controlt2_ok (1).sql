-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2025 a las 19:41:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controlt2_ok`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudios`
--

CREATE TABLE `estudios` (
  `id_estudio` int(11) NOT NULL,
  `NHC` int(11) NOT NULL,
  `cod_prueba` varchar(11) NOT NULL,
  `num_colegiado` int(11) DEFAULT NULL,
  `cod_modalidad` varchar(11) DEFAULT NULL,
  `realizado` tinyint(1) DEFAULT NULL,
  `informado` tinyint(1) DEFAULT NULL,
  `id_informe` int(11) DEFAULT NULL,
  `f_realizado` date DEFAULT NULL,
  `f_informado` date DEFAULT NULL,
  `f_ultimaActu` date DEFAULT NULL,
  `enviados` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudios`
--

INSERT INTO `estudios` (`id_estudio`, `NHC`, `cod_prueba`, `num_colegiado`, `cod_modalidad`, `realizado`, `informado`, `id_informe`, `f_realizado`, `f_informado`, `f_ultimaActu`, `enviados`) VALUES
(1, 3, 'COD_1', 1, 'CR', 1, 1, 1, '2025-11-11', '2025-11-11', '2025-11-12', 0),
(2, 3, 'COD_2', 1, 'CT', 1, 1, 60, '2025-11-15', '2025-11-15', '2025-11-15', 0),
(10, 4, 'COD_1', 1, 'CR', 1, 1, 55, '2025-11-15', '2025-11-15', '2025-11-15', NULL),
(11, 4, 'COD_1', NULL, NULL, 1, 1, 61, '2025-11-15', '2025-11-15', '2025-11-15', NULL),
(12, 4, 'COD_5', 1, NULL, 1, 1, 62, '2025-11-15', '2025-11-15', '2025-11-15', NULL),
(13, 4, 'COD_3', NULL, NULL, 1, 0, 64, '2025-11-16', NULL, '2025-11-16', NULL),
(14, 4, 'COD_1', NULL, NULL, 1, 0, 65, '2025-11-16', NULL, '2025-11-16', NULL),
(15, 4, 'COD_2', NULL, NULL, 1, 0, 66, '2025-11-16', NULL, '2025-11-16', NULL),
(16, 4, 'COD_4', 20, NULL, 1, 1, 67, '2025-11-16', '2025-11-16', '2025-11-16', NULL),
(17, 8, 'COD_1', 20, NULL, 1, 1, 69, '2025-11-16', '2025-11-16', '2025-11-16', NULL),
(18, 8, 'COD_2', 20, NULL, 1, 0, 72, '2025-11-16', NULL, '2025-11-16', NULL),
(19, 8, 'COD_3', 20, NULL, 1, 1, 70, '2025-11-16', '2025-11-16', '2025-11-16', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes`
--

CREATE TABLE `informes` (
  `id_informe` int(11) NOT NULL,
  `resultados` varchar(500) NOT NULL,
  `Validado` tinyint(1) NOT NULL,
  `f_informe` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `informes`
--

INSERT INTO `informes` (`id_informe`, `resultados`, `Validado`, `f_informe`) VALUES
(1, 'Informe sanitario 1 validado', 0, '2025-11-11'),
(2, 'Informe sanitario1 no validado', 0, '2025-11-05'),
(55, 'test 2 vald', 1, '2025-11-15'),
(60, 'informe validado 2, elimino lista y actualizo estudios', 1, '2025-11-15'),
(61, 'asdasdas', 1, '2025-11-15'),
(62, 'ahora valido informe', 1, '2025-11-15'),
(63, 'test inform 2 insert medico', 0, '2025-11-15'),
(64, 'asdsa', 0, '2025-11-15'),
(65, 'guardar informe 1', 0, '2025-11-16'),
(66, 'id informe 1 , prueba guardar y asignar medico.', 0, '2025-11-16'),
(67, 'validado 2', 1, '2025-11-16'),
(68, 'asdsad', 0, '2025-11-16'),
(69, 'informe validado 1', 1, '2025-11-16'),
(70, 'validado', 1, '2025-11-16'),
(71, 'informe 2', 1, '2025-11-16'),
(72, 'informe 2', 1, '2025-11-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `num_colegiado` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `firma` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `login` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`num_colegiado`, `nombre`, `apellidos`, `firma`, `activo`, `login`) VALUES
(1, 'NombreSanitario1', 'NombreApellidos1', 0, 1, '12345678A'),
(20, 'medico', 'medico', 0, 1, 'medico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad`
--

CREATE TABLE `modalidad` (
  `cod_modalidad` varchar(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modalidad`
--

INSERT INTO `modalidad` (`cod_modalidad`, `descripcion`) VALUES
('CR', 'CR'),
('CT', 'CT'),
('DX', 'DX'),
('MR', 'MR'),
('US', 'US');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `NHC` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `f_nac` date NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(11) NOT NULL,
  `tlf` int(11) NOT NULL,
  `login` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`NHC`, `nombre`, `apellidos`, `f_nac`, `edad`, `sexo`, `tlf`, `login`) VALUES
(3, 'nombre2', 'apellidos2', '1989-09-16', 36, 'M', 610662318, 'login2'),
(4, 'angeles', 'luque', '0000-00-00', 21, '', 666666666, 'angeles'),
(8, 'Alejandro', 'Caballero', '0000-00-00', 36, '', 666666666, 'alex');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE `pruebas` (
  `cod_prueba` varchar(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `modalidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pruebas`
--

INSERT INTO `pruebas` (`cod_prueba`, `descripcion`, `modalidad`) VALUES
('COD_1', 'Prueba_1', 0),
('COD_2', 'Prueba_2', 0),
('COD_3', 'Prueba_3', 0),
('COD_4', 'Prueba_4', 0),
('COD_5', 'Prueba_5', 0),
('COD_6', 'Prueba_6', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `login` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `tipo` enum('Paciente','Sanitario','Administrador') NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`login`, `password`, `tipo`, `activo`) VALUES
('12345678A', '12345678A', 'Sanitario', 1),
('admin', 'admin', 'Administrador', 1),
('alex', 'alex', 'Paciente', 1),
('angeles', 'angeles', 'Paciente', 1),
('angie', 'angie', 'Paciente', 1),
('login2', 'password', 'Paciente', 1),
('medico', 'medico', 'Sanitario', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`id_estudio`),
  ADD KEY `fk_cod_prueba` (`cod_prueba`),
  ADD KEY `fk_num_cole` (`num_colegiado`),
  ADD KEY `fk_nhc` (`NHC`),
  ADD KEY `fk_id_informe` (`id_informe`),
  ADD KEY `fk_cod_mod` (`cod_modalidad`);

--
-- Indices de la tabla `informes`
--
ALTER TABLE `informes`
  ADD PRIMARY KEY (`id_informe`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`num_colegiado`),
  ADD KEY `fk_login_sa` (`login`);

--
-- Indices de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  ADD PRIMARY KEY (`cod_modalidad`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`NHC`),
  ADD KEY `fk_login` (`login`);

--
-- Indices de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  ADD PRIMARY KEY (`cod_prueba`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estudios`
--
ALTER TABLE `estudios`
  MODIFY `id_estudio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `informes`
--
ALTER TABLE `informes`
  MODIFY `id_informe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `NHC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD CONSTRAINT `fk_cod_mod` FOREIGN KEY (`cod_modalidad`) REFERENCES `modalidad` (`cod_modalidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cod_prueba` FOREIGN KEY (`cod_prueba`) REFERENCES `pruebas` (`cod_prueba`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_informe` FOREIGN KEY (`id_informe`) REFERENCES `informes` (`id_informe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nhc` FOREIGN KEY (`NHC`) REFERENCES `pacientes` (`NHC`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_num_cole` FOREIGN KEY (`num_colegiado`) REFERENCES `medico` (`num_colegiado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `fk_login_sa` FOREIGN KEY (`login`) REFERENCES `usuarios` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `fk_login` FOREIGN KEY (`login`) REFERENCES `usuarios` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
