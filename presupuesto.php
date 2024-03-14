<!--DataMaq/presupuestos.php-->
<?php
require "includes/header.php";

if(isset($_GET['peso']) && !empty($_GET['peso'])) {
    $peso           = filter_var($_GET['peso'           ], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $precio_venta   = filter_var($_GET['precio_venta'   ], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $formato        = filter_var($_GET['formato'        ], FILTER_SANITIZE_STRING);
    $vel            = filter_var($_GET['vel'            ], FILTER_SANITIZE_NUMBER_INT);
    $Trabajadores   = filter_var($_GET['Trabajadores'   ], FILTER_SANITIZE_NUMBER_INT);
    $peso = $peso/1000;  

    require "includes/datos.php"; // Suponiendo que en este archivo necesitas usar $peso
} else {
    $peso = "0.042";
    echo "Parámetro 'peso' no especificado. por defecto peso = $peso gramos";
}
require "includes/datos.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Presupuesto</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Presupuesto - Formato bolsa: <?php echo $formato; ?></h1>
<form action="presupuesto.php" method="GET">
    <label for="vel1"> Velocidad de la máquina:</label>
    <select name="vel">
        <?php
        $velocidades = [40, 60, 80, 100]; // Definir las velocidades disponibles
        foreach ($velocidades as $velocidad) {
            // Si $vel coincide con la velocidad actual, marcarla como seleccionada
            echo '<option value="'.$velocidad.'"'.($vel == $velocidad ? ' selected' : '').'>'.$velocidad.'</option>';
        }
        ?>
    </select>
    <label for="vel2"> [bolsas por minuto]:</label>
    
    <input type="hidden" name="peso" value="<?php echo $peso*1000; ?>">
    <input type="hidden" name="precio_venta" value="<?php echo $precio_venta; ?>">
    <input type="hidden" name="formato" value="<?php echo $formato; ?>">
    <label for="Trabajadores"><br>Trabajadores: </label>
    <select name="Trabajadores">
        <?php
        $opcionesTrabajadores = [4, 5, 6, 8]; // Definir las opciones de trabajadores disponibles
        foreach ($opcionesTrabajadores as $opcion) {
            // Si $Trabajadores coincide con la opción actual, marcarla como seleccionada
            echo '<option value="'.$opcion.'"'.($Trabajadores == $opcion ? ' selected' : '').'>'.$opcion.'</option>';
        }
        ?>
    </select>
    <br>
    <input type="submit" value="Actualizar">
</form>

<?php
    echo "<h2>Costos Variable</h2>";
    list($CostoVariablePapel, $CostoVariableEnergia,$CostoVariableManoObra,$CostoVariableGluer,$MgCont) = visualizarTabla1($data1,$precio_venta);
    $datosJson = json_encode([
        ["Concepto", "Costo ($)"],
        ["Papel", $CostoVariablePapel],
        ["Energía", $CostoVariableEnergia],
        ["Pegamento", $CostoVariableGluer],
        ["Mano de obra", $CostoVariableManoObra],
        ["Margen de contribución", $MgCont]
    ]);
    include 'includes/chart.php'; 

    echo "<h1>Margen de contribución por hora:$";
    echo number_format($MgCont*($vel*60), 2, '.', ',');
    echo "</h1>";

    echo "<h2>Costo fijo </h2>";
    //visualizarTabla0($data0);

    echo "<h3>Costo fijo - Electrico</h3>";
    visualizarTabla2($data2);
    echo "<h3> Costo Fijo - Superficie</h3>";
    visualizarTabla3($data3);
    echo "<h3> Costo Fijo - Mano de obra</h3>";
    visualizarTabla4($data4);
    


    function visualizarTabla1($data1,$precio_venta) {
        $totalCostoMarginal = 0;
        
        if (count($data1) > 0) {
            echo '<table border="1" class="responsive-table">';
            echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Fecha</th><th>Unidad</th><th>KPI</th><th>Unidad KPI</th><th>Costo Marginal</th></tr>";
            foreach ($data1 as $row) {
                $costoMarginal = floatval($row['Valor unitario']) * floatval($row['KPI']);
                $totalCostoMarginal += $costoMarginal; 
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Descripción']) . "</td>";
                echo "<td>$" . number_format(floatval($row['Valor unitario']), 2, '.', ',') . "</td>"; 
                echo "<td></td>"; 
                echo "<td>" . htmlspecialchars($row['Unidad']) . "</td>"; 
                echo "<td>" . htmlspecialchars($row['KPI']) . "</td>"; 
                echo "<td>" . htmlspecialchars($row['Unidad KPI']) . "</td>";
                echo "<td>$" . number_format($costoMarginal, 2, '.', ',') . "</td>";
                echo "</tr>";
            }
            echo "<tr><td colspan='6'><strong>Total Costo Variable      </strong></td><td><strong>$".number_format($totalCostoMarginal, 2, '.', ',')."</td></strong></tr>";
            $MgCont =$precio_venta-$totalCostoMarginal;
 

            echo "<tr><td colspan='6'><strong>Precio de venta           </strong></td><td>$" . number_format($precio_venta, 2, '.', ',') . "</td></tr>";
            echo "<tr><td colspan='6'><strong>Margen de contribución    </strong></td><td>$".number_format($MgCont, 2, '.', ',')."</td></tr>";
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }
        $CostoVariablePapel = floatval($data1[0]['Valor unitario']) * floatval($data1[0]['KPI']);
        $CostoVariableManoObra = floatval($data1[1]['Valor unitario']) * floatval($data1[1]['KPI']);
        $CostoVariableEnergia = 10*floatval($data1[2]['Valor unitario']) * floatval($data1[2]['KPI']); // TUve que multiplicar por diez par que figure en el chart
        $CostoVariableGluer = floatval($data1[3]['Valor unitario']) * floatval($data1[3]['KPI']);
        return array($CostoVariablePapel, $CostoVariableEnergia,$CostoVariableManoObra,$CostoVariableGluer,$MgCont);

    }

    function visualizarTabla2($data2) {
        $totalCostoFijo = 0;
        if (count($data2) > 0) {
            echo '<table border="1" class="responsive-table">';
            echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>Potencia</th><th>Horas por día</th><th>Días por mes</th><th>Costo Fijo mensual</th></tr>"; 
            foreach ($data2 as $row) {
                $potenciaEnKw = floatval($row['Potencia']) / 1000; 
                $consumoEnergiaMensualKwh = $potenciaEnKw * floatval($row['Horas por día']) * intval($row['Días por mes']);
                $costoFijoMensual = $consumoEnergiaMensualKwh * floatval($row['Valor unitario']);
                $totalCostoFijo += $costoFijoMensual; 
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Descripción']) . "</td>";
                echo "<td>$" . number_format(floatval($row['Valor unitario']), 2, '.', ',') . "</td>"; 
                echo "<td>" . htmlspecialchars($row['Unidad']) . "</td>"; 
                echo "<td>" . htmlspecialchars($row['Potencia']) . " W</td>"; 
                echo "<td>" . htmlspecialchars($row['Horas por día']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Días por mes']) . "</td>";
                echo "<td>$" . number_format($costoFijoMensual, 2, '.', ',') . "</td>";
                echo "</tr>";
            }
            echo "<tr><td colspan='6'>Total</td><td>$".number_format($totalCostoFijo, 2, '.', ',')."</td></tr>";
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }
    }

    function visualizarTabla3($data3) {
        $totalCostoEspacio = 0; // Inicializar la suma total del costo
    
        if (count($data3) > 0) {
            echo '<table border="1" class="responsive-table">';
            // Corregir los encabezados de las columnas según los datos disponibles
            echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>Superficie (M2)</th><th>Costo Mensual</th></tr>"; 
    
            foreach ($data3 as $row) {
                // Calcular el costo mensual como el producto del valor unitario por la superficie
                $costoMensual = floatval($row['Valor unitario']) * floatval($row['Superficie']);
                $totalCostoEspacio += $costoMensual;
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Descripción']) . "</td>";
                echo "<td>$" . number_format(floatval($row['Valor unitario']), 2, '.', ',') . "</td>";
                echo "<td>" . htmlspecialchars($row['Unidad']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Superficie']) . "</td>";
                echo "<td>$" . number_format($costoMensual, 2, '.', ',') . "</td>";
                echo "</tr>";
            }
    
            // Mostrar el total del costo fijo mensual
            echo "<tr><td colspan='4'>Total</td><td>$" . number_format($totalCostoEspacio, 2, '.', ',') . "</td></tr>";
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }
    }
    

    function visualizarTabla4($data4) {
        // Inicializar la suma total del costo de mano de obra
        $totalCostoManoObra = 0;
    
        if (count($data4) > 0) {
            echo '<table border="1" class="responsive-table">';
            // Asegúrate de ajustar los encabezados de las columnas según tus necesidades
            echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>Horas</th><th>Costo Total</th></tr>"; 
    
            foreach ($data4 as $row) {
                // Calcular el costo total como el producto del valor unitario por las horas
                $costoTotal = floatval($row['Valor unitario']) * floatval($row['Horas']);
    
                // Sumar al total general de costo de mano de obra
                $totalCostoManoObra += $costoTotal;
    
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Descripción']) . "</td>";
                echo "<td>$" . number_format(floatval($row['Valor unitario']), 2, '.', ',') . "</td>";
                echo "<td>" . htmlspecialchars($row['Unidad']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Horas']) . "</td>";
                echo "<td>$" . number_format($costoTotal, 2, '.', ',') . "</td>";
                echo "</tr>";
            }
            // Mostrar el total del costo de mano de obra
            echo "<tr><td colspan='4'>Total</td><td>$" . number_format($totalCostoManoObra, 2, '.', ',') . "</td></tr>";
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }
    }



    
    
?>



</body>
</html>
