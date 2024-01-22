<?php
$conn = mysqli_connect("localhost", "root", "12345678", "registro_stock");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
