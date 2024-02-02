<?php
    require "includes/header.php";
    include 'includes/db_funtions.php'; 
    
    // Obtener fechas únicas de listado_precios
    $sqlFechas = "SELECT DISTINCT fecha FROM listado_precios ORDER BY fecha DESC";
    
    $fechas = getArraySQL($sqlFechas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Costos Operativos</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Listado de precios</h1>

<form action="lista_precios.php" method="GET">
    <select name="fechaSeleccionada">
        <?php
        foreach ($fechas as $fecha) {
            echo '<option value="'.$fecha['fecha'].'">'.$fecha['fecha'].'</option>';
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
            WHERE lp.fecha = '$fechaSeleccionada'
            ORDER BY color DESC";
    $resultados = getArraySQL($sql);
    ?>
    <table border="1" class="responsive-table">
        <tr>
            <th>Formato</th>
            <th>Color</th>
            <th>Gramaje</th>
            <th>Cantidad</th>
            <th>Precio Unitario s/IVA</th>
        </tr>
        <?php
        foreach ($resultados as $resultado) {
            echo "<tr>
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
