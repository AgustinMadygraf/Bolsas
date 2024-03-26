<!--Bolsas/presupuestos.php-->
<?php
require "includes/header.php";
require 'includes/conn_bolsas.php';
include 'includes/db_functions.php'; 

function obtenerDatosValorUnitario() {
    $sql = "SELECT ID, Concepto, Unidad, Valor, Fecha FROM valor_unitario ORDER BY ID ASC";
    return getArraySQL($sql);
}
$datosValorUnitario = obtenerDatosValorUnitario();

function obtenerConceptoConUnidad() {
    $sql = "SELECT DISTINCT Concepto, Unidad FROM valor_unitario";
    return getArraySQL($sql);
}
$conceptoConUnidad = obtenerConceptoConUnidad();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Valores Unitarios</title>
    <!--INCORPORAR ESTILOS DE BOOTSTRAP-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
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
<br>

<form action="includes/procesar_proveedores.php" method="GET">
    <tr>
        <td>
            <select name="Concepto" id="conceptoSelect" onchange="actualizarUnidad()">
                <?php foreach ($conceptoConUnidad as $item): ?>
                    <option value="<?php echo htmlspecialchars($item['Concepto']); ?>" data-unidad="<?php echo htmlspecialchars($item['Unidad']); ?>">
                        <?php echo htmlspecialchars($item['Concepto']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
        <td>
            <input type="text" name="Unidad" id="unidadInput" placeholder="Unidad" readonly>
        </td>
        <td><input type="text" name="Valor" placeholder="Valor"></td>
        <td><input type="date" name="Fecha" placeholder="Fecha"></td> 
        <td><button type="submit" name="insertar">Insertar</button></td>
        </tr>
    </tr>
</form>

<script>
    function actualizarUnidad() {
        var conceptoSeleccionado = document.getElementById("conceptoSelect");
        var unidad = conceptoSeleccionado.options[conceptoSeleccionado.selectedIndex].getAttribute('data-unidad');
        document.getElementById("unidadInput").value = unidad;
    }
    window.onload = actualizarUnidad;
</script>

</body>
</html>
