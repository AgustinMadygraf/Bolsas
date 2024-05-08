<!--Bolsas/presupuestos.php-->
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
            <td><select name="vel">
                    <?php
                    foreach ($velocidades as $velocidad) {
                        echo '<option value="' . $velocidad . '"' . ($vel == $velocidad ? ' selected' : '') . '>' . $velocidad . '</option>';
                    }
                    ?>
                </select>
                <label for="vel2"></label>
            </td>
        </tr>
            <input type="hidden" name="peso" value="<?php echo htmlspecialchars($peso * 1000); ?>">
            <input type="hidden" name="precio_venta" value="<?php echo htmlspecialchars($precio_venta); ?>"><input type="hidden" name="formato" value="<?php echo htmlspecialchars($formato); ?>">

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
        <tr style="display: none;">
            <td colspan="2"><input type="submit" value="Actualizar"></td>
        </tr>
        </tr>
    </table>
    <script>
        // Obtén todos los elementos select en el formulario
        var selects = document.querySelectorAll('select');

        // Para cada select, añade un event listener para el evento 'change'
        for (var i = 0; i < selects.length; i++) {
            selects[i].addEventListener('change', function() {
                // Cuando se cambia una opción, envía el formulario
                this.form.submit();
            });
        }
    </script>
</form>

<?php
    // Inicio de refactorización
    echo "<h2>Costos del formato de bolsas selecionado</h2>";

    // Separando la lógica de cálculo y la presentación de la tabla de costos variables
    list($CostoVariablePapel, $CostoVariableEnergia, $CostoVariableManoObra, $CostoVariableGluer, $MgCont, $CostoVenta) = calcularCostosVariables($data1, $precio_venta, $ComVent);
    $totalCostoVariable = visualizarTablaCostosVariables($data1, $precio_venta, $ComVent);
    
    $horas_cerrar_venta = 5;
    echo "<br><br><h2>Seleccione la cantidad que desea presupuestar</h2>";

    mostrarCalculosPresupuesto($totalCostoVariable, $horas_cerrar_venta, $val_unit_mano_obra,$precio_venta,$MgCont,$vel);

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
    include 'includes/chart.php';

mostrarCostosFijosYContribucion($data2, $data3, $data4, $MgCont, $vel);

?>
</body>
</html>
