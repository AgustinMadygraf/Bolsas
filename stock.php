
<?php
require "includes/header.php";
require_once 'Stock/conn.php';
// Obtener los valores de los filtros
$formatoFilter  = isset($_GET['Formato'])   ? $_GET['Formato']  : 'todos';
$colorFilter    = isset($_GET['color'])     ? $_GET['color']    : 'todos';
$gramajeFilter  = isset($_GET['gramaje'])   ? $_GET['gramaje']  : 'todos';

// Inicializar arreglo para condiciones
$conditions = [];
$params = [];

// Agregar condiciones según los filtros seleccionados
if ($formatoFilter !== 'todos') {
    $conditions[] = "formato = ?";
    $params[] = $formatoFilter;
}
if ($colorFilter !== 'todos') {
    $conditions[] = "color = ?";
    $params[] = $colorFilter;
}
if ($gramajeFilter !== 'todos') {
    $conditions[] = "gramaje = ?";
    $params[] = $gramajeFilter;
}

// Construir la consulta base con ordenación
$query = "SELECT * FROM tabla_1";

// Agregar condiciones si existen
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

// Agregar ordenación por 'cantidades' de mayor a menor
$query .= " ORDER BY cantidades DESC";

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($query);

// Vincular parámetros y ejecutar
for ($i = 0; $i < count($params); $i++) {
    $stmt->bind_param("s", $params[$i]);
}
$stmt->execute();
$result = $stmt->get_result();
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
        <th>ID_formato      </th>
        <th>Formato         </th>
        <th>Color           </th>
        <th>Gramaje         </th>
        <th>Cantidades      </th>
        <th>Fecha           </th>
        <th>Valor unitario  </th>
        <th>Valor total  </th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><a href="Stock/busqueda.php?ID_formato=<?php echo $row['ID_formato']; ?>"><?php echo $row['ID_formato'];    ?> </td>
            <td><a href="Stock/busqueda.php?ID_formato=<?php echo $row['ID_formato']; ?>"><?php echo $row['formato'];       ?>  </td>
            <td><a href="Stock/busqueda.php?ID_formato=<?php echo $row['ID_formato']; ?>"><?php echo $row['color'];         ?>  </td>
            <td><a href="Stock/busqueda.php?ID_formato=<?php echo $row['ID_formato']; ?>"><?php echo $row['gramaje'];       ?>  </td>
            <td><a href="Stock/busqueda.php?ID_formato=<?php echo $row['ID_formato']; ?>"><?php echo $row['cantidades'];    ?>  </td>
            <td><a href="Stock/busqueda.php?ID_formato=<?php echo $row['ID_formato']; ?>"><?php echo $row['fechatiempo'];   ?>  </td>
            <td><a href="Stock/busqueda.php?ID_formato=<?php echo $row['ID_formato']; ?>">                                      </td>
            <td><a href="Stock/busqueda.php?ID_formato=<?php echo $row['ID_formato']; ?>">                                      </td>
        </tr>
    <?php } ?>
</table>
<?php mysqli_close($conn); ?>
<script>
    function submitForm() {
        document.getElementById("filtroForm").submit();
    }
</script>
</body>
</html>
