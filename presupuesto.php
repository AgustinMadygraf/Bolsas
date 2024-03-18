<!--Bolsas/presupuestos.php-->
<?php
require "includes/header.php";
require "includes/Presupuestos_businessLogic.php";
getPresupuestoData($peso, $precio_venta, $formato, $vel, $Trabajadores, $ComVent);
require "includes/datos.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Presupuesto</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Presupuesto - Formato bolsa: <?php echo htmlspecialchars($formato); ?></h1>

<table>
    <tr>
        <td><label for="vel1">Velocidad de la máquina [bolsas por minuto]:</label></td>
        <td>
            <select name="vel">
                <?php
                foreach ($velocidades as $velocidad) {
                    echo '<option value="' . $velocidad . '"' . ($vel == $velocidad ? ' selected' : '') . '>' . $velocidad . '</option>';
                }
                ?>
            </select>
        </td>
        <label for="vel2"></label></td>
        <input type="hidden" name="peso" value="<?php echo htmlspecialchars($peso * 1000); ?>">
        <input type="hidden" name="precio_venta" value="<?php echo htmlspecialchars($precio_venta); ?>">
        <input type="hidden" name="formato" value="<?php echo htmlspecialchars($formato); ?>">
    </tr>
    <tr>
        <td><label for="Trabajadores">Trabajadores:</label></td>
        <td>
            <select name="Trabajadores">
                <?php
                foreach ($opcionesTrabajadores as $opcion) {
                    echo '<option value="' . $opcion . '"' . ($Trabajadores == $opcion ? ' selected' : '') . '>' . $opcion . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td><label for="Costo de venta">Costo de venta:</label></td>
        <td>
            <select name="ComVent">
                <?php
                foreach ($opcionesComVent as $opcion) {
                    echo '<option value="' . $opcion . '"' . ($ComVent == $opcion ? ' selected' : '') . '>' . $opcion . '%</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" value="Actualizar"></td>
    </tr>
</table>

<h2>Costos Variables</h2>
<?php
    includeCostosVariables($data1, $precio_venta, $ComVent);
    includeCostosFijos($data2, $data3, $data4, $vel, $precio_venta, $ComVent);
?>
</body>
</html>
