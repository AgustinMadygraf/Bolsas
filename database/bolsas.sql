-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-01-2024 a las 15:45:30
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
-- Base de datos: `bolsas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costos_operativos`
--

CREATE TABLE `costos_operativos` (
  `Nombre` varchar(255) NOT NULL,
  `Enero` decimal(10,2) DEFAULT NULL,
  `Febrero` decimal(10,2) DEFAULT NULL,
  `Marzo` decimal(10,2) DEFAULT NULL,
  `Abril` decimal(10,2) DEFAULT NULL,
  `Mayo` decimal(10,2) DEFAULT NULL,
  `Junio` decimal(10,2) DEFAULT NULL,
  `Julio` decimal(10,2) DEFAULT NULL,
  `Agosto` decimal(10,2) DEFAULT NULL,
  `Septiembre` decimal(10,2) DEFAULT NULL,
  `Octubre` decimal(10,2) DEFAULT NULL,
  `Noviembre` decimal(10,2) DEFAULT NULL,
  `Diciembre` decimal(10,2) DEFAULT NULL,
  `Total` decimal(10,2) GENERATED ALWAYS AS ((((((((((((coalesce(`Enero`,0) + coalesce(`Febrero`,0)) + coalesce(`Marzo`,0)) + coalesce(`Abril`,0)) + coalesce(`Mayo`,0)) + coalesce(`Junio`,0)) + coalesce(`Julio`,0)) + coalesce(`Agosto`,0)) + coalesce(`Septiembre`,0)) + coalesce(`Octubre`,0)) + coalesce(`Noviembre`,0)) + coalesce(`Diciembre`,0))) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `costos_operativos`
--

INSERT INTO `costos_operativos` (`Nombre`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`, `Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`) VALUES
('1 - RETIRO ASOCIADOS', '838234.00', '969355.00', '988284.00', '988285.81', '1530631.94', '1327002.56', '1632309.79', '377025.98', '473667.01', '3852074.00', '3998004.00', '5808000.00'),
('2 - PAPEL', '0.00', '0.00', '0.00', '1743000.00', '0.00', '0.00', '0.00', '5991608.82', '0.00', '0.00', '0.00', '0.00'),
('3 - OTROS', '296269.00', '770995.10', '544109.36', '310742.67', '217800.00', '158579.31', '221650.00', '824305.00', '918426.30', '878194.06', '0.00', '1327351.30'),
('4 - PUBLICIDAD', '0.00', '0.00', '0.00', '0.00', '0.00', '254100.00', '254100.00', '254100.00', '310002.00', '310002.00', '310002.00', '310002.00'),
('5 - ENERGÍA', '10000.00', '10000.00', '10000.00', '10000.00', '10000.00', '9309.16', '8642.16', '8860.53', '9166.42', '9166.42', '9166.42', '9166.42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `excedente_repartible_2023`
--

CREATE TABLE `excedente_repartible_2023` (
  `Legajo` int(11) NOT NULL,
  `Apellido` varchar(255) DEFAULT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Enero` decimal(10,2) DEFAULT NULL,
  `Febrero` decimal(10,2) DEFAULT NULL,
  `Marzo` decimal(10,2) DEFAULT NULL,
  `Abril` decimal(10,2) DEFAULT NULL,
  `Mayo` decimal(10,2) DEFAULT NULL,
  `Junio` decimal(10,2) DEFAULT NULL,
  `Julio` decimal(10,2) DEFAULT NULL,
  `Agosto` decimal(10,2) DEFAULT NULL,
  `Septiembre` decimal(10,2) DEFAULT NULL,
  `Octubre` decimal(10,2) DEFAULT NULL,
  `Noviembre` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `excedente_repartible_2023`
--

INSERT INTO `excedente_repartible_2023` (`Legajo`, `Apellido`, `Nombre`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`, `Agosto`, `Septiembre`, `Octubre`, `Noviembre`) VALUES
(238, 'Montenegro', 'Oreste Mariano', '59822.00', '53054.00', '50563.00', '50562.87', '84004.16', NULL, NULL, NULL, NULL, '227999.00', '288000.00'),
(574, 'Arriondo', 'Daniel', '39724.00', '34545.00', '50643.00', '50643.26', '77518.45', '79588.95', '92254.61', NULL, NULL, '214079.00', '229968.00'),
(986, 'Fernandez', 'Ariel Gustavo', '50272.00', '55557.00', '58080.00', '58080.32', '77382.79', '92398.79', '114340.99', NULL, NULL, '257824.00', '266400.00'),
(1072, 'Conti', 'Damian Emilio', '44362.00', '63584.00', '51246.00', '51246.16', '82686.35', NULL, NULL, NULL, NULL, '126750.00', '130500.00'),
(1083, 'Medina', 'Jorge Gabriel', '58265.00', '44015.00', '47006.00', '47005.79', '77927.58', '82158.92', '134186.15', NULL, NULL, '230849.00', '214950.00'),
(1153, 'Salazar', 'Sandro Ariel', '43606.00', '61949.00', '49437.00', '49437.47', '76829.40', '91698.79', '97844.61', NULL, NULL, '124800.00', '186312.00'),
(1216, 'Dirroco', 'Ruben Martin', '39825.00', '54052.00', '48131.00', '48131.19', '65890.68', '76808.99', '73165.20', NULL, NULL, NULL, NULL),
(1244, 'Almada', 'Marcelo Adrian Eliseo', '38212.00', '46202.00', '37842.00', '37841.77', '68313.13', '57429.25', '99955.52', NULL, NULL, '207099.00', '162450.00'),
(1310, 'Silva', 'Abel Alejandro', '20060.00', '42596.00', '58079.00', '58078.98', '74568.44', '79438.96', '87892.06', NULL, NULL, '191609.00', '221100.00'),
(1325, 'Rosales Arias', 'Rodrigo Cristian', '39960.00', '52030.00', '47733.00', '47733.28', '93205.17', NULL, NULL, NULL, NULL, '242999.00', '257190.00'),
(1397, 'Chaile', 'Martin Ezequiel', '38240.00', '40563.00', '55064.00', '55064.50', '74826.84', '80098.95', '65581.56', NULL, NULL, '222574.00', '193500.00'),
(1413, 'Laime', 'Juana Rosa', '43449.00', '49515.00', '52854.00', '52853.88', '78853.49', '81598.93', '102248.86', '102678.97', '167000.12', '237929.00', '279900.00'),
(1415, 'Butiler', 'Monica Patricia', '26869.00', '27650.00', '33400.00', '33400.44', '72888.88', '56979.25', '80618.54', '55601.32', NULL, NULL, NULL),
(1420, 'Paz', 'Maria Celeste', '41842.00', '59016.00', '51983.00', '51983.03', '75647.24', '87598.85', '104164.31', NULL, NULL, '271574.00', '260040.00'),
(1422, 'Gramajo', 'Erica Victoria', '39209.00', '47322.00', '48319.00', '48318.76', '75343.63', '70459.07', '108347.04', NULL, NULL, '206564.00', '178200.00'),
(1425, 'Plett', 'Maria de los Angeles', '39310.00', '50063.00', '51581.00', '51581.10', '82567.92', '71999.05', '86078.24', '140196.28', '162666.79', '203249.00', '250200.00'),
(1428, 'Andrade', 'Emiliana Hilda', '45667.00', '52767.00', '47026.00', '47025.88', '72027.56', '78558.97', '77113.39', NULL, NULL, '202029.00', '191424.00'),
(1430, 'Villanueva', 'Eliana Edith', '40329.00', '52621.00', '48232.00', '48231.68', '58707.31', '66859.12', '93661.88', '78549.41', '144000.10', '226824.00', '230400.00'),
(1446, 'Almarante', 'Nicolas', '38979.00', '43032.00', '48821.00', '48821.17', '77098.56', '88588.84', '115917.66', NULL, NULL, '234599.00', '212130.00'),
(1456, 'Hogas', 'Mariana Soledad', '50232.00', '39222.00', '52244.00', '52244.28', '84344.38', '84738.89', '98939.16', NULL, NULL, '222724.00', '245340.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `Nombre` varchar(255) NOT NULL,
  `Enero` decimal(10,2) DEFAULT NULL,
  `Febrero` decimal(10,2) DEFAULT NULL,
  `Marzo` decimal(10,2) DEFAULT NULL,
  `Abril` decimal(10,2) DEFAULT NULL,
  `Mayo` decimal(10,2) DEFAULT NULL,
  `Junio` decimal(10,2) DEFAULT NULL,
  `Julio` decimal(10,2) DEFAULT NULL,
  `Agosto` decimal(10,2) DEFAULT NULL,
  `Septiembre` decimal(10,2) DEFAULT NULL,
  `Octubre` decimal(10,2) DEFAULT NULL,
  `Noviembre` decimal(10,2) DEFAULT NULL,
  `Diciembre` decimal(10,2) DEFAULT NULL,
  `Total` decimal(10,2) GENERATED ALWAYS AS ((((((((((((coalesce(`Enero`,0) + coalesce(`Febrero`,0)) + coalesce(`Marzo`,0)) + coalesce(`Abril`,0)) + coalesce(`Mayo`,0)) + coalesce(`Junio`,0)) + coalesce(`Julio`,0)) + coalesce(`Agosto`,0)) + coalesce(`Septiembre`,0)) + coalesce(`Octubre`,0)) + coalesce(`Noviembre`,0)) + coalesce(`Diciembre`,0))) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`Nombre`, `Enero`, `Febrero`, `Marzo`, `Abril`, `Mayo`, `Junio`, `Julio`, `Agosto`, `Septiembre`, `Octubre`, `Noviembre`, `Diciembre`) VALUES
('INGRESOS', '2112876.46', '1989044.00', '1753811.40', '1262354.29', '771333.00', '1116105.67', '2364639.00', '2603461.89', '4454292.25', '1678702.30', '2298153.00', '3535258.60');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `costos_operativos`
--
ALTER TABLE `costos_operativos`
  ADD PRIMARY KEY (`Nombre`);

--
-- Indices de la tabla `excedente_repartible_2023`
--
ALTER TABLE `excedente_repartible_2023`
  ADD PRIMARY KEY (`Legajo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`Nombre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
