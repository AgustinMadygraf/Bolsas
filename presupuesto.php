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
<?php echo "<br>Costo de Ventas: " . htmlspecialchars($ComVent) . "%<br> ";?>
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
    list($CostoVariablePapel, $CostoVariableEnergia,$CostoVariableManoObra,$CostoVariableGluer,$MgCont,$CostoVenta) = DatosCostosVariables($data1,$precio_venta,$ComVent);
    VerTablaCostosVariables($data1,$precio_venta,$ComVent);
    $datosJson = json_encode([
        ["Concepto", "Costo ($)"],
        ["Papel", $CostoVariablePapel],
        ["Energía", $CostoVariableEnergia],
        ["Pegamento", $CostoVariableGluer],
        ["Mano de obra", $CostoVariableManoObra], 
        ["Costo de Ventas", $CostoVenta],
        ["Margen de contribución", $MgCont]
    ]);    
    echo "<h3>Margen de contribución por hora: $";
    echo number_format($MgCont*($vel*60), 2, '.', ',');
    echo "</h3>";
    include 'includes/chart.php';   
    echo "<h2>Costos fijo </h2>";
    echo "<h3>Costo fijo - Electrico</h3>";
    visualizarTabla2($data2);
    echo "<h3> Costo Fijo - Superficie</h3>";
    visualizarTabla3($data3);
    echo "<h3> Costo Fijo - Mano de obra</h3>";
    visualizarTabla4($data4);
    list($costoElectrico, $costoSuperficie, $costoManoObra, $costoTotalFijo) = calcularCostosFijos($data2, $data3, $data4);
    echo "<h2>Costos Fijos Totales</h2>";
    echo "<p>Total Costo Eléctrico: $" . number_format($costoElectrico, 2) . "</p>";
    echo "<p>Total Costo de Superficie: $" . number_format($costoSuperficie, 2) . "</p>";
    echo "<p>Total Costo de Mano de Obra: $" . number_format($costoManoObra, 2) . "</p>";
    echo "<p><strong>Costo Fijo Total: $" . number_format($costoTotalFijo, 2) . "</strong></p>";
    echo "<h3>Margen de contribución por hora: $" . number_format(calcularMargenContribucionPorHora($MgCont, $vel), 2, '.', ',') . "</h3>";
    echo "<h3>Cantidad de horas para cubrir los costos fijos: " . number_format(calcularHorasParaCubrirCostosFijos($costoTotalFijo, $MgCont, $vel), 2, '.', ',') . " horas</h3>";
    echo "<h3>Cantidad de turnos para cubrir los costos fijos: " . number_format(calcularTurnosParaCubrirCostosFijos($costoTotalFijo, $MgCont, $vel), 2, '.', ',') . " turnos de 8 horas</h3>";

?>
</body>
</html>
