<!--Bolsas/includes/procesar_proveedores.php-->
<?php
require "Bolsas/includes/conn_bolsas.php";
require "Bolsas/includes/db_functions.php";

function insertarProveedor($conexion, $id, $concepto, $unidad, $valor, $fecha) {
    // Preparar la sentencia SQL para evitar inyección SQL
    $sql = "INSERT INTO valor_unitario (ID, Concepto, Unidad, Valor, Fecha) VALUES (?, ?, ?, ?, ?)";
    
    // Preparar la sentencia
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        // Vincular parámetros a la sentencia preparada como strings
        mysqli_stmt_bind_param($stmt, "isssd", $param_id, $param_concepto, $param_unidad, $param_valor, $param_fecha);
        
        // Establecer parámetros y ejecutar
        $param_id = $id;
        $param_concepto = $concepto;
        $param_unidad = $unidad;
        $param_valor = $valor;
        $param_fecha = $fecha;
        
        if (mysqli_stmt_execute($stmt)) {
            // La inserción fue exitosa
            return true;
        } else {
            // Error en la ejecución
            return false;
        }
        
        // Cerrar la sentencia
        mysqli_stmt_close($stmt);
    }
    return false;
}

// ejemplo 
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