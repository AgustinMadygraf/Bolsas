<!--costos_operativos.php-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Costos Operativos</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Costos Operativos Mensuales - Año 2023</h1>
<?php
    require "includes/header.php";
    $data = include('includes/GetData_2.php'); // Inclusión de los datos
    if (count($data) > 0) {
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th><th>Total</th></tr>";
        foreach ($data as $row) {
            echo "<tr>";
            foreach ($row as $key => $cell) {
                // Formatea los números con separadores de miles y decimales
                if ($key != 'Nombre' && $cell != NULL) {
                    $cell = number_format($cell, 2, '.', ',');
                }
                echo "<td>" . $cell . "</td>";
                }
            echo "</tr>";
            }
            echo "</table>";
            } 
            else {
                echo "No se encontraron registros en la tabla.";
            }
        function obtenerDatosCosto($conexion) {       
    }
    try {
        //
        $datosJson = json_encode($datosGrafico);
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        // Manejo del error
    }
    $conexion->close();
    include 'includes/chart.php';        
    ?>
</body>
</html>
