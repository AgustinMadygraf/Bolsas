<?php
// Stock/stockFunctions.php
require_once 'conn.php';

/**
 * Obtiene datos de stock filtrados por formato, color y gramaje.
 *
 * @param string $formatoFilter Filtro para el formato, 'todos' para no aplicar filtro.
 * @param string $colorFilter Filtro para el color, 'todos' para no aplicar filtro.
 * @param string $gramajeFilter Filtro para el gramaje, 'todos' para no aplicar filtro.
 * @return array Resultados de la consulta como un array asociativo.
 */
function obtenerDatosStock($formatoFilter, $colorFilter, $gramajeFilter) {
    global $conn; // Utiliza la conexión global a la base de datos.

    // Prepara la base de la consulta SQL.
    $query = "SELECT t1.*, t2.precio_u_sIVA, t2.fecha FROM tabla_1 t1
              LEFT JOIN listado_precios t2 ON t1.ID_formato = t2.ID_formato";
    
    // Arrays para condiciones SQL y sus parámetros.
    $conditions = [];
    $params = [];
    $param_types = "";

    // Agrega condiciones basadas en los filtros.
    if ($formatoFilter !== 'todos') {
        $conditions[] = "t1.formato = ?";
        $params[] = $formatoFilter;
        $param_types .= "s"; // 's' indica que el parámetro es una cadena (string).
    }
    if ($colorFilter !== 'todos') {
        $conditions[] = "t1.color = ?";
        $params[] = $colorFilter;
        $param_types .= "s";
    }
    if ($gramajeFilter !== 'todos') {
        $conditions[] = "t1.gramaje = ?";
        $params[] = $gramajeFilter;
        $param_types .= "s";
    }

    // Combina las condiciones en la consulta SQL si existen.
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    $query .= " ORDER BY t1.cantidades DESC"; // Ordena los resultados.

    // Prepara la consulta SQL.
    $stmt = $conn->prepare($query);

    // Verifica si la preparación fue exitosa.
    if (!$stmt) {
        // Manejo del error de preparación.
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Vincula parámetros a la consulta si es necesario.
    if (!empty($params)) {
        $stmt->bind_param($param_types, ...$params);
    }

    // Ejecuta la consulta.
    if (!$stmt->execute()) {
        // Manejo del error de ejecución.
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $data = [];

    // Recolecta los resultados.
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Cierra el statement.
    $stmt->close();

    return $data;
}
