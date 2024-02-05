<?php
require_once 'conn.php';

/**
 * Obtiene datos de stock filtrados por formato, color, gramaje, y cantidad seleccionada.
 *
 * @param string $formatoFilter Filtro para el formato, 'todos' para no aplicar filtro.
 * @param string $colorFilter Filtro para el color, 'todos' para no aplicar filtro.
 * @param string $gramajeFilter Filtro para el gramaje, 'todos' para no aplicar filtro.
 * @param string $cantidadSeleccionada Filtro para la cantidad seleccionada, 'todos' para no aplicar filtro.
 * @return array Resultados de la consulta como un array asociativo.
 */
function obtenerDatosStock($formatoFilter, $colorFilter, $gramajeFilter, $cantidadSeleccionada, $fechaListadoFilter) {
    $conexion = conectarBD(); // Asume conectarBD() devuelve una conexión mysqli válida

    // Inicia el query base
    $query = "SELECT t1.*, t2.precio_u_sIVA, t2.fecha_listado, t2.cantidad FROM tabla_1 t1
              LEFT JOIN listado_precios t2 ON t1.ID_formato = t2.ID_formato";

    // Arrays para condiciones SQL y sus parámetros
    $conditions = [];
    $params = [];

    // Agrega condiciones basadas en los filtros
    if ($formatoFilter !== 'todos') {
        $conditions[] = "t1.formato = ?";
        $params[] = $formatoFilter;
    }
    if ($colorFilter !== 'todos') {
        $conditions[] = "t1.color = ?";
        $params[] = $colorFilter;
    }
    if ($gramajeFilter !== 'todos') {
        $conditions[] = "t1.gramaje = ?";
        $params[] = $gramajeFilter;
    }
    if (!empty($cantidadSeleccionada) && $cantidadSeleccionada != 'todos') {
        $conditions[] = "t2.cantidad = ?";
        $params[] = $cantidadSeleccionada;
    }
    if ($fechaListadoFilter !== 'todos') { // Nueva condición para filtrar por fecha de listado
        $conditions[] = "t2.fecha_listado = ?";
        $params[] = $fechaListadoFilter;
    }

    // Combina las condiciones en el query si existen
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    // Ordena los resultados
    $query .= " ORDER BY t1.cantidades DESC";

    // Prepara y ejecuta la consulta
    $stmt = $conexion->prepare($query);
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    if (!empty($params)) {
        $stmt->bind_param(str_repeat("s", count($params)), ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    desconectarBD($conexion);

    return $data;
}
