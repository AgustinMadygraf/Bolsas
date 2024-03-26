<!--Bolsas/presupuestos.php-->
<?php
require "includes/header.php";
require 'includes/conn_bolsas.php';
include 'includes/db_functions.php'; 

function obtenerDatosValorUnitario() {
    $sql = "SELECT ID, Concepto, Unidad, Valor, Fecha FROM valor_unitario ORDER BY ID ASC";
    return getArraySQL($sql);
}

function obtenerConcepto() {
    $sql = "SELECT DISTINCT Concepto FROM valor_unitario";
    return getArraySQL($sql);
}

function obtenerUnidades() {
    $sql = "SELECT DISTINCT Unidad FROM valor_unitario";
    return getArraySQL($sql);
}

$concepto = obtenerConcepto();
$unidades = obtenerUnidades();
$datosValorUnitario = obtenerDatosValorUnitario();
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
            <select name="Concepto">
                <?php foreach ($concepto as $item): ?>
                    <option value="<?php echo htmlspecialchars($item['Concepto']); ?>">
                        <?php echo htmlspecialchars($item['Concepto']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>

        <td>
            <select name="Unidad">
                <?php foreach ($unidades as $unidad): ?>
                    <option value="<?php echo htmlspecialchars($unidad['Unidad']); ?>">
                        <?php echo htmlspecialchars($unidad['Unidad']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
        <td><input type="text" name="Valor" placeholder="Valor"></td>
        <td><input type="text" name="Fecha" placeholder="Fecha"></td>
        <td><button type="submit" name="insertar">Insertar</button></td>
    </tr>
</form>


</body>
</html>
