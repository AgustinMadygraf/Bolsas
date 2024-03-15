<!--DataMaq/presupuestos.php-->
<?php
require "includes/header.php";

// Define una función para validar y sanitizar valores numéricos con precisión decimal
function sanitizeAndValidateFloat($value, $default = 0, $scale = 2) {
    // Filtra el valor usando FILTER_SANITIZE_NUMBER_FLOAT para eliminar caracteres no deseados
    $filteredValue = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Verifica si el valor filtrado es numérico y retorna un valor formateado a la escala deseada
    if (is_numeric($filteredValue)) {
        return round((float)$filteredValue, $scale);
    }

    // Si el valor filtrado no es numérico, retorna un valor predeterminado
    return $default;
}

// Aplicando la función a las entradas GET
$peso = isset($_GET['peso']) ? sanitizeAndValidateFloat($_GET['peso'], 0.042, 3) : 0.042; // Asume un valor predeterminado de 0.042 si no está definido
$peso = $peso / 1000; // Convertir a una unidad deseada si es necesario
$precio_venta = isset($_GET['precio_venta']) ? sanitizeAndValidateFloat($_GET['precio_venta'], 0, 2) : 0;
$formato = filter_var($_GET['formato'] ?? '', FILTER_SANITIZE_STRING);
$vel = filter_var($_GET['vel'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
$Trabajadores = filter_var($_GET['Trabajadores'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
$ComVent = filter_var($_GET['ComVent'] ?? 0, FILTER_SANITIZE_NUMBER_INT);

require "includes/datos.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Presupuesto</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Presupuesto - Formato bolsa: <?php echo $formato; ?></h1>
<?php echo "<br>Costo de Ventas: $ComVent %<br> ";?>
<form action="presupuesto.php" method="GET">
    <label for="vel1"> Velocidad de la máquina:</label>
    <select name="vel">
        <?php
        $velocidades = [40, 60, 80, 100]; // Definir las velocidades disponibles
        foreach ($velocidades as $velocidad) {
            // Si $vel coincide con la velocidad actual, marcarla como seleccionada
            echo '<option value="'.$velocidad.'"'.($vel == $velocidad ? ' selected' : '').'>'.$velocidad.'</option>';
        }
        ?>
    </select>
    <label for="vel2"> [bolsas por minuto]:</label>
    
    <input type="hidden" name="peso" value="<?php echo $peso*1000; ?>">
    <input type="hidden" name="precio_venta" value="<?php echo $precio_venta; ?>">
    <input type="hidden" name="formato" value="<?php echo $formato; ?>">
    <label for="Trabajadores"><br>Trabajadores: </label>
    <select name="Trabajadores">
        <?php
        $opcionesTrabajadores = [4, 5, 6, 8]; // Definir las opciones de trabajadores disponibles
        foreach ($opcionesTrabajadores as $opcion) {
            // Si $Trabajadores coincide con la opción actual, marcarla como seleccionada
            echo '<option value="'.$opcion.'"'.($Trabajadores == $opcion ? ' selected' : '').'>'.$opcion.'</option>';
        }
        ?>
    </select>
    <br>
    <label for="Costo de venta"> Costo de venta: </label>
    <select name="ComVent">
    <?php
    $opcionesComVent = [0, 5, 10, 15, 20]; // Definir las opciones de comisión de venta disponibles
    foreach ($opcionesComVent as $opcion) {
        // Si $ComVent coincide con la opción actual, marcarla como seleccionada
        echo '<option value="'.$opcion.'"'.($ComVent == $opcion ? ' selected' : '').'>'.$opcion.'%</option>';
    }
    ?>
</select>

    <br><br>
    <input type="submit" value="Actualizar">
</form>

<?php
    echo "<h2>Costos Variables</h2>";

    list($CostoVariablePapel, $CostoVariableEnergia,$CostoVariableManoObra,$CostoVariableGluer,$MgCont) = VerTablaCostosVariables($data1,$precio_venta,$ComVent);
    $datosJson = json_encode([
        ["Concepto", "Costo ($)"],
        ["Papel", $CostoVariablePapel],
        ["Energía", $CostoVariableEnergia],
        ["Pegamento", $CostoVariableGluer],
        ["Mano de obra", $CostoVariableManoObra],
        ["Margen de contribución", $MgCont]
    ]);    
    echo "<h3>Margen de contribución por hora:$";
    echo number_format($MgCont*($vel*60), 2, '.', ',');
    echo "</h3>";
    echo "Cantidad de horas para cubrir los costos fijos: ";
    echo number_format($totalCostoFijo/($MgCont*($vel*60)), 2, '.', ',');
    echo "<br>";
    include 'includes/chart.php'; 
    echo "<h2>Costos fijo </h2>";
    echo "<h3>Costo fijo - Electrico</h3>";
    visualizarTabla2($data2);
    echo "<h3> Costo Fijo - Superficie</h3>";
    visualizarTabla3($data3);
    echo "<h3> Costo Fijo - Mano de obra</h3>";
    visualizarTabla4($data4);
    function VerTablaCostosVariables($data1,$precio_venta,$ComVent) {
        $totalCostoMarginal = 0;
        if (count($data1) > 0) {
            echo '<table border="1" class="responsive-table">';
            echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Fecha</th><th>Unidad</th><th>KPI</th><th>Unidad KPI</th><th>Costo Variable</th></tr>";
            foreach ($data1 as $row) {
                $costoMarginal = floatval($row['Valor unitario']) * floatval($row['KPI']);
                $totalCostoMarginal += $costoMarginal; 
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
            echo "<tr><td colspan='6'><strong>Total Costo Variable      </strong></td><td><strong>$".number_format($totalCostoMarginal, 2, '.', ',')."</td></strong></tr>";
            $MgCont =$precio_venta-$totalCostoMarginal;
            echo "<tr><td colspan='6'><strong>Precio de venta           </strong></td><td>$" . number_format($precio_venta, 2, '.', ',') . "</td></tr>";
            echo "<tr><td colspan='6'><strong>Margen de contribución    </strong></td><td>$".number_format($MgCont, 2, '.', ',')."</td></tr>";
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }
        $CostoVariablePapel = floatval($data1[0]['Valor unitario']) * floatval($data1[0]['KPI']);
        $CostoVariableManoObra = floatval($data1[1]['Valor unitario']) * floatval($data1[1]['KPI']);
        $CostoVariableEnergia = 10*floatval($data1[2]['Valor unitario']) * floatval($data1[2]['KPI']); // TUve que multiplicar por diez par que figure en el chart
        $CostoVariableGluer = floatval($data1[3]['Valor unitario']) * floatval($data1[3]['KPI']);
        return array($CostoVariablePapel, $CostoVariableEnergia,$CostoVariableManoObra,$CostoVariableGluer,$MgCont);
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
            echo "<tr><td colspan='6'>Total</td><td>$".number_format($totalCostoFijo, 2, '.', ',')."</td></tr>";
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
            echo "<tr><td colspan='4'>Total</td><td>$" . number_format($totalCostoEspacio, 2, '.', ',') . "</td></tr>";
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
            echo "<tr><td colspan='4'>Total</td><td>$" . number_format($totalCostoManoObra, 2, '.', ',') . "</td></tr>";
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }
    }  
?>
</body>
</html>
