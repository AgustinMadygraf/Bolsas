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

// Ejemplo 
// http://localhost/Bolsas/includes/procesar_proveedores.php?Concepto=Mano+de+Obra&Unidad=%24%2Fh&Valor=2200&Fecha=2024-03-26&insertar=

if (isset($_GET['insertar'])) {
    // Aquí suponemos que ID no es necesario porque es autoincremental en la base de datos.
    // Si no es el caso, deberías obtener el ID de alguna forma.
    $concepto = $_GET['Concepto'];
    $unidad = $_GET['Unidad'];
    $valor = $_GET['Valor'];
    $fecha = $_GET['Fecha'];
    
    if (insertarProveedor(NULL, $concepto, $unidad, $valor, $fecha)) {
        // Si la inserción fue exitosa, redirigir.
        header("Location: ../proveedores.php");
    } else {
        // Manejo de error, por ejemplo:
        echo "Error al insertar el proveedor.";
    }
}
?>
<script>setTimeout(function(){ window.location.href = "../proveedores.php"; }, 2000);</script>
