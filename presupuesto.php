<?php
require "includes/header.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Presupuesto</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Presupuestos</h1>

<?php
    echo "<h2>Costo Marginal</h2>";
    $data = [ 
        ["Descripción" => "Papel marginal",         "Valor unitario" =>  "1026", "Unidad" => "$/kg",    "KPI" => "0.0174",               "Unidad KPI" => "Kg/bolsa"],
        ["Descripción" => "Mano de obra marginal",  "Valor unitario" =>  "2000", "Unidad" => "$/hora",  "KPI" => "0.00833",             "Unidad KPI" => "horas/bolsa"],
        ["Descripción" => "Energía marginal",       "Valor unitario" =>    "50", "Unidad" => "$/kWh",   "KPI" => "0.0011979386792453",  "Unidad KPI" => "kWh/bolsa"],
        ["Descripción" => "Gluer marginal",         "Valor unitario" =>     "0", "Unidad" => "$/kg",    "KPI" => "0",                   "Unidad KPI" => "kg/bolsa"]
    ];   
    visualizarTabla($data);

    echo "<h2>Costo fijo - Electrico</h2>";
    $data2 = [ 
        ["Descripción" => "Energía máquina",    "Valor unitario" =>  "50", "Unidad" => "$/kWh", "Potencia" => "252.4",    "Horas por día" => "24",               "Días por mes" => "30"],
        ["Descripción" => "Energía Compresor",    "Valor unitario" =>  "50", "Unidad" => "$/kWh", "Potencia" => "400",    "Horas por día" => "8",               "Días por mes" => "20"],
        ["Descripción" => "Energía Iluminación",    "Valor unitario" =>  "50", "Unidad" => "$/kWh", "Potencia" => "2200",    "Horas por día" => "16",               "Días por mes" => "20"]
    ];   
    visualizarTablaFija($data2);
    
    function visualizarTabla($data) {
        $totalCostoMarginal = 0;
        if (count($data) > 0) {
            echo '<table border="1" class="responsive-table">';
            echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>KPI</th><th>Unidad KPI</th><th>Costo Marginal</th></tr>";
            foreach ($data as $row) {
                $costoMarginal = floatval($row['Valor unitario']) * floatval($row['KPI']);
                $totalCostoMarginal += $costoMarginal; 
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Descripción']) . "</td>";
                echo "<td>$" . number_format(floatval($row['Valor unitario']), 2, '.', ',') . "</td>"; 
                echo "<td>" . htmlspecialchars($row['Unidad']) . "</td>"; 
                echo "<td>" . htmlspecialchars($row['KPI']) . "</td>"; 
                echo "<td>" . htmlspecialchars($row['Unidad KPI']) . "</td>";
                echo "<td>$" . number_format($costoMarginal, 2, '.', ',') . "</td>";
                echo "</tr>";
            }
            echo "<tr><td colspan='5'>Total</td><td>$".number_format($totalCostoMarginal, 2, '.', ',')."</td></tr>";
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }
    }

    function visualizarTablaFija($data2) {
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
    
?>
<h2> Costo Fijo - Superficie</h2>

<h2> Costo Fijo - Mano de obra</h2>


</body>
</html>
