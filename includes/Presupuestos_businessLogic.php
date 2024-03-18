<!--Bolsas/includes/Presupuestos_businessLogic.php-->

<?php
$velocidades = [40, 60, 80, 100];
$opcionesTrabajadores = [4, 5, 6, 8];
$opcionesComVent = [0, 5, 10, 15, 20];


/**
 * Sanitiza y valida un valor flotante, asegurando que el resultado sea un flotante con el número deseado de dígitos decimales.
 * Si el valor no es numérico, retorna un valor predeterminado.
 *
 * @param mixed $value El valor a sanitizar y validar.
 * @param float $default El valor predeterminado a retornar si $value no es un número.
 * @param int $scale El número de dígitos decimales a conservar.
 * @return float El valor sanitizado y validado como flotante.
 */
function sanitizeAndValidateFloat($value, $default = 0, $scale = 2) {
    $filteredValue = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if (is_numeric($filteredValue)) {
        return round((float)$filteredValue, $scale);
    }
    return $default;
}

/**
 * Obtiene y prepara los datos del presupuesto a partir de los parámetros de la petición.
 *
 * @param float $peso La variable de salida para el peso del presupuesto.
 * @param float $precio_venta La variable de salida para el precio de venta del presupuesto.
 * @param string $formato La variable de salida para el formato del presupuesto.
 * @param int $vel La variable de salida para la velocidad del presupuesto.
 * @param int $Trabajadores La variable de salida para el número de trabajadores del presupuesto.
 * @param int $ComVent La variable de salida para el costo de ventas del presupuesto.
 * @return void
 */
function getPresupuestoData(&$peso, &$precio_venta, &$formato, &$vel, &$Trabajadores, &$ComVent) {
    // Obtener los parámetros de la petición y aplicar sanitización/validación si es necesario
    $rawPeso = $_GET['peso'] ?? 0.042;
    $rawPrecioVenta = $_GET['precio_venta'] ?? 0;
    $rawFormato = $_GET['formato'] ?? '';
    $rawVelocidad = $_GET['vel'] ?? 40;
    $rawTrabajadores = $_GET['Trabajadores'] ?? 4;
    $rawComVent = $_GET['ComVent'] ?? 0;

    // Sanitizar y validar los parámetros
    $peso = sanitizeAndValidateFloat($rawPeso, 0.042, 3) / 1000;
    $precio_venta = sanitizeAndValidateFloat($rawPrecioVenta, 0, 2);
    $formato = filter_var($rawFormato, FILTER_SANITIZE_STRING);
    $vel = filter_var($rawVelocidad, FILTER_SANITIZE_NUMBER_INT);
    $Trabajadores = filter_var($rawTrabajadores, FILTER_SANITIZE_NUMBER_INT);
    $ComVent = filter_var($rawComVent, FILTER_SANITIZE_NUMBER_INT);
}


/**
 * Incluye la tabla de costos variables en el HTML.
 *
 * @param array $data1 Datos de los costos variables.
 * @param float $precio_venta Precio de venta del presupuesto.
 * @param int $ComVent El costo de ventas.
 * @return void
 */
function includeCostosVariables($data1, $precio_venta, $ComVent,$vel) {
    list($CostoVariablePapel, $CostoVariableEnergia,$CostoVariableManoObra,$CostoVariableGluer,$MgCont,$CostoVenta) = DatosCostosVariables($data1,$precio_venta,$ComVent);
    VerTablaCostosVariables($data1,$precio_venta,$ComVent);
    $datosJson = json_encode([
        ["Concepto", "Costo ($)"],
        ["Papel", $CostoVariablePapel],
        ["Energía", $CostoVariableEnergia],
        ["Pegamento", $CostoVariableGluer],
        ["Mano de obra", $CostoVariableManoObra], 
        ["Costo de Ventas", $CostoVenta],
        ["Margen de contribución", $MgCont]
    ]);    
    echo "<h3>Margen de contribución por hora: $";
    echo number_format($MgCont*($vel*60), 2, '.', ',');
    echo "</h3>";
    include 'includes/chart.php';   
}


/**
 * Incluye la tabla de costos fijos en el HTML.
 *
 * @param array $data2 Datos de los costos fijos eléctricos.
 * @param array $data3 Datos de los costos fijos de superficie.
 * @param array $data4 Datos de los costos fijos de mano de obra.
 * @param float $vel La velocidad del presupuesto.
 * @param float $precio_venta El precio de venta del presupuesto.
 * @param int $ComVent El costo de ventas del presupuesto.
 * @return void
 */
