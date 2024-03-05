<?php
require "includes/header.php";

if(isset($_GET['peso']) && !empty($_GET['peso'])) {
    // Sanitiza el valor para asegurarse de que es un número
    // Por ejemplo, si esperas un valor numérico, puedes hacerlo así:
    $peso = filter_var($_GET['peso'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $peso = $peso/1000;

    // Ahora puedes usar la variable $peso en tu script
    // Por ejemplo, si necesitas pasarlo a otro script o usarlo en una función
    require "includes/datos.php"; // Suponiendo que en este archivo necesitas usar $peso

    // Código adicional que hace uso de $peso

} else {
    $peso = "0.042";
    echo "Parámetro 'peso' no especificado. por defecto peso = $peso gramos";
    

}



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
<h1>Presupuestos</h1>

<?php
    echo "<h2>Costo Marginal</h2>";
    visualizarTabla1($data1);
    echo "<h2>Costo fijo - Electrico</h2>";
    visualizarTabla2($data2);
    echo "<h2> Costo Fijo - Superficie</h2>";
    //visualizarTabla3($data3);
    echo "<h2> Costo Fijo - Mano de obra</h2>";
    //visualizarTabla4($data4);

    function visualizarTabla1($data1) {
        $totalCostoMarginal = 0;
        if (count($data1) > 0) {
            echo '<table border="1" class="responsive-table">';
            echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>KPI</th><th>Unidad KPI</th><th>Costo Marginal</th></tr>";
            foreach ($data1 as $row) {
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
    
?>



</body>
</html>
