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

<?php includeHeader($formato, $ComVent); ?>

<form action="presupuesto.php" method="GET">
    <label for="vel1"> Velocidad de la máquina:</label>
    <select name="vel">
        <?php
        foreach ($velocidades as $velocidad) {
            echo '<option value="' . $velocidad . '"' . ($vel == $velocidad ? ' selected' : '') . '>' . $velocidad . '</option>';
        }
        ?>
    </select>
    <label for="vel2"> [bolsas por minuto]:</label>
    
    <input type="hidden" name="peso" value="<?php echo htmlspecialchars($peso * 1000); ?>">
    <input type="hidden" name="precio_venta" value="<?php echo htmlspecialchars($precio_venta); ?>">
    <input type="hidden" name="formato" value="<?php echo htmlspecialchars($formato); ?>">
    <label for="Trabajadores"><br>Trabajadores: </label>
    <select name="Trabajadores">
        <?php
        foreach ($opcionesTrabajadores as $opcion) {
            echo '<option value="' . $opcion . '"' . ($Trabajadores == $opcion ? ' selected' : '') . '>' . $opcion . '</option>';
        }
        ?>
    </select>
    <br>
    <label for="Costo de venta">Costo de venta:</label>
    <select name="ComVent">
    <?php
    foreach ($opcionesComVent as $opcion) {
        echo '<option value="' . $opcion . '"' . ($ComVent == $opcion ? ' selected' : '') . '>' . $opcion . '%</option>';
    }
    ?>
    </select>

    <br><br>
    <input type="submit" value="Actualizar">
</form>
<h2>Costos Variables</h2>
<?php
    
    includeCostosVariables($data1, $precio_venta, $ComVent);
    includeCostosFijos($data2, $data3, $data4, $vel, $precio_venta, $ComVent);


?>
</body>
</html>
