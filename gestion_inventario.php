<?php
require "includes/header.php";
require_once 'Stock/conn.php';

function obtenerFiltrosAplicados() {
    return [
        'formato' => isset($_GET['Formato']) ? $_GET['Formato'] : 'todos',
        'color' => isset($_GET['color']) ? $_GET['color'] : 'todos',
        'gramaje' => isset($_GET['gramaje']) ? $_GET['gramaje'] : 'todos',
    ];
}

function construirConsulta($filtros) {
    $conditions = [];
    $params = [];

    if ($filtros['formato'] !== 'todos') {
        $conditions[] = "formato = ?";
        $params[] = $filtros['formato'];
    }
    // Repetir para otros filtros...

    $query = "SELECT t1.*, t2.precio_u_sIVA FROM tabla_1 t1
              LEFT JOIN listado_precios t2 ON t1.ID_formato = t2.ID_formato
              WHERE 1=1";

    foreach ($conditions as $condition) {
        $query .= " AND $condition";
    }

    $query .= " ORDER BY t1.cantidades DESC";

    return [$query, $params];
}

function ejecutarConsulta($query, $params) {
    global $conn; // Asegúrate de tener acceso a la variable $conn
    $stmt = $conn->prepare($query);
    // Vincular parámetros...
    $stmt->execute();
    return $stmt->get_result();
}

function renderizarFiltros() {
    $formatoFilter = isset($_GET['Formato']) ? $_GET['Formato'] : 'todos';
    $colorFilter = isset($_GET['color']) ? $_GET['color'] : 'todos';
    $gramajeFilter = isset($_GET['gramaje']) ? $_GET['gramaje'] : 'todos';

    echo '<form action="gestion_inventario.php" method="GET" id="filtroForm">';
    echo '<table>';
    echo '<tr><th>Formato</th><th>Color</th><th>Gramaje</th></tr>';
    echo '<tr>';

    
    echo '<th><select name="Formato" onchange="submitForm()">';
    // Aquí deberías insertar las opciones de formato de la base de datos o definirlas estáticamente
    echo '<option value="todos"'.($formatoFilter === 'todos' ? ' selected' : '').'>Todos</option>';
    // Repetir para cada valor único de formato en tu base de datos
    echo '</select></th>';


    echo '<th><select name="color" onchange="submitForm()">';
    // Aquí deberías insertar las opciones de color
    echo '<option value="todos"'.($colorFilter === 'todos' ? ' selected' : '').'>Todos</option>';
    // Repetir para cada color
    echo '</select></th>';
    echo '<th><select name="gramaje" onchange="submitForm()">';
    // Aquí deberías insertar las opciones de gramaje
    echo '<option value="todos"'.($gramajeFilter === 'todos' ? ' selected' : '').'>Todos</option>';
    // Repetir para cada gramaje
    echo '</select></th>';
    echo '</tr>';
    echo '</table>';
    echo '<input type="submit" value="Filtrar" />';
    echo '</form>';
}


function renderizarTabla($result) {
    echo '<table border="1">';
    echo '<tr><th>ID_formato</th><th>Formato</th><th>Color</th><th>Gramaje</th><th>Cantidades</th><th>Fecha</th><th>Valor unitario</th><th>Valor total</th></tr>';
    $totalSuma = 0;
    while ($row = $result->fetch_assoc()) {
        $valorTotal = isset($row['precio_u_sIVA']) ? $row['cantidades'] * $row['precio_u_sIVA'] : 'No disponible';
        echo '<tr>';
        echo '<td>'.htmlspecialchars($row['ID_formato']).'</td>';
        echo '<td>'.htmlspecialchars($row['formato']).'</td>';
        echo '<td>'.htmlspecialchars($row['color']).'</td>';
        echo '<td>'.htmlspecialchars($row['gramaje']).'</td>';
        echo '<td>'.htmlspecialchars($row['cantidades']).'</td>';
        echo '<td>'.htmlspecialchars($row['fechatiempo']).'</td>';
        echo '<td>'.htmlspecialchars($row['precio_u_sIVA']).'</td>';
        echo '<td>'.(is_numeric($valorTotal) ? number_format($valorTotal, 2, '.', ',') : $valorTotal).'</td>';
        echo '</tr>';
        if (is_numeric($valorTotal)) {
            $totalSuma += $valorTotal;
        }
    }
    echo '<tr><td colspan="7" style="text-align: right;">Suma Total</td><td>'.number_format($totalSuma, 2, '.', ',').'</td></tr>';
    echo '</table>';
}

// Flujo principal
$filtros = obtenerFiltrosAplicados();
list($query, $params) = construirConsulta($filtros);
$result = ejecutarConsulta($query, $params);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Stock bolsas</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<h1>Registro y control stock bolsas de papel</h1>
<?php renderizarFiltros(); ?>
<?php renderizarTabla($result); ?>
<?php mysqli_close($conn); ?>
</body>
</html>
