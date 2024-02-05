<?php
require "includes/header.php";
require 'includes/db_functions.php'; // Asegúrate de que el nombre del archivo sea correcto y coincida con el nombre real.

// Obtener fechas únicas de listado_precios
$sqlFechas = "SELECT DISTINCT fecha_listado FROM listado_precios ORDER BY fecha_listado DESC";

$fechas = getArraySQL($sqlFechas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Precios</title> <!-- Cambié el título para reflejar el contenido de la página -->
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Listado de precios</h1>

<form action="lista_precios.php" method="GET">
    <select name="fechaSeleccionada">
        <?php
        foreach ($fechas as $fecha) {
            echo '<option value="'.$fecha['fecha_listado'].'">'.$fecha['fecha_listado'].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Filtrar">
</form>

<?php
if (isset($_GET['fechaSeleccionada'])) {
    $fechaSeleccionada = $_GET['fechaSeleccionada'];
    $sql = "SELECT t1.formato, t1.color, t1.gramaje, lp.cantidad, lp.precio_u_sIVA 
            FROM listado_precios lp 
            INNER JOIN tabla_1 t1 ON lp.ID_formato = t1.ID_formato 
            WHERE lp.fecha_listado = '$fechaSeleccionada'
            ORDER BY color DESC";
    $resultados = getArraySQL($sql);
    ?>
    <table border="1" class="responsive-table">
        <tr>
            <th>ID_formato</th>
            <th>Formato</th>
            <th>Color</th>
            <th>Gramaje</th>
            <th>Cantidad</th>
            <th>Precio Unitario s/IVA</th>
        </tr>
        <?php
        foreach ($resultados as $resultado) {
            echo "<tr>
                    <td>{$resultado['ID_formato']}</td>            
                    <td>{$resultado['formato']}</td>
                    <td>{$resultado['color']}</td>
                    <td>{$resultado['gramaje']}</td>
                    <td>{$resultado['cantidad']}</td>
                    <td>{$resultado['precio_u_sIVA']}</td>
                  </tr>";
        }
        ?>
    </table>
    <?php
}
?>
</body>
</html>
