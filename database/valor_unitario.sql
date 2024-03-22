--
-- Base de datos: `bolsas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor_unitario`
--

CREATE TABLE `valor_unitario` (
  `ID` int(11) NOT NULL,
  `Concepto` varchar(255) NOT NULL,
  `Unidad` varchar(255) NOT NULL,
  `Valor` decimal(10,2) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `valor_unitario`
--

INSERT INTO `valor_unitario` (`ID`, `Concepto`, `Unidad`, `Valor`, `Fecha`) VALUES
(1, 'Papel', '$/Kg', '1026.00', '2024-02-15'),
(2, 'Mano de Obra', '$/h', '2000.00', '2024-02-15'),
(3, 'Energía', '$/kWh', '50.00', '2024-02-15'),
(4, 'Gluer', '$/Kg', '0.00', '2024-02-15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `valor_unitario`
--
ALTER TABLE `valor_unitario`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `valor_unitario`
--
ALTER TABLE `valor_unitario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
