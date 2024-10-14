-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2024 a las 22:44:28
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
-- Base de datos: `bdmascotas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gato`
--

CREATE TABLE `gato` (
  `gato_id` int(11) NOT NULL,
  `gato_nombre` varchar(45) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `gato_raza` varchar(45) DEFAULT NULL,
  `imagen_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gato`
--

INSERT INTO `gato` (`gato_id`, `gato_nombre`, `usuario_id`, `gato_raza`, `imagen_id`) VALUES
(6, 'Wunkus', 1, 'Bambino', 'wiHVRle1m'),
(7, 'Wunkus', 1, 'Bambino', 'wiHVRle1m'),
(8, 'Wunkus', 1, 'Bambino', 'wiHVRle1m'),
(9, 'Wunkus', 1, 'Bambino', 'wiHVRle1m'),
(10, 'Akira', 2, 'Arabian Mau', 'k71ULYfRr'),
(11, 'Akira', 2, 'Arabian Mau', 'zlpgGWqN7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `usuario_email` varchar(70) DEFAULT NULL,
  `usuario_password` varchar(45) DEFAULT NULL,
  `usuario_nombre` varchar(45) DEFAULT NULL,
  `usuario_apellido` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `dni`, `usuario_email`, `usuario_password`, `usuario_nombre`, `usuario_apellido`) VALUES
(1, '44238322', 'rochyfer10@hotmail.com.ar', '1234', 'Rocio', 'Fernandez'),
(2, '48412196', 'julieta@bubu.com', '123', 'Julieta', 'Fernandez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gato`
--
ALTER TABLE `gato`
  ADD PRIMARY KEY (`gato_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gato`
--
ALTER TABLE `gato`
  MODIFY `gato_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gato`
--
ALTER TABLE `gato`
  ADD CONSTRAINT `gato_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
