<!--includes/GetData_2.php-->
<?php
require 'conn.php'; 
$conn = new mysqli($server, $usuario, $pass, 'bolsas'); 

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM ventas");
$stmt->execute();
$result = $stmt->get_result();
$data = [];
$totales = array_fill_keys(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'], 0);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        foreach ($row as $mes => $valor) {
            if ($mes != 'Nombre' && $valor != NULL) {
                $totales[$mes] += $valor;
            }
        }
        $data[] = $row;
    }
    $data[] = array_merge(['Nombre' => 'Total'], $totales); // Añade los totales al final de $data
}

$stmt->close();
$conn->close();

return $data;
?>
