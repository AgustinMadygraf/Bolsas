<!--stock.php-->
<?php
require "includes/header.php";
require_once 'Stock/conn.php';
require_once 'Stock/stockFunctions.php';
include 'includes/db_functions.php'; 

function obtenerFiltrosDesdeURL() {
    $cantidadSeleccionadaDefault = '5000'; 
    $fechaListadoFilterDefault = '24-02-01';
    return [
        'formatoFilter'         => $_GET['Formato']     ?? 'todos',
        'colorFilter'           => $_GET['color']       ?? 'todos',
        'gramajeFilter'         => $_GET['gramaje']     ?? 'todos',
        'cantidadSeleccionada'  => !empty($_GET['cantidades'])          ? $_GET['cantidades']           : $cantidadSeleccionadaDefault,
        'fechaListadoFilter'    => !empty($_GET['fechaSeleccionada'])   ? $_GET['fechaSeleccionada']    : $fechaListadoFilterDefault,
    ];
}


$fechas = getArraySQL("SELECT DISTINCT fecha_listado FROM listado_precios ORDER BY fecha_listado DESC");
$filtros = obtenerFiltrosDesdeURL();
$data = obtenerDatosStock(
    strval($filtros['formatoFilter']), 
    strval($filtros['colorFilter']), 
    strval($filtros['gramajeFilter']), 
    strval($filtros['cantidadSeleccionada']),
    strval($filtros['fechaListadoFilter']) 
);


function formatearFecha($fecha, $formato = 'd/m/Y') {
    $objFecha = new DateTime($fecha);
    return $objFecha->format($formato);
}

function mostrarTabla($data) {
    $totalSuma = 0;
    $cant_total = 0;
    foreach ($data as $row) {
        $valorTotalFormatted = 'No disponible';
        $precioUnitarioFormatted = 'No disponible';
        if (isset($row['precio_u_sIVA'])) {
            $valorTotal = $row['cantidades'] * $row['precio_u_sIVA'];
            $valorTotalFormatted = is_numeric($valorTotal) ? number_format($valorTotal, 2, '.', ',') : $valorTotal;
            $precioUnitarioFormatted = number_format($row['precio_u_sIVA'], 2, '.', ',');
            $totalSuma += $valorTotal;
            $cant_total += isset($row['cantidades']) && is_numeric($row['cantidades']) ? $row['cantidades'] : 0;
        }
        
        $manijasTexto = isset($row['manijas']) && $row['manijas'] ? 'Sí' : 'No';

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['ID_formato']) . "</td>";
        echo "<td>" . htmlspecialchars($row['formato']) . "</td>";
        echo "<td>" . htmlspecialchars($row['color']) . "</td>";
        echo "<td>" . htmlspecialchars($row['gramaje']) . " gr</td>";
        echo "<td>" . $manijasTexto . "</td>"; 
        echo "<td>" . htmlspecialchars($row['cantidades']) . "</td>";
        echo "<td>" . formatearFecha($row['fechatiempo'], 'H:i d/m/Y') . "</td>";
        echo "<td>" . $precioUnitarioFormatted . "</td>"; 
        echo "<td>" . formatearFecha($row['fecha_listado']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
        echo "<td>" . $valorTotalFormatted . "</td>"; 
        echo "</tr>";
    }
    echo "<tr><td colspan='5' style='text-align: right;'><strong>Cantidad Total</strong></td><td>" . number_format($cant_total, 0, '.', ',') . "</td>";
    echo "<td colspan='4' style='text-align: right;'><strong>Valor Total</strong></td><td>" . number_format($totalSuma, 2, '.', ',') . "</td></tr>";
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
                <th>Manijas</th>
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


</body>
</html>
