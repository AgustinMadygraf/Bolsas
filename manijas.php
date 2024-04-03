<?php
require "includes/header.php";
require 'includes/conn_bolsas.php';
include 'includes/db_functions.php';

// Datos de ejemplo para los costos
$costos = [
    'Papel parche'      => [1250, "$/kg", 1.50, "kg/manijas"],
    'cuerda retorcida'  => [1.50, 1.50, 1.50, 1.50],
    'Energia'           => [0.30, 0.30, 1.50, 0.30],
    'ManoObra'          => [0.75, 0.75, 1.50, 0.75],
    'Pegamento'         => [0.20, 0.20, 1.50, 0.20]
];


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Costos de Confección de Manijas de Papel</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Costos de Confección de Manijas de Papel</h1>
<?php
if (count($costos) > 0) {
    echo '<table border="1">';
    // Encabezados de la tabla
    echo "<tr><th>Tipo de Costo</th><th>Precio Unitario</th><th>Unidad</th><th>KPI</th><th>Unidad KPI</th><th>Costo Variable</th></tr>";
    // Iterar sobre cada tipo de costo
    foreach ($costos as $tipo => $valores) {
        echo "<tr>";
        echo "<td>" . $tipo . "</td>"; // Nombre del tipo de costo
        // Mostrar cada valor en la fila
        // El primer y tercer valor serán tratados como numéricos para aplicar number_format
        // El segundo y cuarto valor, al ser cadenas de texto (unidad y unidad KPI), se insertan directamente sin format
        echo "<td>" . number_format($valores[0], 2) . "</td>"; // Precio Unitario
        echo "<td>" . $valores[1] . "</td>"; // Unidad
        echo "<td>" . number_format($valores[2], 2) . "</td>"; // KPI
        echo "<td>" . $valores[3] . "</td>"; // Unidad KPI
        // Calcular el costo variable como producto del precio unitario y el KPI
        $costoVariable = $valores[0] * $valores[2];
        echo "<td>" . number_format($costoVariable, 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron registros.";
}
?>
</body>
</html>
