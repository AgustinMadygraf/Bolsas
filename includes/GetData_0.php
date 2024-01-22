<!--includes/GetData_0.php-->
<?php
require 'conn.php'; 

$conn = new mysqli($server, $usuario, $pass, 'bolsas'); 

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT Legajo, Apellido, Nombre, Enero, Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Septiembre, Octubre, Noviembre FROM excedente_repartible_2023");
$stmt->execute();
$result = $stmt->get_result();

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$stmt->close();
$conn->close();

return $data;
?>
