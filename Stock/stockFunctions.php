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
function obtenerDatosStock($formatoFilter, $colorFilter, $gramajeFilter, $cantidadSeleccionada) {
    $conexion = conectarBD(); // Asumiendo que conectarBD() devuelve una conexión mysqli válida

    $query = "SELECT t1.*, t2.precio_u_sIVA, t2.fecha_listado, t2.cantidad FROM tabla_1 t1
              LEFT JOIN listado_precios t2 ON t1.ID_formato = t2.ID_formato";

    // Arrays para condiciones SQL y sus parámetros.
    $conditions = [];
    $params = [];

    // Agrega condiciones basadas en los filtros.
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

    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    $query .= " ORDER BY t1.cantidades DESC";

    // Preparar consulta
    $stmt = $conexion->prepare($query);

    // Verificar si la preparación fue exitosa
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    // Vincular parámetros a la consulta si es necesario
    if (!empty($params)) {
        $stmt->bind_param(str_repeat("s", count($params)), ...$params);
    }

    // Ejecutar la consulta
    $stmt->execute();

    $result = $stmt->get_result();
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Cierra el statement y la conexión
    $stmt->close();
    desconectarBD($conexion);

    return $data;
}
