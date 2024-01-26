-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-01-2024 a las 13:02:48
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
-- Estructura de tabla para la tabla `listado_precios`
--

CREATE TABLE `listado_precios` (
  `ID_listado` int(11) NOT NULL,
  `ID_formato` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(8,2) DEFAULT NULL,
  `manija` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_1`
--

CREATE TABLE `tabla_1` (
  `ID_formato` int(11) NOT NULL,
  `formato` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `color` varchar(11) NOT NULL,
  `gramaje` int(11) NOT NULL,
  `cantidades` int(11) NOT NULL,
  `manijas` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tabla_1`
--

INSERT INTO `tabla_1` (`ID_formato`, `formato`, `color`, `gramaje`, `cantidades`, `manijas`,`unixtime`) VALUES
(1,   '12 X 08 X 19', 'MARRON', 100,    56084,  b'0', 1706268807),
(2,   '12 X 08 X 40', 'MARRON', 100,    61464,  b'0', 1706268807),
(3,   '22 X 10 X 30', 'MARRON', 100,    50827,  b'0', 1706268807),
(4,   '22 X 10 X 42', 'MARRON', 100,    3663,   b'0', 1706268807),
(5,   '26 X 12 X 36', 'MARRON', 100,    14277,  b'0', 1706268807),
(6,   '28 x 16 x 38', 'MARRON', 80,     23348,  b'0', 1706268807),
(7,   '30 x 12 x 32', 'MARRON', 100,    6765,   b'0', 1706268807),
(8,   '30 X 12 X 41', 'MARRON', 100,    188260, b'0', 1706268807),
(9,   '12 X 08 X 19', 'BLANCO', 100,    31225,  b'0', 1706268807),
(10,  '12 X 08 X 40', 'BLANCO', 100,    0,      b'0', 1706268807),
(11,  '22 X 10 X 30', 'BLANCO', 100,    5239,   b'0', 1706268807),
(12,  '22 X 10 X 42', 'BLANCO', 100,    0,      b'0', 1706268807),
(13,  '26 X 12 X 36', 'BLANCO', 100,    22996,  b'0', 1706268807),
(14,  '28 x 16 x 38', 'BLANCO', 80,     29,     b'0', 1706268807),
(15,  '30 x 12 x 32', 'BLANCO', 80,     12,     b'0', 1706268807),
(16,  '30 X 12 X 41', 'BLANCO', 80,     1907,   b'0', 1706268807),
(91,  '28 x 12 x 41', 'MARRON', 80,     23968,  b'0', 1706268807),
(92,  '28 x 16 x 38', 'MARRON', 80,     10499,  b'0', 1706268807),
(93,  '30 X 12 X 41', 'MARRON', 80,     1651,   b'0', 1706268807),
(94,  '30 X 16 X 43', 'MARRON', 100,    580,    b'0', 1706268807),
(95,  '26 X 12 X 41', 'MARRON', 100,    200,    b'0', 1706268807),
(96,  '22 X 12 X 41', 'MARRON', 100,    3062,   b'0', 1706268807),
(97,  '22 X 12 X 30', 'MARRON', 100,    1965,   b'0', 1706268807),
(97,  '22 X 10 X 24', 'MARRON', 100,    884,    b'0', 1706268807),
(98,  '22 X 10 X 20', 'MARRON', 100,    741,    b'0', 1706268807),
(99,  '12 X 08 X 26', 'MARRON', 100,    1295,   b'0', 1706268807);

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
(2, 6, 'Kraft', '0000-00-00', 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 10, 'Kraft', '2024-01-23', 0, '0', 0, 5000, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `listado_precios`
--
ALTER TABLE `listado_precios`
  ADD PRIMARY KEY (`ID_listado`),
  ADD KEY `ID_formato` (`ID_formato`);

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
-- AUTO_INCREMENT de la tabla `listado_precios`
--
ALTER TABLE `listado_precios`
  MODIFY `ID_listado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tabla_1`
--
ALTER TABLE `tabla_1`
  MODIFY `ID_formato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tabla_2`
--
ALTER TABLE `tabla_2`
  MODIFY `ID_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `listado_precios`
--
ALTER TABLE `listado_precios`
  ADD CONSTRAINT `listado_precios_ibfk_1` FOREIGN KEY (`ID_formato`) REFERENCES `tabla_1` (`ID_formato`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
