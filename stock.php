<?php
require "includes/header.php";
require_once 'Stock/conn.php';
require_once 'Stock/stockFunctions.php';
include 'includes/db_functions.php'; 

function obtenerFiltrosDesdeURL() {
    return [
        'formatoFilter' => $_GET['Formato'] ?? 'todos',
        'colorFilter' => $_GET['color'] ?? 'todos',
        'gramajeFilter' => $_GET['gramaje'] ?? 'todos',
        'cantidadSeleccionada' => $_GET['cantidades'] ?? 'todos',
    ];
}

$fechas = getArraySQL("SELECT DISTINCT fecha FROM listado_precios ORDER BY fecha DESC");
$filtros = obtenerFiltrosDesdeURL();
$data = obtenerDatosStock($filtros['formatoFilter'], $filtros['colorFilter'], $filtros['gramajeFilter'], $filtros['cantidadSeleccionada']);

function formatearFecha($fecha, $formato = 'd/m/Y') {
    $objFecha = new DateTime($fecha);
    return $objFecha->format($formato);
}

function mostrarTabla($data) {
    $totalSuma = 0;
    $cant_total = 0;
    foreach ($data as $row) {
        // Aquí reutilizamos la lógica para formatear y mostrar los datos
        $valorTotalFormatted = 'No disponible';
        if (isset($row['precio_u_sIVA'])) {
            $valorTotal = $row['cantidades'] * $row['precio_u_sIVA'];
            $valorTotalFormatted = is_numeric($valorTotal) ? number_format($valorTotal, 2, '.', ',') : $valorTotal;
            $totalSuma += $valorTotal;
            $cant_total += $row['cantidades'];

        }
        echo "<tr>";
        // Usamos htmlspecialchars para evitar XSS
        echo "<td><a href='Stock/busqueda.php?ID_formato=" . htmlspecialchars($row['ID_formato']) . "'>" . htmlspecialchars($row['ID_formato']) . "</a></td>";
        echo "<td>" . htmlspecialchars($row['formato']) . "</td>";
        echo "<td>" . htmlspecialchars($row['color']) . "</td>";
        echo "<td>" . htmlspecialchars($row['gramaje']) . " gr</td>";
        echo "<td>" . htmlspecialchars($row['cantidades']) . "</td>";
        echo "<td>" . formatearFecha($row['fechatiempo'], 'H:i d/m/Y') . "</td>";
        echo "<td>" . htmlspecialchars($valorTotalFormatted) . "</td>";
        echo "<td>" . formatearFecha($row['fecha']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
        echo "<td>" . htmlspecialchars($valorTotalFormatted) . "</td>";
        echo "</tr>";
    }
    echo "<tr><td colspan='4' style='text-align: right;'><strong>Cantidad Total</strong></td><td>$cant_total</td>";
    echo "<td colspan='3' style='text-align: right;'><strong>Valor Total</strong></td><td>" . number_format($totalSuma, 2, '.', ',') . "</td></tr>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Stock de bolsas</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <h1>Registro y control de stock de bolsas de papel</h1>
    <?php include 'Stock/filtroForm.php'; ?>
    <table>
        <thead>
            <tr>
                <th>ID Formato</th>
                <th>Formato</th>
                <th>Color</th>
                <th>Gramaje</th>
                <th>Cantidad</th>
                <th>Fecha inventario</th>
                <th>Valor Unitario</th>
                <th>Fecha lista precio</th>
                <th>Precio cantidad</th>
                <th>Valor SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php mostrarTabla($data); ?>
        </tbody>
    </table>

    <script>
        function submitForm() {
            document.getElementById("filtroForm").submit();
        }
    </script>
</body>
</html>
