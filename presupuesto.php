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
<h2>Costo Marginal</h2>

<?php
    
    $data = [ 
        ["Descripción" => "Papel marginal",         "Valor unitario" =>  "1026", "Unidad" => "$/kg",    "KPI" => "0.011",      "Unidad KPI" => "Kg/bolsa"],
        ["Descripción" => "Mano de obra marginal",  "Valor unitario" =>  "2000", "Unidad" => "$/hora",  "KPI" => "0.00833", "Unidad KPI" => "horas/bolsa"],
        ["Descripción" => "Energía marginal",       "Valor unitario" => "50", "Unidad" => "$/kWh",   "KPI" => "0.0011979386792453",      "Unidad KPI" => "kWh/bolsa"]
    ];   

    if (count($data) > 0) {
        echo '<table border="1" class="responsive-table">';
        echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>KPI</th><th>Unidad KPI</th><th>Costo Marginal</th></tr>";
        foreach ($data as $row) {
            // Calcular el costo marginal como el producto del valor unitario por el KPI
            // Asegúrate de convertir los valores a tipos numéricos para realizar el cálculo
            $costoMarginal = floatval($row['Valor unitario']) * floatval($row['KPI']);
            
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Descripción'])                         . "</td>";
            echo "<td>$" . number_format(floatval($row['Valor unitario']), 2, '.', ',') . "</td>"; 
            echo "<td>" . htmlspecialchars($row['Unidad'])                              . "</td>"; 
            echo "<td>" . htmlspecialchars($row['KPI'])                                 . "</td>"; 
            echo "<td>" . htmlspecialchars($row['Unidad KPI'])                          . "</td>";
            // Mostrar el costo marginal calculado, formateado a 2 decimales
            echo "<td>$" . number_format($costoMarginal, 2, '.', ',')                   . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron registros en la tabla.";
    }
?>

<h2>Costo fijo</h2>

</body>
</html>
