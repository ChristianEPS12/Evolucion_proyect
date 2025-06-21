-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 12-10-2024 a las 19:37:22
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
-- Base de datos: `engiecerti_diplomas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `td_curso_usuario`
--

CREATE TABLE `td_curso_usuario` (
  `curd_id` int(11) NOT NULL,
  `cur_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `fech_crea` datetime NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `td_curso_usuario`
--

INSERT INTO `td_curso_usuario` (`curd_id`, `cur_id`, `usu_id`, `fech_crea`, `est`) VALUES
(1, 1, 1, '2024-09-17 15:31:12', 1),
(2, 1, 3, '2024-09-17 15:31:12', 1),
(3, 2, 1, '2024-09-17 15:31:12', 1),
(4, 2, 3, '2024-09-17 15:31:12', 1),
(6, 3, 2, '2024-10-07 06:48:39', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_categoria`
--

CREATE TABLE `tm_categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_nom` varchar(150) NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_categoria`
--

INSERT INTO `tm_categoria` (`cat_id`, `cat_nom`, `fech_crea`, `est`) VALUES
(1, 'Programacion', '2024-09-17 15:13:50', 1),
(2, 'Inteligencia Artificial', '2024-09-17 15:13:50', 1),
(5, 'Marketing', '2024-10-12 00:37:16', 1),
(6, 'Contabilidad', '2024-10-12 00:41:36', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_curso`
--

CREATE TABLE `tm_curso` (
  `cur_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cur_nom` varchar(150) NOT NULL,
  `cur_descrip` varchar(1000) NOT NULL,
  `cur_fechini` date NOT NULL,
  `cur_fechfin` date NOT NULL,
  `inst_id` int(11) NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_curso`
--

INSERT INTO `tm_curso` (`cur_id`, `cat_id`, `cur_nom`, `cur_descrip`, `cur_fechini`, `cur_fechfin`, `inst_id`, `fech_crea`, `est`) VALUES
(1, 1, 'CURSO DE PYTHON', 'Aprende los fundamentos de Python, uno de los lenguajes de programación más populares y versátiles. Este curso cubre desde lo básico, como variables, control de flujo y funciones, hasta conceptos más avanzados como manejo de archivos y programación orientada a objetos.', '2024-09-17', '2024-10-17', 1, '2024-09-17 15:18:48', 1),
(2, 1, 'MACHINE LEARNING', 'Descubre cómo las máquinas pueden aprender a partir de datos en este curso introductorio de Machine Learning. Aprende a implementar algoritmos esenciales como regresión, clasificación y clustering, utilizando Python y bibliotecas populares como Scikit-learn.', '2024-09-17', '2024-10-17', 2, '2024-09-17 15:18:48', 1),
(3, 1, 'CURSO DE PHP', 'El curso Programación Efectiva en PHP para aplicaciones Web pretende que el estudiante esté en la capacidad de desarrollar sitios web interactivos, como solución a problemas del entorno haciendo uso de herramientas y lenguajes de programación del lado del servidor.', '2024-09-17', '2024-10-17', 1, '2024-09-17 15:18:48', 1),
(4, 1, 'JAVA BASICO', 'Aprende un lenguaje Robusto como Java para introducirte en el mundo laboral actualmente digitalizado.', '2024-10-17', '2024-11-17', 2, '2024-10-11 22:07:15', 1),
(5, 2, 'ANALISIS DE DATOS', 'Convierte datos sin procesar en información práctica. Incluye una serie de herramientas y resolver problemas mediante datos.', '2024-10-12', '2024-11-12', 2, '2024-10-11 22:10:00', 1),
(6, 2, 'CIENCIA DE DATOS', 'Son términos generales para los métodos y técnicas relacionados con la comprensión y el uso de datos digitales.', '2024-10-13', '2024-11-13', 2, '2024-10-11 22:57:08', 1),
(7, 1, 'JAVA POO INTERMEDIO', 'Es un enfoque fundamental en la programación que se basa en la creación y manipulación de objetos, que combinan datos y comportamientos.', '2024-10-15', '2024-11-15', 2, '2024-10-11 23:27:11', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_instructor`
--

CREATE TABLE `tm_instructor` (
  `inst_id` int(11) NOT NULL,
  `inst_nom` varchar(150) NOT NULL,
  `inst_apep` varchar(150) NOT NULL,
  `inst_apem` varchar(150) NOT NULL,
  `inst_correo` varchar(150) NOT NULL,
  `inst_sex` varchar(1) NOT NULL,
  `isnt_telf` varchar(9) NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_instructor`
--

INSERT INTO `tm_instructor` (`inst_id`, `inst_nom`, `inst_apep`, `inst_apem`, `inst_correo`, `inst_sex`, `isnt_telf`, `fech_crea`, `est`) VALUES
(1, 'Wilson', 'Verastegui', 'Huaman', 'Wilson@gmail.com', 'M', '921352763', '2024-09-17 15:08:21', 1),
(2, 'Juan', 'Clemente', 'Solorzano', 'Clemente@gmail.com', 'M', '912321212', '2024-09-17 15:08:21', 1),
(3, 'Jhon', 'Medina', 'Sanchez', 'Jhon@gmail.com', 'M', '911232325', '2024-10-12 10:57:18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_usuario`
--

CREATE TABLE `tm_usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_nom` varchar(150) NOT NULL,
  `usu_apep` varchar(150) NOT NULL,
  `usu_apem` varchar(150) NOT NULL,
  `usu_correo` varchar(150) NOT NULL,
  `usu_pass` varchar(12) NOT NULL,
  `usu_sex` varchar(1) NOT NULL,
  `usu_telf` varchar(9) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_usuario`
--

INSERT INTO `tm_usuario` (`usu_id`, `usu_nom`, `usu_apep`, `usu_apem`, `usu_correo`, `usu_pass`, `usu_sex`, `usu_telf`, `rol_id`, `fech_crea`, `est`) VALUES
(1, 'Ericson Olimpio', 'Urbano', 'Poma', 'Skills@gmail.com', '12345678', 'M', '971885783', 1, '2024-09-17 14:32:39', 1),
(2, 'Leandro Angel', 'De la Cruz', 'Garcia', 'LeandroGar@gmail.com', '123456', 'M', '976123654', 1, '2024-09-17 14:32:39', 1),
(3, 'Dagiana Tahis', 'Flores', 'Morales', 'Dagiana@gmail.com', '123456', 'F', '912654783', 1, '2024-09-17 14:32:39', 1),
(4, 'Jason Jose', 'Olivos', 'Chiroque', 'ADMIN@gmail.com', '123456', 'M', '911233211', 2, '2024-09-17 14:32:39', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `td_curso_usuario`
--
ALTER TABLE `td_curso_usuario`
  ADD PRIMARY KEY (`curd_id`);

--
-- Indices de la tabla `tm_categoria`
--
ALTER TABLE `tm_categoria`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `tm_curso`
--
ALTER TABLE `tm_curso`
  ADD PRIMARY KEY (`cur_id`);

--
-- Indices de la tabla `tm_instructor`
--
ALTER TABLE `tm_instructor`
  ADD PRIMARY KEY (`inst_id`);

--
-- Indices de la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `td_curso_usuario`
--
ALTER TABLE `td_curso_usuario`
  MODIFY `curd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tm_categoria`
--
ALTER TABLE `tm_categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tm_curso`
--
ALTER TABLE `tm_curso`
  MODIFY `cur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tm_instructor`
--
ALTER TABLE `tm_instructor`
  MODIFY `inst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
