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

function getPresupuestoData(&$peso, &$precio_venta, &$formato, &$vel, &$Trabajadores, &$ComVent) {
    $peso = sanitizeAndValidateFloat($_GET['peso'] ?? 0.042, 0.042, 3) / 1000;
    $precio_venta = sanitizeAndValidateFloat($_GET['precio_venta'] ?? 0, 0, 2);
    $formato = filter_var($_GET['formato'] ?? '', FILTER_SANITIZE_STRING);
    $vel = filter_var($_GET['vel'] ?? 40, FILTER_SANITIZE_NUMBER_INT);
    $Trabajadores = filter_var($_GET['Trabajadores'] ?? 4, FILTER_SANITIZE_NUMBER_INT);
    $ComVent = filter_var($_GET['ComVent'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
}

?>