-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-01-2024 a las 17:53:06
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registro_stock`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_1`
--

CREATE TABLE `tabla_1` (
  `ID_formato` int(11) NOT NULL,
  `formato` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `color` varchar(11) NOT NULL,
  `gramaje` int(11) NOT NULL,
  `cantidades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tabla_1`
--

INSERT INTO `tabla_1` (`ID_formato`, `formato`, `color`, `gramaje`, `cantidades`) VALUES
(1, '12 X 08 X 19', 'MARRON', 100, 1278),
(2, '12 X 08 X 26', 'MARRON', 100, 6900),
(3, '12 X 08 X 40', 'MARRON', 100, 89712),
(4, '22 X 10 X 20', 'MARRON', 100, 748),
(5, '22 X 10 X 24', 'MARRON', 100, 885),
(6, '22 X 10 X 30', 'MARRON', 100, 52605),
(7, '22 X 10 X 42', 'MARRON', 100, 9134),
(8, '22 X 12 X 30', 'MARRON', 100, 1965),
(9, '22 X 12 X 41', 'MARRON', 100, 3062),
(10, '26 X 12 X 36', 'MARRON', 100, 7951),
(11, '26 X 12 X 41', 'MARRON', 100, 200),
(12, '28 x 12 x 41', 'MARRON', 80, 33973),
(13, '28 x 16 x 38', 'MARRON', 100, 23348),
(14, '28 x 16 x 38', 'MARRON', 80, 8197),
(15, '30 x 12 x 32', 'MARRON', 100, 4200),
(16, '30 X 12 X 41', 'MARRON', 100, 21552),
(17, '30 X 12 X 41', 'MARRON', 80, 1651),
(18, '30 X 16 X 43', 'MARRON', 100, 580),
(19, '12 X 08 X 19', 'BLANCO', 100, 1667),
(20, '22 X 10 X 30', 'BLANCO', 80, 18720),
(21, '26 X 12 X 36', 'BLANCO', 100, 23200),
(22, '30 X 12 X 41', 'BLANCO', 80, 3314);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_2`
--

CREATE TABLE `tabla_2` (
  `ID_registro` int(11) NOT NULL,
  `ID_formato` int(11) NOT NULL,
  `papel` varchar(11) NOT NULL,
  `fecha` date NOT NULL,
  `pedido` int(11) NOT NULL,
  `detalle` varchar(50) NOT NULL,
  `origen` int(11) NOT NULL,
  `ingreso` int(11) NOT NULL,
  `egreso` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `destino_sobrante` int(11) NOT NULL,
  `sobrante` int(11) NOT NULL,
  `facturado` int(11) NOT NULL,
  `entregado` int(11) NOT NULL,
  `remito` int(11) NOT NULL,
  `sobreconsumo` int(11) NOT NULL,
  `lote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tabla_2`
--

INSERT INTO `tabla_2` (`ID_registro`, `ID_formato`, `papel`, `fecha`, `pedido`, `detalle`, `origen`, `ingreso`, `egreso`, `saldo`, `destino_sobrante`, `sobrante`, `facturado`, `entregado`, `remito`, `sobreconsumo`, `lote`) VALUES
(1, 6, 'Kraft', '2023-04-13', 11, '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 6, 'Kraft', '0000-00-00', 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tabla_1`
--
ALTER TABLE `tabla_1`
  ADD PRIMARY KEY (`ID_formato`);

--
-- Indices de la tabla `tabla_2`
--
ALTER TABLE `tabla_2`
  ADD PRIMARY KEY (`ID_registro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tabla_1`
--
ALTER TABLE `tabla_1`
  MODIFY `ID_formato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tabla_2`
--
ALTER TABLE `tabla_2`
  MODIFY `ID_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
