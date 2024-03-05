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
    
    $data = [ 
        ["Descripción" => "Papel marginal",         "Valor unitario" =>  "1026", "Unidad" => "$/kg"  , "KPI" => ""],
        ["Descripción" => "Mano de obra marginal",  "Valor unitario" =>  "2000", "Unidad" => "$/hora", "KPI" => ""],
        ["Descripción" => "Energía marginal",       "Valor unitario" => "50000", "Unidad" => "$/kWh" , "KPI" => ""]
    ];   
    
    // El siguiente bloque es opcional y solo para propósitos de debug
     echo "<pre>". print_r($data). "</pre>";

    if (count($data) > 0) {
        echo '<table border="1" class="responsive-table">';
        echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th></tr>";
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Descripción']) . "</td>";
            echo "<td>$" . number_format(floatval($row['Valor unitario']), 2, '.', ',') . "</td>"; 
            echo "<td>" . htmlspecialchars($row['Unidad']) . "</td>"; 
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron registros en la tabla.";
    }
?>
</body>
</html>
