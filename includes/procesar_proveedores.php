<!--Bolsas/includes/procesar_proveedores.php-->
<?php
require "Bolsas/includes/db_functions.php";
function insertarProveedor($conexion, $id, $concepto, $unidad, $valor, $fecha) {
    $sql = "INSERT INTO valor_unitario (ID, Concepto, Unidad, Valor, Fecha) VALUES (?, ?, ?, ?, ?)";
    return getArraySQL($sql);
}
//http://localhost/Bolsas/includes/procesar_proveedores.php?Concepto=Mano+de+Obra&Unidad=%24%2Fh&Valor=2200&Fecha=2024-03-26&insertar=


if (isset($_GET['insertar'])) {
    $id = $_GET['ID'];
    $concepto = $_GET['Concepto'];
    $unidad = $_GET['Unidad'];
    $valor = $_GET['Valor'];
    $fecha = $_GET['Fecha'];
    insertarProveedor($conexion, $id, $concepto, $unidad, $valor, $fecha);
    header("Location: ../proveedores.php");
}

?>

<script>setTimeout(function(){ window.location.href = "../proveedores.php"; }, 2000);</script>