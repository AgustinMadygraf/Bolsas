<?php
// DataMaq/includes/Presupuestos_businessLogic.php






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

