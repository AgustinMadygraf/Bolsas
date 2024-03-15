<?php
// DataMaq/includes/Presupuestos_businessLogic.php
require_once 'datos.php'; 




function calcularCostosVariables($data1, $precio_venta, $ComVent) {
    $totalCostoMarginal = 0;
    $costoVariables = [];

    foreach ($data1 as $row) {
        $costoMarginal = floatval($row['Valor unitario']) * floatval($row['KPI']);
        $totalCostoMarginal += $costoMarginal;
    }

    $CostoVenta = $precio_venta * ($ComVent / 100);
    $totalCostoVariable = $totalCostoMarginal + $CostoVenta;
    $MgCont = $precio_venta - $totalCostoVariable;

    $costoVariables['Papel'] = floatval($data1[0]['Valor unitario']) * floatval($data1[0]['KPI']);
    $costoVariables['ManoObra'] = floatval($data1[1]['Valor unitario']) * floatval($data1[1]['KPI']);
    $costoVariables['Energia'] = floatval($data1[2]['Valor unitario']) * floatval($data1[2]['KPI']);
    $costoVariables['Gluer'] = floatval($data1[3]['Valor unitario']) * floatval($data1[3]['KPI']);
    $costoVariables['MargenContribucion'] = $MgCont;

    return $costoVariables;
}

function calcularCostosFijos($data2, $data3, $data4) {
    $costosFijos = [
        'Electrico' => 0,
        'Superficie' => 0,
        'ManoObra' => 0,
    ];

    // Calcular costo eléctrico fijo
    foreach ($data2 as $row) {
        $potenciaEnKw = floatval($row['Potencia']) / 1000; // Conversión de W a kW
        $consumoEnergiaMensualKwh = $potenciaEnKw * floatval($row['Horas por día']) * floatval($row['Días por mes']);
        $costosFijos['Electrico'] += $consumoEnergiaMensualKwh * floatval($row['Valor unitario']);
    }

    // Calcular costo de superficie fijo
    foreach ($data3 as $row) {
        $costosFijos['Superficie'] += floatval($row['Valor unitario']) * floatval($row['Superficie']);
    }

    // Calcular costo de mano de obra fijo
    foreach ($data4 as $row) {
        $costosFijos['ManoObra'] += floatval($row['Valor unitario']) * floatval($row['Horas']);
    }

    return $costosFijos;
}

