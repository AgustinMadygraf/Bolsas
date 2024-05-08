<!--Bolsas/app/controllers/PresupuestoController.php-->
<?php

$velocidades = [40, 60, 80, 100];
$opcionesTrabajadores = [4, 8, 10, 12, 16, 22];
$opcionesComVent = [0, 5, 10, 15, 20];

function sanitizeAndValidateFloat($value, $default = 0, $scale = 2) {
    $filteredValue = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if (is_numeric($filteredValue)) {
        return round((float)$filteredValue, $scale);
    }
    return $default;
}

function getPresupuestoData(&$peso, &$precio_venta, &$formato, &$vel, &$Trabajadores, &$ComVent) {
    $peso = sanitizeAndValidateFloat($_GET['peso'] ?? 0.042, 0.042, 3) / 1000;
    $precio_venta = sanitizeAndValidateFloat($_GET['precio_venta'] ?? 0, 0, 2);
    $formato = filter_var($_GET['formato'] ?? '', FILTER_SANITIZE_STRING);
    $vel = filter_var($_GET['vel'] ?? 40, FILTER_SANITIZE_NUMBER_INT);
    $Trabajadores = filter_var($_GET['Trabajadores'] ?? 4, FILTER_SANITIZE_NUMBER_INT);
    $ComVent = filter_var($_GET['ComVent'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
}

function calcularCostosFijos($data2, $data3, $data4) {
    $costoElectrico = 0;
    $costoSuperficie = 0;
    $costoManoObra = 0;

    // Calcula el costo eléctrico
    foreach ($data2 as $item) {
        $potenciaEnKw = $item['Potencia'] / 1000; // Convierte W a kW
        $horasMes = $item['Horas por día'] * $item['Días por mes'];
        $costoElectrico += $potenciaEnKw * $horasMes * $item['Valor unitario'];
    }

    // Calcula el costo de superficie
    foreach ($data3 as $item) {
        $costoSuperficie += $item['Superficie'] * $item['Valor unitario'];
    }

    // Calcula el costo de mano de obra
    foreach ($data4 as $item) {
        $costoManoObra += $item['Horas'] * $item['Valor unitario'];
    }

    $costoTotalFijo = $costoElectrico + $costoSuperficie + $costoManoObra;
    return array($costoElectrico, $costoSuperficie, $costoManoObra, $costoTotalFijo);
}

function calcularCostosVariables($data1, $precio_venta, $ComVent) {
    $CostoVariablePapel = floatval($data1[0]['Valor unitario']) * floatval($data1[0]['KPI']);
    $CostoVariableManoObra = floatval($data1[1]['Valor unitario']) * floatval($data1[1]['KPI']);
    $CostoVariableEnergia = 10 * floatval($data1[2]['Valor unitario']) * floatval($data1[2]['KPI']); 
    $CostoVariableGluer = floatval($data1[3]['Valor unitario']) * floatval($data1[3]['KPI']);
    $CostoVenta = $precio_venta * ($ComVent / 100);
    
    $KPI_papel_2 = 1 + 0.19047619047619;


    $totalCostoVariable = $CostoVariablePapel * $KPI_papel_2 + $CostoVariableManoObra + $CostoVariableEnergia + $CostoVariableGluer + $CostoVenta;
    $MgCont = $precio_venta - $totalCostoVariable;
    
    return array($CostoVariablePapel, $CostoVariableEnergia, $CostoVariableManoObra, $CostoVariableGluer, $MgCont, $CostoVenta);
}

function mostrarCalculosPresupuesto($totalCostoVariable, $horas_cerrar_venta, $val_unit_mano_obra, $precio_venta, $MgCont, $vel) {
    $CostoFijoVenta = $horas_cerrar_venta * $val_unit_mano_obra;
    echo "<table>"; 
    echo "<tr><th>Descripción</th><th>Total</th><th>Unitario</th></tr>";
    echo "<tr><td>Ingrese la cantidad de bolsas a presupuestar:</td><td colspan='2'><input type='number' id='cantidadBolsas' value='0'></td></tr>";
    echo "<tr><td>Costo Variable</td><td>$<span id='Costo_variable_total_JS'>0.00</span></td><td>$" . number_format($totalCostoVariable, 2, '.', ',') . "</td></tr>";
    echo "<tr><td>Horas para cerrar una venta y despachar pedido</td><td colspan='2'>" . number_format($horas_cerrar_venta, 2, '.', ',') . "</td></tr>";
    echo "<tr><td>Costo de ejecutar Venta</td><td colspan='2'>$" . number_format($CostoFijoVenta, 2, '.', ',') . "</td></tr>";
    echo "<tr><td>Costo </td><td>$<span id='Costo_Total_JS'>0.00</span></td><td>$<span id='Costo_unit_JS'>0.00</span></td></tr>";
    echo "<tr><td>Precio</td><td>$<span id='Precio_Total_JS'>0.00</span></td><td>$<span id='Precio_Unitario_JS'>0.00</span></td></tr>";
    echo "<tr><td>Margen de contribución</td><td>$<span id='Margen_Contribucion_total_JS'>0.00</span></td><td>$<span id='Margen_Contribucion_unit_JS'>0.00</span></td></tr>";
    echo "</table>";


    echo "<script>
        document.getElementById('cantidadBolsas').addEventListener('input', function() {
            var cantidadBolsas = parseFloat(document.getElementById('cantidadBolsas').value) || 0;
            var costoTotal = cantidadBolsas * $totalCostoVariable;
            costoTotal += $CostoFijoVenta;
            var costoUnitario = costoTotal / cantidadBolsas;
            document.getElementById('Costo_unit_JS').innerText = costoUnitario.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            var precioTotal = cantidadBolsas * $precio_venta;
            if (precioTotal < costoTotal) {
                precioTotal = costoTotal;
            }
            var precioUnitario = precioTotal / cantidadBolsas;
            document.getElementById('Precio_Unitario_JS').innerText = precioUnitario.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            
            document.getElementById('Costo_Total_JS').innerText = costoTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            
            var margenContribucion = precioTotal - costoTotal;
            document.getElementById('Margen_Contribucion_total_JS').innerText = margenContribucion.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            
            var margenContribucionUnitario = precioUnitario - costoUnitario;
            document.getElementById('Margen_Contribucion_unit_JS').innerText = margenContribucionUnitario.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        });
        document.getElementById('cantidadBolsas').addEventListener('input', function() {
            var cantidadBolsas = parseFloat(document.getElementById('cantidadBolsas').value);
            var costoTotal = cantidadBolsas * $totalCostoVariable;
            document.getElementById('Costo_variable_total_JS').innerText = costoTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            
            var precioTotal = cantidadBolsas * $precio_venta;
            var costoTotal = cantidadBolsas * $totalCostoVariable + $CostoFijoVenta;
            if (precioTotal < costoTotal) {
                precioTotal = costoTotal;
            }
            document.getElementById('Precio_Total_JS').innerText = precioTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            
            var precioUnitario = precioTotal / cantidadBolsas;
            document.getElementById('Precio_Unitario_JS').innerText = precioUnitario.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            
            var margenContribucion = precioTotal - costoTotal;
            document.getElementById('Margen_Contribucion_total_JS').innerText = margenContribucion.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            
            var costoUnitario = costoTotal / cantidadBolsas;
            var margenContribucionUnitario = precioUnitario - costoUnitario;
            document.getElementById('Margen_Contribucion_unit_JS').innerText = margenContribucionUnitario.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        });
    </script>";

}

function mostrarCostosFijosYContribucion($data2, $data3, $data4, $MgCont, $vel) {
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
    echo "<p>(estimado) <strong>Costo Fijo Total: $" . number_format($costoTotalFijo, 2) . "</strong></p>";

    //cantidad de producción para alcanzar el punto de equilibrio
    echo "<h3>(estimado) Cantidad de producción para alcanzar el punto de equilibrio: ";
    $cantidadProduccion = $costoTotalFijo / $MgCont;
    echo number_format($cantidadProduccion, 0, '.', ',')." bolsas</h3>";

    //visualizar $$MgCont
    echo "<h3> (estimado) Margen de Contribución por unidad: $" . number_format($MgCont, 2, '.', ',') . "</h3>";


    // Margen de contribución y cálculo de horas/turnos necesarios para cubrir costos fijos
    echo "<h3>(estimado) Margen de contribución por hora: $";
    echo number_format($MgCont * ($vel * 60), 2, '.', ',');
    echo "</h3>";
    echo "(estimado) Cantidad de horas para cubrir los costos fijos: ";
    $horasParaCubrirCostosFijos = $costoTotalFijo / ($MgCont * ($vel * 60));
    echo number_format($horasParaCubrirCostosFijos, 2, '.', ',')." horas";
}
?>