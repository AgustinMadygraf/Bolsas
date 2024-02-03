
<?php
require "includes/header.php";
require_once 'Stock/conn.php';
require_once 'Stock/stockFunctions.php';
// Obtener los valores de los filtros
$formatoFilter  = isset($_GET['Formato'])   ? $_GET['Formato']  : 'todos';
$colorFilter    = isset($_GET['color'])     ? $_GET['color']    : 'todos';
$gramajeFilter  = isset($_GET['gramaje'])   ? $_GET['gramaje']  : 'todos';

// Llamar a obtenerDatosStock() con los filtros
$data = obtenerDatosStock($formatoFilter, $colorFilter, $gramajeFilter);

//print_r($data); 
//var_dump($data);



// Función para crear enlaces
function crearEnlace($id_formato, $texto) {
    return '<a href="Stock/busqueda.php?ID_formato=' . $id_formato . '">' . htmlspecialchars($texto) . '</a>';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Stock bolsas</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<h1>Registro y control stock bolsas de papel</h1>
<form action="stock.php" method="GET" id="filtroForm">
    <table>
        <tr>
            <th>Formato</th>
            <th>Color</th>
            <th>Gramaje</th>
        </tr>
        <tr>
            <th>
            <select name="Formato" onchange="submitForm()"> 
                <option value="todos" <?php if ($formatoFilter === 'todos') echo 'selected'; ?>>todos</option>
                <option value="12 X 08 X 19" <?php if ($formatoFilter === '12 X 08 X 19') echo 'selected'; ?>>12 x 08 x 19</option> 
                <option value="12 X 08 X 26" <?php if ($formatoFilter === '12 X 08 X 26') echo 'selected'; ?>>12 x 08 x 26</option> 
                <option value="12 X 08 X 40" <?php if ($formatoFilter === '12 X 08 X 40') echo 'selected'; ?>>12 x 08 x 40</option>

                <option value="22 X 10 X 20" <?php if ($formatoFilter === '22 X 10 X 20') echo 'selected'; ?>>22 x 10 x 20</option>
                <option value="22 X 10 X 24" <?php if ($formatoFilter === '22 X 10 X 24') echo 'selected'; ?>>22 x 10 x 24</option>
                <option value="22 X 10 X 30" <?php if ($formatoFilter === '22 X 10 X 30') echo 'selected'; ?>>22 x 10 x 30</option>
                <option value="22 X 10 X 42" <?php if ($formatoFilter === '22 X 10 X 42') echo 'selected'; ?>>22 x 10 x 42</option>

                <option value="26 X 12 X 36" <?php if ($formatoFilter === '26 X 12 X 36') echo 'selected'; ?>>26 x 12 x 36</option>
                <option value="26 X 12 X 41" <?php if ($formatoFilter === '26 X 12 X 41') echo 'selected'; ?>>26 x 12 x 41</option>

                <option value="28 X 12 X 41" <?php if ($formatoFilter === '28 X 12 X 41') echo 'selected'; ?>>28 x 12 x 41</option>
                <option value="28 X 16 X 38" <?php if ($formatoFilter === '28 X 16 X 38') echo 'selected'; ?>>28 x 16 x 38</option>

                <option value="30 X 12 X 32" <?php if ($formatoFilter === '30 X 12 X 32') echo 'selected'; ?>>30 x 12 x 32</option>
                <option value="30 X 12 X 41" <?php if ($formatoFilter === '30 X 12 X 41') echo 'selected'; ?>>30 x 12 x 41</option>
                <option value="30 X 16 X 43" <?php if ($formatoFilter === '30 X 16 X 43') echo 'selected'; ?>>30 x 16 x 43</option>
            </select> 

            </th>
            <th>
                <select name="color" onchange="submitForm()"> 
                    <option value="todos" <?php if ($colorFilter === 'todos') echo 'selected'; ?>>todos</option>
                    <option value="Marrón" <?php if ($colorFilter === 'Marrón') echo 'selected'; ?>>Marrón</option>
                    <option value="Blanco" <?php if ($colorFilter === 'Blanco') echo 'selected'; ?>>Blanco</option>
                </select>

            </th>
            <th>
                <select name="gramaje" onchange="submitForm()"> 
                    <option value="todos"   <?php if ($gramajeFilter === 'todos')   echo 'selected'; ?>>todos   </option>
                    <option value="100"     <?php if ($gramajeFilter === '100')     echo 'selected'; ?>>100     </option>
                    <option value="80"      <?php if ($gramajeFilter === '80')      echo 'selected'; ?>>80      </option>
                </select>

            </th>
        </tr>
    </table>
    <br>
    <input type="submit" value="filtrar" style="display: none;">
</form>
<br>


<table>
    <tr>
        <th>ID_formato</th>
        <th>Formato</th>
        <th>Color</th>
        <th>Gramaje</th>
        <th>Cantidades</th>
        <th>Fecha</th>
        <th>Valor unitario</th>
        <th>Valor total</th>
    </tr>

    <?php
    $totalSuma = 0;
    foreach ($data as $row) { // Utiliza $data en lugar de mysqli_fetch_assoc($result)
        echo "<tr>";
        echo "<td>" . crearEnlace($row['ID_formato'], $row['ID_formato']) . "</td>";
        echo "<td>" . crearEnlace($row['ID_formato'], $row['formato']) . "</td>";
        echo "<td>" . crearEnlace($row['ID_formato'], $row['color']) . "</td>";
        echo "<td>" . crearEnlace($row['ID_formato'], $row['gramaje']) . "</td>";
        echo "<td>" . crearEnlace($row['ID_formato'], $row['cantidades']) . "</td>";
        echo "<td>" . crearEnlace($row['ID_formato'], $row['fechatiempo']) . "</td>"; // Asegúrate de que esta columna exista en tu DB o ajusta según sea necesario
        $valorUnitario = isset($row['precio_u_sIVA']) ? $row['precio_u_sIVA'] : 'No disponible';
        echo "<td>" . $valorUnitario . "</td>";
        if (isset($row['precio_u_sIVA'])) {
            $valorTotal = $row['cantidades'] * $row['precio_u_sIVA'];
            echo "<td>" . number_format($valorTotal, 2, '.', ',') . "</td>";
            $totalSuma += $valorTotal;
        } else {
            echo "<td>No disponible</td>";
        }
        echo "</tr>";
    }
    ?>
    <tr>
        <td colspan="7" style="text-align: right;">Suma Total</td>
        <td><?php echo number_format($totalSuma, 2, '.', ','); ?></td>
    </tr>
</table>





<?php mysqli_close($conn); ?>
<script>
    function submitForm() {
        document.getElementById("filtroForm").submit();
    }
</script>
</body>
</html>
