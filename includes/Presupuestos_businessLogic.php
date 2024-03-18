<!--// DataMaq/includes/Presupuestos_businessLogic.php-->

<?php

function sanitizeAndValidateFloat($value, $default = 0, $scale = 2) {
    $filteredValue = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if (is_numeric($filteredValue)) {
        return round((float)$filteredValue, $scale);
    }
    return $default;
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


?>