function includeCostosFijos($data2, $data3, $data4, $vel, $precio_venta, $ComVent,$MgCont) {
    echo "<h2>Costos fijo </h2>";
    echo "<h3>Costo fijo - Electrico</h3>";
    visualizarTabla2($data2);
    echo "<h3> Costo Fijo - Superficie</h3>";
    visualizarTabla3($data3);
    echo "<h3> Costo Fijo - Mano de obra</h3>";
    visualizarTabla4($data4);
    list($costoElectrico, $costoSuperficie, $costoManoObra, $costoTotalFijo) = calcularCostosFijos($data2, $data3, $data4);
    echo "<h2>Costos Fijos Totales</h2>";
    echo "<p>Total Costo Eléctrico: $" . number_format($costoElectrico, 2) . "</p>";
    echo "<p>Total Costo de Superficie: $" . number_format($costoSuperficie, 2) . "</p>";
    echo "<p>Total Costo de Mano de Obra: $" . number_format($costoManoObra, 2) . "</p>";
    echo "<p><strong>Costo Fijo Total: $" . number_format($costoTotalFijo, 2) . "</strong></p>";
    echo "<h3>Margen de contribución por hora: $" . number_format(calcularMargenContribucionPorHora($MgCont, $vel), 2, '.', ',') . "</h3>";
    echo "<h3>Cantidad de horas para cubrir los costos fijos: " . number_format(calcularHorasParaCubrirCostosFijos($costoTotalFijo, $MgCont, $vel), 2, '.', ',') . " horas</h3>";
    echo "<h3>Cantidad de turnos para cubrir los costos fijos: " . number_format(calcularTurnosParaCubrirCostosFijos($costoTotalFijo, $MgCont, $vel), 2, '.', ',') . " turnos de 8 horas</h3>";
}




function calcularCostosFijos($data2, $data3, $data4) {
    $costoElectrico = 0;
    $costoSuperficie = 0;
    $costoManoObra = 0;

    // Calcula el costo eléctrico
    foreach ($data2 as $item) {
        $potenciaEnKw = $item['Potencia'] / 1000; // Convierte W a kW
        $horasMes = $item['Horas por día'] * $item['Días por mes'];
        $costoElectrico += $potenciaEnKw * $horasMes * $item['Valor unitario'];
    }

    // Calcula el costo de superficie
    foreach ($data3 as $item) {
        $costoSuperficie += $item['Superficie'] * $item['Valor unitario'];
    }

    // Calcula el costo de mano de obra
    foreach ($data4 as $item) {
        $costoManoObra += $item['Horas'] * $item['Valor unitario'];
    }

    $costoTotalFijo = $costoElectrico + $costoSuperficie + $costoManoObra;
    return array($costoElectrico, $costoSuperficie, $costoManoObra, $costoTotalFijo);
}


function VerTablaCostosVariables($data1,$precio_venta,$ComVent) {
    $totalCostoVariable = 0;
    if (count($data1) > 0) {
        echo '<table border="1" class="responsive-table">';
        echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Fecha</th><th>Unidad</th><th>KPI</th><th>Unidad KPI</th><th>Costo Variable</th></tr>";
        foreach ($data1 as $row) {
            $costoMarginal = floatval($row['Valor unitario']) * floatval($row['KPI']);
            $totalCostoVariable += $costoMarginal; 
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Descripción']) . "</td>";
            echo "<td>$" . number_format(floatval($row['Valor unitario']), 2, '.', ',') . "</td>"; 
            echo "<td></td>"; 
            echo "<td>" . htmlspecialchars($row['Unidad']) . "</td>"; 
            echo "<td>" . htmlspecialchars($row['KPI']) . "</td>"; 
            echo "<td>" . htmlspecialchars($row['Unidad KPI']) . "</td>";
            echo "<td>$" . number_format($costoMarginal, 2, '.', ',') . "</td>";
            echo "</tr>";
        }
        $CostoVenta = $precio_venta * ($ComVent/100);
        echo "<tr><td>Costo de Ventas </td><td> $ComVent %</td><td colspan='4'></td><td>$$CostoVenta</td></tr>";
        echo "<tr><td colspan='6'><strong>Total Costo Variable      </strong></td><td><strong>$".number_format($totalCostoVariable, 2, '.', ',')."</td></strong></tr>";
        $MgCont =$precio_venta-$totalCostoVariable-$CostoVenta;
        echo "<tr><td colspan='6'><strong>Precio de venta           </strong></td><td>$" . number_format($precio_venta, 2, '.', ',') . "</td></tr>";
        echo "<tr><td colspan='6'><strong>Margen de contribución    </strong></td><td>$".number_format($MgCont, 2, '.', ',')."</td></tr>";
        echo "</table>";
    } else {
        echo "No se encontraron registros en la tabla.";
    }
}
// Asegúrate de que este cálculo se realice correctamente
function DatosCostosVariables($data1,$precio_venta,$ComVent) {
    $totalCostoVariable = 0;
    // Asumiendo que $data1 contiene todos los costos variables necesarios
    foreach ($data1 as $costo) {
        $totalCostoVariable += floatval($costo['Valor unitario']) * floatval($costo['KPI']);
    }
    $CostoVenta = $precio_venta * ($ComVent / 100);
    $totalCostoVariable += $CostoVenta; // Asegúrate de incluir el costo de venta en el total
    $MgCont = $precio_venta - $totalCostoVariable;
    return array($CostoVariablePapel, $CostoVariableEnergia, $CostoVariableManoObra, $CostoVariableGluer, $MgCont, $CostoVenta);
}




