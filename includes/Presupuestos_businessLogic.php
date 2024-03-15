<?php
// DataMaq/includes/Presupuestos_businessLogic.php
//require_once 'datos.php'; 

function sanitizeAndValidateFloat($value, $default = 0, $scale = 2) {
    $filteredValue = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if (is_numeric($filteredValue)) {
        return round((float)$filteredValue, $scale);
    }
    return $default;
}
?>