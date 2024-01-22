<!--costos_operativos.php-->
<?php
require "includes/header.php";

function obtenerDatosCosto($conexion) {
    $sql = "SELECT Nombre, Total FROM ventas ORDER BY Total DESC";
    $resultado = $conexion->query($sql);
    $datos = [["Nombre", "Total"]]; // Encabezado para Google Charts

    if ($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
            $datos[] = [$fila["Nombre"], floatval($fila["Total"])];
        }
    }
    return $datos;
            }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Costos Operativos</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Ventas Mensuales - Año 2023</h1>
<?php
    $data = include('includes/GetData_3.php'); // Inclusión de los datos
    if (count($data) > 0) {
        echo '<table border="1" class="responsive-table">';
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

             
            try {
                $conexion = new mysqli($server, $usuario, $pass, 'bolsas');
                if ($conexion->connect_error) {
                    throw new Exception("Fallo en la conexión: " . $conexion->connect_error);
                }
                $datosGrafico = obtenerDatosCosto($conexion);
                $datosJson = json_encode($datosGrafico);
            } catch (Exception $e) {
                error_log("Error: " . $e->getMessage());
                // Manejo del error
                $datosJson = "[]";
            }
            
            //echo "<br><br><br><br>datosJson:<br><br>".$datosJson."<br><br><br><br>";
            $conexion->close();
            
            include 'includes/chart.php'; 
            include 'includes/table.php'; 
                  
    ?>
</body>
</html>
