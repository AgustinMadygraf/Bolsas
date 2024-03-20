<!--DataMaq/presupuestos.php-->
<?php
require "includes/header.php";
require "app/controllers/PresupuestoController.php";
require "app/views/presupuesto/index.php";
require "app/models/Presupuesto.php";



// Obtener los datos de entrada y procesarlos usando la función importada
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


<form action="presupuesto.php" method="GET">
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
                <label for="vel2"></label>
            </td>
        </tr>
        <tr>
            
                <input type="hidden" name="peso" value="<?php echo htmlspecialchars($peso * 1000); ?>">
                <input type="hidden" name="precio_venta" value="<?php echo htmlspecialchars($precio_venta); ?>">
                <input type="hidden" name="formato" value="<?php echo htmlspecialchars($formato); ?>">

        </tr>
        <tr>
            <td><label for="Trabajadores">Trabajadores: </label></td>
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
</form>






<?php
// Inicio de refactorización
echo "<h2>Costos Variables</h2>";

// Separando la lógica de cálculo y la presentación de la tabla de costos variables
list($CostoVariablePapel, $CostoVariableEnergia, $CostoVariableManoObra, $CostoVariableGluer, $MgCont, $CostoVenta) = calcularCostosVariables($data1, $precio_venta, $ComVent);
visualizarTablaCostosVariables($data1, $precio_venta, $ComVent);

// Preparación de datos para gráfica
$datosJson = json_encode([
    ["Concepto", "Costo ($)"],
    ["Papel", $CostoVariablePapel],
    ["Energía", $CostoVariableEnergia],
    ["Pegamento", $CostoVariableGluer],
    ["Mano de obra", $CostoVariableManoObra], 
    ["Costo de Ventas", $CostoVenta],
    ["Margen de contribución", $MgCont]
]);

// Margen de contribución por hora
echo "<h3>Margen de contribución por hora: $";
echo number_format($MgCont * ($vel * 60), 2, '.', ',');
echo "</h3>";
include 'includes/chart.php';

// Sección de costos fijos
echo "<h2>Costos fijo </h2>";
echo "<h3>Costo fijo - Electrico</h3>";
visualizarTabla2($data2);
echo "<h3>Costo Fijo - Superficie</h3>";
visualizarTabla3($data3);
echo "<h3>Costo Fijo - Mano de obra</h3>";
visualizarTabla4($data4);

// Cálculo de costos fijos totales
list($costoElectrico, $costoSuperficie, $costoManoObra, $costoTotalFijo) = calcularCostosFijos($data2, $data3, $data4);

// Presentación de costos fijos totales
echo "<h2>Costos Fijos Totales</h2>";
echo "<p>Total Costo Eléctrico: $" . number_format($costoElectrico, 2) . "</p>";
echo "<p>Total Costo de Superficie: $" . number_format($costoSuperficie, 2) . "</p>";
echo "<p>Total Costo de Mano de Obra: $" . number_format($costoManoObra, 2) . "</p>";
echo "<p><strong>Costo Fijo Total: $" . number_format($costoTotalFijo, 2) . "</strong></p>";

// Margen de contribución y cálculo de horas/turnos necesarios para cubrir costos fijos
echo "<h3>Margen de contribución por hora: $";
echo number_format($MgCont * ($vel * 60), 2, '.', ',');
echo "</h3>";
echo "Cantidad de horas para cubrir los costos fijos: ";
$horasParaCubrirCostosFijos = $costoTotalFijo / ($MgCont * ($vel * 60));
echo number_format($horasParaCubrirCostosFijos, 2, '.', ',')." horas";
echo "<br>Cantidad de turnos para cubrir los costos fijos: ";
echo number_format($costoTotalFijo / ($MgCont * ($vel * 60) * 8), 2, '.', ',')." turnos de 8 horas";
?>
</body>
</html>
