<!--DataMaq/presupuestos.php-->
<?php
require "includes/header.php";

require 'includes/conn_bolsas.php';
include 'includes/db_functions.php'; 

function obtenerDatosValorUnitario() {
    $sql = "SELECT ID, Concepto, Unidad, Valor, Fecha FROM valor_unitario ORDER BY ID ASC";
    return getArraySQL($sql);
}



// Obtiene los datos
$datosValorUnitario = obtenerDatosValorUnitario();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Valores Unitarios</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Tabla de Valores Unitarios</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Concepto</th>
        <th>Unidad</th>
        <th>Valor</th>
        <th>Fecha</th>
    </tr>
    <?php foreach ($datosValorUnitario as $fila): ?>
    <tr>
        <td><?php echo htmlspecialchars($fila['ID']); ?></td>
        <td><?php echo htmlspecialchars($fila['Concepto']); ?></td>
        <td><?php echo htmlspecialchars($fila['Unidad']); ?></td>
        <td><?php echo htmlspecialchars($fila['Valor']); ?></td>
        <td><?php echo htmlspecialchars($fila['Fecha']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
