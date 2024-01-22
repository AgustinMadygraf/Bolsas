<?php
require "../includes/header.php";
require_once 'conn.php';

// Obtener el valor de búsqueda
$ID_formato = intval($_GET['ID_formato']);

// Realizar la consulta de búsqueda
$query1 = "SELECT * FROM tabla_1 WHERE ID_formato = $ID_formato ";
$result1 = mysqli_query($conn, $query1);
$query2 = "SELECT * FROM tabla_2 WHERE ID_formato = $ID_formato ";
$result2 = mysqli_query($conn, $query2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Búsqueda de Stock</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<br><br>
    <div class='topnav'>
    <ul>
        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == '../stock.php')       ? 'active' : ''; ?>">   <a href='../stock.php'                                             >Ir a Stock    </a></li>
        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'busqueda.php')    ? 'active' : ''; ?>">   <a href='busqueda.php?ID_formato=   <?php echo $ID_formato;?>'  >Búsqueda       </a></li>
        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'ingreso.php')     ? 'active' : ''; ?>">   <a href='ingreso.php?ID_formato=    <?php echo $ID_formato;?>'  >Ingreso        </a></li>
        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'egreso.php')      ? 'active' : ''; ?>">   <a href='egreso.php?ID_formato=     <?php echo $ID_formato;?>'  >Egreso         </a></li>
    </ul>
</div>

    <h1>Resultados de búsqueda</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Formato</th>
            <th>Color</th>
            <th>Gramaje</th>
            <th>Cantidades</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result1)) { ?>
            <tr>
                <td><?php echo $row['ID_formato'];  ?></td>
                <td><?php echo $row['formato'];     ?></td>
                <td><?php echo $row['color'];       ?></td>
                <td><?php echo $row['gramaje'];     ?></td>
                <td><?php echo $row['cantidades'];  ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <table>
        <tr>
            <th>papel   </th>
            <th>fecha   </th>
            <th>pedido  </th>
            <th>detalle </th>
            <th>origen  </th>
            <th>ingreso </th>
            <th>egreso  </th>
            <th>saldo   </th>
            <th>destino	sobrante</th>
            <th>facturado</th>
            <th>entregado</th>
            <th>remito  </th>
            <th>sobreconsumo</th>
            <th>lote    </th>
            
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result2)) { ?>
            <tr>
                <td><?php echo $row['papel'];   ?></td>
                <td><?php echo $row['fecha'];   ?></td>
                <td><?php echo $row['pedido'];  ?></td>
                <td><?php echo $row['detalle']; ?></td>
                <td><?php echo $row['origen'];  ?></td>
            </tr>
        <?php } ?>
    </table>

    <?php mysqli_close($conn); ?>
</body>
</html>
