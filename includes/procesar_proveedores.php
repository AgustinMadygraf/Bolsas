<!--Bolsas/includes/procesar_proveedores.php-->
<?php
function insertarProveedor($conexion, $id, $concepto, $unidad, $valor, $fecha) {
    $sql = "INSERT INTO valor_unitario (ID, Concepto, Unidad, Valor, Fecha) VALUES (?, ?, ?, ?, ?)";
    return getArraySQL($sql);
}
?>