<!--Bolsas/includes/procesar_proveedores.php-->
<?php
require "conn_bolsas.php";
require "db_functions.php";

function insertarProveedor($id, $concepto, $unidad, $valor, $fecha) {
    // Preparar la sentencia SQL para evitar inyección SQL
    $sql = "INSERT INTO valor_unitario (ID, Concepto, Unidad, Valor, Fecha) VALUES (?, ?, ?, ?, ?)";
    $params = [$id, $concepto, $unidad, $valor, $fecha];
    return ejecutarInsercion($sql, $params);
}

function eliminarProveedor($id) {
    $sql = "DELETE FROM valor_unitario WHERE ID = ?";
    $params = [$id];
    return ejecutarEliminacion($sql, $params);
}

// Verificar si se está realizando una inserción
if (isset($_GET['insertar'])) {
    $concepto = $_GET['Concepto'];
    $unidad = $_GET['Unidad'];
    $valor = $_GET['Valor'];
    $fecha = $_GET['Fecha'];
    
    if (insertarProveedor(NULL, $concepto, $unidad, $valor, $fecha)) {
        header("Location: ../proveedores.php");
    } else {
        echo "Error al insertar el proveedor.";
    }
}

// Verificar si se está solicitando eliminar
if (isset($_GET['eliminar'])) {
    $id = $_GET['ID'];
    
    if (eliminarProveedor($id)) {
        header("Location: ../proveedores.php");
    } else {
        echo "Error al eliminar el proveedor.";
    }
}
?>
<script>setTimeout(function(){ window.location.href = "../proveedores.php"; }, 2000);</script>
