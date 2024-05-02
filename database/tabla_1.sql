-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-05-2024 a las 18:33:27
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
  `ancho` int(11) NOT NULL,
  `fuelle` int(11) NOT NULL,
  `alto` int(11) NOT NULL,
  `color` varchar(11) NOT NULL,
  `gramaje` int(11) NOT NULL,
  `cantidades` int(11) NOT NULL,
  `manijas` bit(1) NOT NULL,
  `fechatiempo` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tabla_1`
--

INSERT INTO `tabla_1` (`ID_formato`, `formato`, `ancho`, `fuelle`, `alto`, `color`, `gramaje`, `cantidades`, `manijas`) VALUES
(1, '12 X 08 X 19', 125, 80, 190, 'MARRON', 100, 56084, b'0'),
(2, '12 X 08 X 40', 125, 80, 400, 'MARRON', 100, 61464, b'0'),
(3, '22 X 10 X 30', 220, 100, 300, 'MARRON', 100, 50827, b'0'),
(4, '22 X 10 X 42', 220, 100, 420, 'MARRON', 100, 3663, b'0'),
(5, '26 X 12 X 36', 260, 120, 360, 'MARRON', 100, 14277, b'0'),
(6, '28 x 16 x 38', 280, 160, 380, 'MARRON', 100, 0, b'0'),
(7, '30 x 12 x 32', 300, 120, 320, 'MARRON', 100, 6765, b'0'),
(8, '30 X 12 X 41', 300, 120, 410, 'MARRON', 100, 18260, b'0'),
(9, '28 x 16 x 38', 280, 160, 380, 'MARRON', 80, 23348, b'0'),
(10, '12 X 08 X 19', 125, 80, 190, 'BLANCO', 100, 31225, b'0'),
(11, '12 X 08 X 40', 125, 80, 400, 'BLANCO', 100, 0, b'0'),
(12, '22 X 10 X 30', 220, 100, 300, 'BLANCO', 100, 5239, b'0'),
(13, '22 X 10 X 42', 220, 100, 420, 'BLANCO', 100, 0, b'0'),
(14, '26 X 12 X 36', 260, 120, 360, 'BLANCO', 100, 22996, b'0'),
(15, '28 x 16 x 38', 280, 160, 380, 'BLANCO', 80, 29, b'0'),
(16, '30 x 12 x 32', 300, 120, 320, 'BLANCO', 80, 12, b'0'),
(17, '30 X 12 X 41', 300, 120, 410, 'BLANCO', 80, 1907, b'0'),
(90, '28 x 12 x 41', 280, 120, 410, 'MARRON', 80, 23968, b'0'),
(91, '28 x 16 x 38', 280, 160, 380, 'MARRON', 80, 10499, b'0'),
(92, '30 X 12 X 41', 300, 120, 410, 'MARRON', 80, 1651, b'0'),
(93, '30 X 16 X 43', 300, 160, 430, 'MARRON', 100, 580, b'0'),
(94, '26 X 12 X 41', 260, 120, 410, 'MARRON', 100, 200, b'0'),
(95, '22 X 12 X 41', 220, 120, 410, 'MARRON', 100, 3062, b'0'),
(96, '22 X 12 X 30', 220, 120, 300, 'MARRON', 100, 1965, b'0'),
(97, '22 X 10 X 24', 220, 100, 240, 'MARRON', 100, 884, b'0'),
(98, '22 X 10 X 20', 220, 100, 200, 'MARRON', 100, 741, b'0'),
(99, '12 X 08 X 26', 125, 80, 260, 'MARRON', 100, 1295, b'0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tabla_1`
--
ALTER TABLE `tabla_1`
  ADD PRIMARY KEY (`ID_formato`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
