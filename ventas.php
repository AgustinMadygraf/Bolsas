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
<h1>Ventas Mensuales - Año 2023 valores nominales</h1>
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
    <br><br><br><br><br>
<h1>Ventas Mensuales - Año 2023 valores actualizados a diciembre 2023</h1>
<table>
    <thead>
        <tr> 
            <th>Descripción     </th>
            <th>Valor actualizado dic 2023 </th>
        </tr>
    </thead>
    <tr>
        <td>Retiro asociados    </td>
        <td>$26,855,849.61      </td>
    </tr>
    <tr>
        <td>INGRESOS POR VENTAS </td>
        <td>$38,403,282.65      </td>
    </tr>  
    <tr>
        <td>PAPEL			    </td>
        <td>$12,823,457.58      </td>
    </tr> 
    <tr>
        <td>OTROS			    </td>
        <td>$9,028,850.18       </td>
    </tr>     
    <tr>
        <td>PUBLICIDAD (BURAKKO) </td>
        <td>$2,002,308.00         </td>
    </tr>     
    <tr>
        <td>ENERGÍA			    </td>
        <td>$187,624.91         </td>
    </tr>            
</table>
</body>

</html>
