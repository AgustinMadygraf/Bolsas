<!--// DataMaq/includes/Presupuestos_businessLogic.php-->

<?php
$velocidades = [40, 60, 80, 100];
$opcionesTrabajadores = [4, 8, 10, 12, 16, 22];
$opcionesComVent = [0, 5, 10, 15, 20];

function visualizarTablaCostosVariables($data1,$precio_venta,$ComVent) {
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
        $totalCostoVariable = $totalCostoVariable + $CostoVenta;
        $MgCont =$precio_venta-$totalCostoVariable;

        echo "<tr><td>Costo de Ventas </td><td> $ComVent %</td><td colspan='4'> </td><td>$".        number_format($CostoVenta, 2, '.', ',').            "</td></tr>";
        echo "<tr><td colspan='6'><strong>Total Costo Variable      </strong>   </td><td><strong>$".number_format($totalCostoVariable, 2, '.', ',').    "</td></strong></tr>";
        echo "<tr><td colspan='6'><strong>Precio de venta           </strong>   </td><td>$" .       number_format($precio_venta, 2, '.', ',') .         "</td></tr>";
        echo "<tr><td colspan='6'><strong>Margen de contribución    </strong>   </td><td>$".        number_format($MgCont, 2, '.', ',').                "</td></tr>";
        echo "</table>";
    } else {
        echo "No se encontraron registros en la tabla.";
    }} 

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
?>