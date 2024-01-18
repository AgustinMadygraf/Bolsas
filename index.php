<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Empleados</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Tabla de Asociados en bolsas</h1>
    <?php
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "12345678";
    $dbname = "bolsas";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }

    // Consulta SQL para obtener los datos de la tabla
    $sql = "SELECT * FROM excedente_repartible_2023";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Legajo</th><th>Apellido</th><th>Nombre</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th></tr>";
        
        while($row = $result->fetch_assoc()) {
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
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron registros en la tabla.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>
</body>
</html>
