<!--DataMaq/presupuestos.php-->
<?php
require "includes/header.php";
require 'includes/conn_bolsas.php';
include 'includes/db_functions.php'; 

function obtenerDatosValorUnitario() {
    $sql = "SELECT ID, Concepto, Unidad, Valor, Fecha FROM valor_unitario ORDER BY ID ASC";
    return getArraySQL($sql);
}

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

<form action="includes/procesar_proveedores.php" method="POST">
    <tr>
        <td>
            <select name="Concepto">
                <option value="Papel">Papel</option>
                <option value="opcion2">Opción 2</option>
                <option value="opcion3">Opción 3</option>
            </select>
        </td>
        <td><input type="text" name="Unidad" placeholder="Unidad"></td>
        <td><input type="text" name="Valor" placeholder="Valor"></td>
        <td><input type="text" name="Fecha" placeholder="Fecha"></td>
        <td><button type="submit" name="insertar">Insertar</button></td>
    </tr>
</form>


</body>
</html>