function visualizarTabla2($data2) {
    $totalCostoFijo = 0;
    if (count($data2) > 0) {
        echo '<table border="1" class="responsive-table">';
        echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>Potencia</th><th>Horas por día</th><th>Días por mes</th><th>Costo Fijo mensual</th></tr>"; 
        foreach ($data2 as $row) {
            $potenciaEnKw = floatval($row['Potencia']) / 1000; 
            $consumoEnergiaMensualKwh = $potenciaEnKw * floatval($row['Horas por día']) * intval($row['Días por mes']);
            $costoFijoMensual = $consumoEnergiaMensualKwh * floatval($row['Valor unitario']);
            $totalCostoFijo += $costoFijoMensual; 
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Descripción']) . "</td>";
            echo "<td>$" . number_format(floatval($row['Valor unitario']), 2, '.', ',') . "</td>"; 
            echo "<td>" . htmlspecialchars($row['Unidad']) . "</td>"; 
            echo "<td>" . htmlspecialchars($row['Potencia']) . " W</td>"; 
            echo "<td>" . htmlspecialchars($row['Horas por día']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Días por mes']) . "</td>";
            echo "<td>$" . number_format($costoFijoMensual, 2, '.', ',') . "</td>";
            echo "</tr>";
        }
        echo "<tr><td colspan='6'>SubTotal</td><td>$".number_format($totalCostoFijo, 2, '.', ',')."</td></tr>";
        echo "</table>";
    } else {
        echo "No se encontraron registros en la tabla.";
    }
}
function visualizarTabla3($data3) {
    $totalCostoEspacio = 0; // Inicializar la suma total del costo

    if (count($data3) > 0) {
        echo '<table border="1" class="responsive-table">';
        // Corregir los encabezados de las columnas según los datos disponibles
        echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>Superficie (M2)</th><th>Costo Mensual</th></tr>"; 

        foreach ($data3 as $row) {
            // Calcular el costo mensual como el producto del valor unitario por la superficie
            $costoMensual = floatval($row['Valor unitario']) * floatval($row['Superficie']);
            $totalCostoEspacio += $costoMensual;
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Descripción']) . "</td>";
            echo "<td>$" . number_format(floatval($row['Valor unitario']), 2, '.', ',') . "</td>";
            echo "<td>" . htmlspecialchars($row['Unidad']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Superficie']) . "</td>";
            echo "<td>$" . number_format($costoMensual, 2, '.', ',') . "</td>";
            echo "</tr>";
        }
        // Mostrar el total del costo fijo mensual
        echo "<tr><td colspan='4'>SubTotal</td><td>$" . number_format($totalCostoEspacio, 2, '.', ',') . "</td></tr>";
        echo "</table>";
    } else {
        echo "No se encontraron registros en la tabla.";
    }
}
function visualizarTabla4($data4) {
    // Inicializar la suma total del costo de mano de obra
    $totalCostoManoObra = 0;

    if (count($data4) > 0) {
        echo '<table border="1" class="responsive-table">';
        // Asegúrate de ajustar los encabezados de las columnas según tus necesidades
        echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>Horas</th><th>Costo Total</th></tr>"; 
        foreach ($data4 as $row) {
            // Calcular el costo total como el producto del valor unitario por las horas
            $costoTotal = floatval($row['Valor unitario']) * floatval($row['Horas']);
            // Sumar al total general de costo de mano de obra
            $totalCostoManoObra += $costoTotal;
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Descripción']) . "</td>";
            echo "<td>$" . number_format(floatval($row['Valor unitario']), 2, '.', ',') . "</td>";
            echo "<td>" . htmlspecialchars($row['Unidad']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Horas']) . "</td>";
            echo "<td>$" . number_format($costoTotal, 2, '.', ',') . "</td>";
            echo "</tr>";
        }
        // Mostrar el total del costo de mano de obra
        echo "<tr><td colspan='4'>Sub Total</td><td>$" . number_format($totalCostoManoObra, 2, '.', ',') . "</td></tr>";
        echo "</table>";
    } else {
        echo "No se encontraron registros en la tabla.";
    }
}  


function calcularMargenContribucionPorHora($margenContribucion, $velocidad, $minutosPorHora = 60) {
    return $margenContribucion * ($velocidad * $minutosPorHora);
}

function calcularHorasParaCubrirCostosFijos($costoTotalFijo, $margenContribucion, $velocidad) {
    $margenPorHora = calcularMargenContribucionPorHora($margenContribucion, $velocidad);
    return $costoTotalFijo / $margenPorHora;
}

function calcularTurnosParaCubrirCostosFijos($costoTotalFijo, $margenContribucion, $velocidad, $horasPorTurno = 8) {
    $horasParaCubrir = calcularHorasParaCubrirCostosFijos($costoTotalFijo, $margenContribucion, $velocidad);
    return $horasParaCubrir / $horasPorTurno;
}


?>