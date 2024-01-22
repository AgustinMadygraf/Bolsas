<!--asociados.php-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Asociados - Año 2023</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<?php
    require "includes/header.php";
    ?>
    <h1>Tabla de Asociados en bolsas</h1>
    <?php
        $data = include('includes/GetData_0.php'); // Inclusión de los datos

        if (count($data) > 0) {
            echo "<table>";
            echo "<tr><th>Legajo</th><th>Apellido</th><th>Nombre</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th></tr>";
            
            foreach ($data as $row) {
                echo "<tr>";
                echo "<td>" . $row["Legajo"] . "</td>";
                echo "<td>" . $row["Apellido"] . "</td>";
                echo "<td>" . $row["Nombre"] . "</td>";
                echo "<td>" . $row["Enero"] . "</td>";
                echo "<td>" . $row["Febrero"] . "</td>";
                echo "<td>" . $row["Marzo"] . "</td>";
                echo "<td>" . $row["Abril"] . "</td>";
                echo "<td>" . $row["Mayo"] . "</td>";
                echo "<td>" . $row["Junio"] . "</td>";
                echo "<td>" . $row["Julio"] . "</td>";
                echo "<td>" . $row["Agosto"] . "</td>";
                echo "<td>" . $row["Septiembre"] . "</td>";
                echo "<td>" . $row["Octubre"] . "</td>";
                echo "<td>" . $row["Noviembre"] . "</td>";
                echo "</tr>"; }
                echo "</table>";
            } else {
                echo "No se encontraron registros en la tabla.";
                    }

$stmt->close();
$conn->close();
?>