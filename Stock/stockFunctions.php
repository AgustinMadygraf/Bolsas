<?php
// En stockFunctions.php

require_once 'conn.php';

function obtenerDatosStock($formatoFilter, $colorFilter, $gramajeFilter) {
    global $conn; // Asegúrate de que $conn esté accesible

    // Inicializar arreglo para condiciones y parámetros de la consulta
    $conditions = [];
    $params = [];
    $param_types = ""; // Cadena para almacenar los tipos de parámetros

    // Agregar condiciones según los filtros seleccionados
    if ($formatoFilter !== 'todos') {
        $conditions[] = "formato = ?";
        $params[] = $formatoFilter;
        $param_types .= "s"; // s = string
    }
    if ($colorFilter !== 'todos') {
        $conditions[] = "color = ?";
        $params[] = $colorFilter;
        $param_types .= "s";
    }
    if ($gramajeFilter !== 'todos') {
        $conditions[] = "gramaje = ?";
        $params[] = $gramajeFilter;
        $param_types .= "s";
    }

    // Construir la consulta base con ordenación y JOIN para unir las tablas
    $query = "SELECT t1.*, t2.precio_u_sIVA FROM tabla_1 t1 
              LEFT JOIN listado_precios t2 ON t1.ID_formato = t2.ID_formato";
    

    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    $query .= " ORDER BY t1.cantidades DESC";



    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Vincular parámetros si es necesario
    if (!empty($params)) {
        $stmt->bind_param($param_types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

    return $data;
}
?>