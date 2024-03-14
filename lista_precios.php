<?php
require "includes/header.php";
require 'includes/db_functions.php'; 

// Obtener fechas únicas de listado_precios
$sqlFechas = "SELECT DISTINCT fecha_listado FROM listado_precios ORDER BY fecha_listado DESC"; 

$fechas = getArraySQL($sqlFechas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Precios</title> 
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Listado de precios</h1>

<form action="lista_precios.php" method="GET">
    <select name="fechaSeleccionada">
        <?php
        foreach ($fechas as $fecha) {
            echo '<option value="'.$fecha['fecha_listado'].'">'.$fecha['fecha_listado'].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Filtrar">
</form>

<?php

$fechaSeleccionada = $_GET['fechaSeleccionada'] ?? '2024-02-01';
$sql = "SELECT t1.ID_formato, t1.formato, t1.color, t1.gramaje, lp.cantidad, lp.precio_u_sIVA, t1.ancho, t1.fuelle, t1.alto 
        FROM listado_precios lp 
        INNER JOIN tabla_1 t1 ON lp.ID_formato = t1.ID_formato 
        WHERE lp.fecha_listado = '$fechaSeleccionada'
        ORDER BY t1.color DESC";

$resultados = getArraySQL($sql);
?>

<table border="1" class="responsive-table">
    <tr>
        <th>Descripción</th>
        <th>Costo Unitario</th>
    </tr>
    <tr>
        <td>Papel</td>
        <td>1250</td>
</table>

<table border="1" class="responsive-table">
    <tr>
        <th>ID_formato</th>
        <th>Formato____</th>
        <th>Color</th>
        <th>Gramaje</th>
        <th>Cantidad</th>
        <th>Precio Unitario s/IVA</th>
        <th>Ancho bolsas</th>
        <th>Fuelle bolsas</th>
        <th>Alto bolsas</th>
        <th>Ancho bobina papel [cm]</th>
        <th>Desarrollo [cm]</th>
        <th>Peso [gr]</th>
        <th>Costo Papel [ARS/Kg]</th>
        <th>Costo_Marginal Papel</th>
        <th>porcentaje papel sobre precio [%]</th>
    </tr>
    <?php
    foreach ($resultados as $resultado) {
        $ancho_bobina = 2*$resultado['ancho']+2*$resultado['fuelle']+3;
        $desarrollo = $resultado['alto']+$resultado['fuelle']/2+2;
        $superficie = ($ancho_bobina/100 ) * ($desarrollo/100) ;
        $peso = number_format(($superficie * $resultado['gramaje']), 1, '.', ''); // quiero tener un sólo decimal luego de la coma
        $costo_papel = 1026;
        $costo_papel_bolsa = number_format(($costo_papel * $peso / 1000), 2, '.', ''); // Cálculo original
        $porcentaje = number_format(100* $costo_papel_bolsa/($resultado['precio_u_sIVA']*1.21),2) ;
        $costo_malos =  number_format($costo_papel_bolsa * 0.10,2);
        $costo_mano_obra = 0;
        $costo_adhesivo = 0;
        $costo_energía = 0;        
        $gastos_comerciales = 0;
        
        echo "<tr>
                <td><a href='presupuesto.php?peso=$peso&precio_venta={$resultado['precio_u_sIVA']}&formato={$resultado['formato']}' target='_blank'>{$resultado['ID_formato']}</a></td>
                <td>{$resultado['formato']}         </td>
                <td>{$resultado['color']}           </td>
                <td>{$resultado['gramaje']}         </td>
                <td>{$resultado['cantidad']}        </td>
                <td>{$resultado['precio_u_sIVA']}   </td>
                <td>{$resultado['ancho']}           </td>
                <td>{$resultado['fuelle']}          </td>  
                <td>{$resultado['alto']}            </td>    
                <td>{$ancho_bobina}                 </td>  
                <td>{$desarrollo}                   </td>  
                <td>{$peso}                         </td>      
                <td>{$costo_papel}                  </td>
                <td>{$costo_papel_bolsa} ARS        </td>
                <td> {$porcentaje}%                 </td>
              </tr>";
    }
    ?>
</table>
</body>
</html>





