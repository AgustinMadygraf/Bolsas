<!--asociados.php-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Asociados</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
    <h1>Tabla de Asociados en bolsas</h1>
    <?php
        require 'includes/conn.php'; // Inclusión de las credenciales de la base de datos

        $conn = new mysqli($server, $usuario, $pass, 'bolsas'); // Conexión a la base de datos

        if ($conn->connect_error) {
            die("La conexión a la base de datos falló: " . $conn->connect_error);
        }

        // Consulta preparada para mayor seguridad
        $stmt = $conn->prepare("SELECT Legajo, Apellido, Nombre, Enero, Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Septiembre, Octubre, Noviembre FROM excedente_repartible_2023");
        $stmt->execute();
        $result = $stmt->get_result();

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
            echo "</tr>"; }
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }

$stmt->close();
$conn->close();
?>