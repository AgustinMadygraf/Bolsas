<?php
    require "includes/header.php";
    require_once 'Stock/conn.php';
    require_once 'Stock/stockFunctions.php';
        include 'includes/db_functions.php'; 
    
    // Obtener fechas únicas de listado_precios
    $sqlFechas = "SELECT DISTINCT fecha FROM listado_precios ORDER BY fecha DESC";
    
    $fechas = getArraySQL($sqlFechas);

    // Obtener los valores de los filtros desde la URL
    $formatoFilter = isset($_GET['Formato']) ? $_GET['Formato'] : 'todos';
    $colorFilter = isset($_GET['color']) ? $_GET['color'] : 'todos';
    $gramajeFilter = isset($_GET['gramaje']) ? $_GET['gramaje'] : 'todos';

    // Llamar a la función para obtener los datos de stock con los filtros aplicados
    $data = obtenerDatosStock($formatoFilter, $colorFilter, $gramajeFilter);

    // Función para crear enlaces a la página de búsqueda con filtros aplicados
    function crearEnlace($id_formato, $texto) {
        return '<a href="Stock/busqueda.php?ID_formato=' . $id_formato . '">' . htmlspecialchars($texto) . '</a>';
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
                <th>Valor Total</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $totalSuma = 0;
            foreach ($data as $row) {
                $valorTotal = isset($row['precio_u_sIVA']) ? $row['cantidades'] * $row['precio_u_sIVA'] : 'No disponible';
                $valorTotalFormatted = is_numeric($valorTotal) ? number_format($valorTotal, 2, '.', ',') : $valorTotal;

                echo "<tr>";
                echo "<td>" . crearEnlace($row['ID_formato'], $row['ID_formato']) . "</td>";
                echo "<td>" . crearEnlace($row['ID_formato'], $row['formato'])       . "</td>";
                echo "<td>" . crearEnlace($row['ID_formato'], $row['color'])         . "</td>";
                echo "<td>" . crearEnlace($row['ID_formato'], $row['gramaje']." gr") . "</td>";
                echo "<td>" . crearEnlace($row['ID_formato'], $row['cantidades'])    . "</td>";
                echo "<td>" . crearEnlace($row['ID_formato'], $row['fechatiempo'])   . "</td>"; 
                echo "<td>" . (isset($row['precio_u_sIVA']) ? $row['precio_u_sIVA'] : 'No disponible') . "</td>";
                echo "<td>" . $row['fecha']         . "</td>";
                echo "<td>" . $valorTotalFormatted . "</td>";
                echo "</tr>";

                if (is_numeric($valorTotal)) {
                    $totalSuma += $valorTotal;
                }
            }
            ?>
            <tr>
                <td colspan="8" style="text-align: right;"><strong>Suma Total</strong></td>
                <td><?php echo number_format($totalSuma, 2, '.', ','); ?></td>
            </tr>
        </tbody>
    </table>

    <script>
        function submitForm() {
            document.getElementById("filtroForm").submit();
        }
    </script>
</body>
</html>
