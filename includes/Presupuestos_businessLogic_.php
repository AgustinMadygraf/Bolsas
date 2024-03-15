<?php
// DataMaq/includes/Presupuestos_businessLogic.php
require_once 'datos.php'; 

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

