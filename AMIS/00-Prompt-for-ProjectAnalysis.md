
# SYSTEM

## Contexto del Proyecto
Este prompt está diseñado para ser utilizado en conjunto con la estructura de directorios y archivos de un proyecto de software, enfocándose en el desarrollo y diseño UX/UI. Será aplicado por modelos de lenguaje de gran escala como ChatGPT, Google Bard, BlackBox, etc., para proporcionar análisis y recomendaciones de mejora.

## Objetivo
El objetivo es analizar un proyecto de software para identificar áreas específicas donde aplicar mejores prácticas de programación, diseño UX/UI, y técnicas de machine learning para optimización y automatización. Tendrás que prestar atención al archivo REAMDE.md

# USER

### Pasos para la Mejora del Proyecto
1. **Análisis Automatizado del Proyecto:**
   - Realizar una revisión  de la estructura de directorios y archivos, y contenido del proyecto utilizando pruebas automáticas y análisis de rendimiento.

2. **Identificación de Áreas de Mejora con Machine Learning:**
   - Utilizar algoritmos de machine learning para identificar patrones de errores comunes, optimización de rendimiento y áreas clave para mejoras.

3. **Sugerencias Específicas y Refactorización:**
   - Proporcionar recomendaciones detalladas y automatizadas para las mejoras identificadas, incluyendo sugerencias de refactorización y optimización.

4. **Plan de Acción Detallado con Retroalimentación:**
   - Desarrollar un plan de acción con pasos específicos, incluyendo herramientas y prácticas recomendadas.
   - Implementar un sistema de retroalimentación para ajustar continuamente el proceso de mejora basándose en el uso y rendimiento.

5. **Implementación y Evaluación Continua:**
   - Indicar archivos o componentes específicos para mejoras.
   - Evaluar el impacto de las mejoras y realizar ajustes basándose en retroalimentación continua.

### Consideraciones para la Mejora
- **Desarrollo de Software:**
   - Examinar estructura de archivos, logging, código duplicado, ciberseguridad, nomenclatura y prácticas de codificación.
   - Incorporar pruebas automáticas y análisis de rendimiento.

- **Diseño UX/UI:**
   - Enfocarse en accesibilidad, estética, funcionalidad y experiencia del usuario.

- **Tecnologías Utilizadas:**
   - El proyecto utiliza Python, PHP, HTML, MySQL, JavaScript y CSS. Las recomendaciones serán compatibles con estas tecnologías.

- **Automatización y Machine Learning:**
   - Implementar pruebas automáticas y algoritmos de machine learning para detectar y sugerir mejoras.
   - Utilizar retroalimentación para ajustes continuos y aprendizaje colectivo.

- **Documentación y Conocimiento Compartido:**
   - Mantener una documentación detallada de todos los cambios y mejoras para facilitar el aprendizaje y la mejora continua.



## Estructura de Carpetas y Archivos
```bash
Bolsas/
    asociados.php
    costos_operativos.php
    index.php
    lista_precios.php
    presupuesto.php
    stock.php
    ventas.php
    AMIS/
        00-Prompt-for-ProjectAnalysis.md
    CSS/
        header.css
        index.css
        style.css
    database/
        bolsas.sql
    includes/
        chart.php
        conn.php
        datos.php
        db_functions.php
        GetData_0.php
        GetData_2.php
        GetData_3.php
        GetData_4.php
        header.php
    Stock/
        busqueda.php
        conn.php
        egreso.php
        filtroForm.php
        ingreso.php
        input.php
        procesar.php
        README.md
        registro_stock.sql
        stockFunctions.php
```


## Contenido de Archivos Seleccionados

### C:\AppServ\www\Bolsas\asociados.php
```plaintext
<\!--asociados.php-->
<\!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Asociados - Año 2023</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<?php
    require "includes/header.php";
    ?>
    <h1>Tabla de Asociados en bolsas</h1>
    <?php
        $data = include\('includes/GetData\_0.php'\); // Inclusión de los datos

        if \(count\($data\) > 0\) {
            echo "<table>";
            echo "<tr><th>Legajo</th><th>Apellido</th><th>Nombre</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th></tr>";
            
            foreach \($data as $row\) {
                echo "<tr>";
                echo "<td>" . $row\["Legajo"\] . "</td>";
                echo "<td>" . $row\["Apellido"\] . "</td>";
                echo "<td>" . $row\["Nombre"\] . "</td>";
                echo "<td>" . $row\["Enero"\] . "</td>";
                echo "<td>" . $row\["Febrero"\] . "</td>";
                echo "<td>" . $row\["Marzo"\] . "</td>";
                echo "<td>" . $row\["Abril"\] . "</td>";
                echo "<td>" . $row\["Mayo"\] . "</td>";
                echo "<td>" . $row\["Junio"\] . "</td>";
                echo "<td>" . $row\["Julio"\] . "</td>";
                echo "<td>" . $row\["Agosto"\] . "</td>";
                echo "<td>" . $row\["Septiembre"\] . "</td>";
                echo "<td>" . $row\["Octubre"\] . "</td>";
                echo "<td>" . $row\["Noviembre"\] . "</td>";
                echo "</tr>"; }
                echo "</table>";
            } else {
                echo "No se encontraron registros en la tabla.";
                    }

$stmt->close\(\);
$conn->close\(\);
?>
```

### C:\AppServ\www\Bolsas\costos_operativos.php
```plaintext
<\!--costos\_operativos.php-->
<?php
require "includes/header.php";

function obtenerDatosCosto\($conexion\) {
    $sql = "SELECT Nombre, Total FROM costos\_operativos ORDER BY Total DESC";
    $resultado = $conexion->query\($sql\);
    $datos = \[\["Nombre", "Total"\]\]; // Encabezado para Google Charts

    if \($resultado->num\_rows > 0\) {
        while\($fila = $resultado->fetch\_assoc\(\)\) {
            $datos\[\] = \[$fila\["Nombre"\], floatval\($fila\["Total"\]\)\];
        }
    }
    return $datos;
            }
?>
<\!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Costos Operativos</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Costos Operativos Mensuales - Año 2023 - Valores nominales</h1>
<?php
    $data = include\('includes/GetData\_2.php'\); // Inclusión de los datos
    if \(count\($data\) > 0\) {
        echo '<table border="1" class="responsive-table">';
        echo "<tr><th>Nombre</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th><th>Total</th></tr>";
        foreach \($data as $row\) {
            echo "<tr>";
            foreach \($row as $key => $cell\) {
                // Formatea los números con separadores de miles y decimales
                if \($key \!= 'Nombre' && $cell \!= NULL\) {
                    $cell = number\_format\($cell, 2, '.', ','\);
                }
                echo "<td>" . $cell . "</td>";
                }
            echo "</tr>";
            }
            echo "</table>";
            } 
            else {
                echo "No se encontraron registros en la tabla.";
            }

             
            try {
                $conexion = new mysqli\($server, $usuario, $pass, 'bolsas'\);
                if \($conexion->connect\_error\) {
                    throw new Exception\("Fallo en la conexión: " . $conexion->connect\_error\);
                }
                $datosGrafico = obtenerDatosCosto\($conexion\);
                $datosJson = json\_encode\($datosGrafico\);
            } catch \(Exception $e\) {
                error\_log\("Error: " . $e->getMessage\(\)\);
                // Manejo del error
                $datosJson = "\[\]";
            }
            
            //echo "<br><br><br><br>datosJson:<br><br>".$datosJson."<br><br><br><br>";
            $conexion->close\(\);
            
            include 'includes/chart.php'; 
            include 'includes/table.php'; 
                  
    ?>


<br><br><br><br><br>
<h1>Costos - Año 2023 valores actualizados a diciembre 2023</h1>
<?php
$datosCostos = \[
    \["Descripción" => "Retiro asociados",       "Valor" => "32663849.61"\],
    \["Descripción" => "Papel",                  "Valor" => "12823457.58"\],
    \["Descripción" => "Adhesivo",               "Valor" => "5351180.14"\],
    \["Descripción" => "Cuerda Retoricida",      "Valor" => "4484009.74"\], 
    \["Descripción" => "PUBLICIDAD \(BURAKKO\)",   "Valor" => "3184287.97"\],
    \["Descripción" => "Corte de bobinas",       "Valor" => "864647.92"\], 
    \["Descripción" => "ENERGÍA",                "Valor" => "196791.33"\]
\];

// Calcular el total
$total = array\_sum\(array\_column\($datosCostos, 'Valor'\)\);

echo '<table>';
echo '    <thead>';
echo '        <tr>';
echo '            <th>Descripción</th>';
echo '            <th>Valor anual actualizado dic 2023</th>';
echo '            <th>Porcentaje \[%\]</th>';
echo '        </tr>';
echo '    </thead>';
echo '    <tbody>';

foreach \($datosCostos as $costo\) {
    $porcentaje = \($costo\['Valor'\] / $total\) \* 100; // Calcular el porcentaje
    echo "<tr>";
    echo "<td>{$costo\['Descripción'\]}</td>";
    echo "<td>$" . number\_format\($costo\['Valor'\], 2, '.', ','\) . "</td>"; // Formatear el valor como moneda
    echo "<td>" . number\_format\($porcentaje, 2, '.', ','\) . "%</td>"; // Formatear el porcentaje
    echo "</tr>";
}

echo '    <tr><td></td><td>Total</td><td>$' . number\_format\($total, 2, '.', ','\) . '</td></tr>'; // Imprimir el total formateado
echo '    </tbody>';
echo '</table>';
?>



</body>
</html>

```

### C:\AppServ\www\Bolsas\index.php
```plaintext
<?php
    require "includes/header.php";
    ?>
```

### C:\AppServ\www\Bolsas\lista_precios.php
```plaintext
<?php
require "includes/header.php";
require 'includes/db\_functions.php'; 

// Obtener fechas únicas de listado\_precios
$sqlFechas = "SELECT DISTINCT fecha\_listado FROM listado\_precios ORDER BY fecha\_listado DESC"; 

$fechas = getArraySQL\($sqlFechas\);
?>

<\!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Precios</title> 
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Listado de precios</h1>

<form action="lista\_precios.php" method="GET">
    <select name="fechaSeleccionada">
        <?php
        foreach \($fechas as $fecha\) {
            echo '<option value="'.$fecha\['fecha\_listado'\].'">'.$fecha\['fecha\_listado'\].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Filtrar">
</form>

<?php

$fechaSeleccionada = $\_GET\['fechaSeleccionada'\] ?? '2024-02-01';
$sql = "SELECT t1.ID\_formato, t1.formato, t1.color, t1.gramaje, lp.cantidad, lp.precio\_u\_sIVA, t1.ancho, t1.fuelle, t1.alto 
        FROM listado\_precios lp 
        INNER JOIN tabla\_1 t1 ON lp.ID\_formato = t1.ID\_formato 
        WHERE lp.fecha\_listado = '$fechaSeleccionada'
        ORDER BY t1.color DESC";

$resultados = getArraySQL\($sql\);
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
        <th>ID\_formato</th>
        <th>Formato\_\_\_\_</th>
        <th>Color</th>
        <th>Gramaje</th>
        <th>Cantidad</th>
        <th>Precio Unitario s/IVA</th>
        <th>Ancho bolsas</th>
        <th>Fuelle bolsas</th>
        <th>Alto bolsas</th>
        <th>Ancho bobina papel \[cm\]</th>
        <th>Desarrollo \[cm\]</th>
        <th>Peso \[gr\]</th>
        <th>Costo Papel \[ARS/Kg\]</th>
        <th>Costo\_Marginal Papel</th>
        <th>porcentaje papel sobre precio \[%\]</th>
    </tr>
    <?php
    foreach \($resultados as $resultado\) {
        $ancho\_bobina = 2\*$resultado\['ancho'\]+2\*$resultado\['fuelle'\]+3;
        $desarrollo = $resultado\['alto'\]+$resultado\['fuelle'\]/2+2;
        $superficie = \($ancho\_bobina/100 \) \* \($desarrollo/100\) ;
        $peso = number\_format\(\($superficie \* $resultado\['gramaje'\]\), 1, '.', ''\); // quiero tener un sólo decimal luego de la coma
        $costo\_papel = 1026;
        $costo\_papel\_bolsa = number\_format\(\($costo\_papel \* $peso / 1000\), 2, '.', ''\); // Cálculo original
        $porcentaje = number\_format\(100\* $costo\_papel\_bolsa/\($resultado\['precio\_u\_sIVA'\]\*1.21\),2\) ;
        $costo\_malos =  number\_format\($costo\_papel\_bolsa \* 0.10,2\);
        $costo\_mano\_obra = 0;
        $costo\_adhesivo = 0;
        $costo\_energía = 0;        
        $gastos\_comerciales = 0;
        
        echo "<tr>
                <td><a href='presupuesto.php?peso=$peso&precio\_venta={$resultado\['precio\_u\_sIVA'\]}&ID\_formato={$resultado\['formato'\]}' target='\_blank'>{$resultado\['ID\_formato'\]}</a></td>
                <td>{$resultado\['formato'\]}         </td>
                <td>{$resultado\['color'\]}           </td>
                <td>{$resultado\['gramaje'\]}         </td>
                <td>{$resultado\['cantidad'\]}        </td>
                <td>{$resultado\['precio\_u\_sIVA'\]}   </td>
                <td>{$resultado\['ancho'\]}           </td>
                <td>{$resultado\['fuelle'\]}          </td>  
                <td>{$resultado\['alto'\]}            </td>    
                <td>{$ancho\_bobina}                 </td>  
                <td>{$desarrollo}                   </td>  
                <td>{$peso}                         </td>      
                <td>{$costo\_papel}                  </td>
                <td>{$costo\_papel\_bolsa} ARS        </td>
                <td> {$porcentaje}%                 </td>
              </tr>";
    }
    ?>
</table>
</body>
</html>






```

### C:\AppServ\www\Bolsas\presupuesto.php
```plaintext
<?php
require "includes/header.php";

if\(isset\($\_GET\['peso'\]\) && \!empty\($\_GET\['peso'\]\)\) {
    // Sanitiza el valor para asegurarse de que es un número
    // Por ejemplo, si esperas un valor numérico, puedes hacerlo así:
    $peso = filter\_var\($\_GET\['peso'\], FILTER\_SANITIZE\_NUMBER\_FLOAT, FILTER\_FLAG\_ALLOW\_FRACTION\);
    $peso = $peso/1000;

    // Ahora puedes usar la variable $peso en tu script
    // Por ejemplo, si necesitas pasarlo a otro script o usarlo en una función
    require "includes/datos.php"; // Suponiendo que en este archivo necesitas usar $peso

    // Código adicional que hace uso de $peso

} else {
    $peso = "0.042";
    echo "Parámetro 'peso' no especificado. por defecto peso = $peso gramos";
    

}



require "includes/datos.php";

?>

<\!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Presupuesto</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Presupuestos</h1>

<?php
    echo "<h2>Costo Marginal</h2>";
    visualizarTabla1\($data1\);
    echo "<h2>Costo fijo - Electrico</h2>";
    visualizarTabla2\($data2\);
    echo "<h2> Costo Fijo - Superficie</h2>";
    visualizarTabla3\($data3\);
    echo "<h2> Costo Fijo - Mano de obra</h2>";
    //visualizarTabla4\($data4\);
    


    function visualizarTabla1\($data1\) {
        $totalCostoMarginal = 0;
        if \(count\($data1\) > 0\) {
            echo '<table border="1" class="responsive-table">';
            echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>KPI</th><th>Unidad KPI</th><th>Costo Marginal</th></tr>";
            foreach \($data1 as $row\) {
                $costoMarginal = floatval\($row\['Valor unitario'\]\) \* floatval\($row\['KPI'\]\);
                $totalCostoMarginal += $costoMarginal; 
                echo "<tr>";
                echo "<td>" . htmlspecialchars\($row\['Descripción'\]\) . "</td>";
                echo "<td>$" . number\_format\(floatval\($row\['Valor unitario'\]\), 2, '.', ','\) . "</td>"; 
                echo "<td>" . htmlspecialchars\($row\['Unidad'\]\) . "</td>"; 
                echo "<td>" . htmlspecialchars\($row\['KPI'\]\) . "</td>"; 
                echo "<td>" . htmlspecialchars\($row\['Unidad KPI'\]\) . "</td>";
                echo "<td>$" . number\_format\($costoMarginal, 2, '.', ','\) . "</td>";
                echo "</tr>";
            }
            echo "<tr><td colspan='5'>Total</td><td>$".number\_format\($totalCostoMarginal, 2, '.', ','\)."</td></tr>";
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }
    }

    function visualizarTabla2\($data2\) {
        $totalCostoFijo = 0;
        if \(count\($data2\) > 0\) {
            echo '<table border="1" class="responsive-table">';
            echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>Potencia</th><th>Horas por día</th><th>Días por mes</th><th>Costo Fijo mensual</th></tr>"; 
            foreach \($data2 as $row\) {
                $potenciaEnKw = floatval\($row\['Potencia'\]\) / 1000; 
                $consumoEnergiaMensualKwh = $potenciaEnKw \* floatval\($row\['Horas por día'\]\) \* intval\($row\['Días por mes'\]\);
                $costoFijoMensual = $consumoEnergiaMensualKwh \* floatval\($row\['Valor unitario'\]\);
                $totalCostoFijo += $costoFijoMensual; 
                echo "<tr>";
                echo "<td>" . htmlspecialchars\($row\['Descripción'\]\) . "</td>";
                echo "<td>$" . number\_format\(floatval\($row\['Valor unitario'\]\), 2, '.', ','\) . "</td>"; 
                echo "<td>" . htmlspecialchars\($row\['Unidad'\]\) . "</td>"; 
                echo "<td>" . htmlspecialchars\($row\['Potencia'\]\) . " W</td>"; 
                echo "<td>" . htmlspecialchars\($row\['Horas por día'\]\) . "</td>";
                echo "<td>" . htmlspecialchars\($row\['Días por mes'\]\) . "</td>";
                echo "<td>$" . number\_format\($costoFijoMensual, 2, '.', ','\) . "</td>";
                echo "</tr>";
            }
            echo "<tr><td colspan='6'>Total</td><td>$".number\_format\($totalCostoFijo, 2, '.', ','\)."</td></tr>";
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }
    }

    function visualizarTabla3\($data3\) {
        $totalCostoEspacio = 0; // Inicializar la suma total del costo
    
        if \(count\($data3\) > 0\) {
            echo '<table border="1" class="responsive-table">';
            // Corregir los encabezados de las columnas según los datos disponibles
            echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>Superficie \(M2\)</th><th>Costo Mensual</th></tr>"; 
    
            foreach \($data3 as $row\) {
                // Calcular el costo mensual como el producto del valor unitario por la superficie
                $costoMensual = floatval\($row\['Valor unitario'\]\) \* floatval\($row\['Superficie'\]\);
    
                // Sumar al total del costo
                $totalCostoEspacio += $costoMensual;
    
                echo "<tr>";
                echo "<td>" . htmlspecialchars\($row\['Descripción'\]\) . "</td>";
                echo "<td>$" . number\_format\(floatval\($row\['Valor unitario'\]\), 2, '.', ','\) . "</td>";
                echo "<td>" . htmlspecialchars\($row\['Unidad'\]\) . "</td>";
                echo "<td>" . htmlspecialchars\($row\['Superficie'\]\) . "</td>";
                // Mostrar el costo mensual calculado
                echo "<td>$" . number\_format\($costoMensual, 2, '.', ','\) . "</td>";
                echo "</tr>";
            }
    
            // Mostrar el total del costo fijo mensual
            echo "<tr><td colspan='4'>Total</td><td>$" . number\_format\($totalCostoEspacio, 2, '.', ','\) . "</td></tr>";
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }
    }
    

    function visualizarTabla4\($data4\) {
    
        if \(count\($data4\) > 0\) {
            echo '<table border="1" class="responsive-table">';
            // Corregir los encabezados de las columnas según los datos disponibles
            echo "<tr><th>Descripción</th><th>Valor unitario</th><th>Unidad</th><th>Superficie \(M2\)</th><th>Costo Mensual</th></tr>"; 
    
            foreach \($data3 as $row\) {
                // Calcular el costo mensual como el producto del valor unitario por la superficie
                $costoMensual = floatval\($row\['Valor unitario'\]\) \* floatval\($row\['Superficie'\]\);
    
                // Sumar al total del costo
                $totalCostoEspacio += $costoMensual;
    
                echo "<tr>";
                echo "<td>" . htmlspecialchars\($row\['Descripción'\]\) . "</td>";
                echo "<td>$" . number\_format\(floatval\($row\['Valor unitario'\]\), 2, '.', ','\) . "</td>";
                echo "<td>" . htmlspecialchars\($row\['Unidad'\]\) . "</td>";
                echo "<td>" . htmlspecialchars\($row\['Superficie'\]\) . "</td>";
                // Mostrar el costo mensual calculado
                echo "<td>$" . number\_format\($costoMensual, 2, '.', ','\) . "</td>";
                echo "</tr>";
            }
    
            // Mostrar el total del costo fijo mensual
            echo "<tr><td colspan='4'>Total</td><td>$" . number\_format\($totalCostoEspacio, 2, '.', ','\) . "</td></tr>";
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }
    }
    
?>



</body>
</html>

```

### C:\AppServ\www\Bolsas\stock.php
```plaintext
<\!--stock.php-->
<?php
require "includes/header.php";
require\_once 'Stock/conn.php';
require\_once 'Stock/stockFunctions.php';
include 'includes/db\_functions.php'; 

function obtenerFiltrosDesdeURL\(\) {
    $cantidadSeleccionadaDefault = '5000'; 
    $fechaListadoFilterDefault = '24-02-01';
    return \[
        'formatoFilter'         => $\_GET\['Formato'\]     ?? 'todos',
        'colorFilter'           => $\_GET\['color'\]       ?? 'todos',
        'gramajeFilter'         => $\_GET\['gramaje'\]     ?? 'todos',
        'cantidadSeleccionada'  => \!empty\($\_GET\['cantidades'\]\)          ? $\_GET\['cantidades'\]           : $cantidadSeleccionadaDefault,
        'fechaListadoFilter'    => \!empty\($\_GET\['fechaSeleccionada'\]\)   ? $\_GET\['fechaSeleccionada'\]    : $fechaListadoFilterDefault,
    \];
}


$fechas = getArraySQL\("SELECT DISTINCT fecha\_listado FROM listado\_precios ORDER BY fecha\_listado DESC"\);
$filtros = obtenerFiltrosDesdeURL\(\);
$data = obtenerDatosStock\(
    strval\($filtros\['formatoFilter'\]\), 
    strval\($filtros\['colorFilter'\]\), 
    strval\($filtros\['gramajeFilter'\]\), 
    strval\($filtros\['cantidadSeleccionada'\]\),
    strval\($filtros\['fechaListadoFilter'\]\) 
\);


function formatearFecha\($fecha, $formato = 'd/m/Y'\) {
    $objFecha = new DateTime\($fecha\);
    return $objFecha->format\($formato\);
}

function mostrarTabla\($data\) {
    $totalSuma = 0;
    $cant\_total = 0;
    foreach \($data as $row\) {
        $valorTotalFormatted = 'No disponible';
        $precioUnitarioFormatted = 'No disponible';
        if \(isset\($row\['precio\_u\_sIVA'\]\)\) {
            $valorTotal = $row\['cantidades'\] \* $row\['precio\_u\_sIVA'\];
            $valorTotalFormatted = is\_numeric\($valorTotal\) ? number\_format\($valorTotal, 2, '.', ','\) : $valorTotal;
            $precioUnitarioFormatted = number\_format\($row\['precio\_u\_sIVA'\], 2, '.', ','\);
            $totalSuma += $valorTotal;
            $cant\_total += isset\($row\['cantidades'\]\) && is\_numeric\($row\['cantidades'\]\) ? $row\['cantidades'\] : 0;
        }
        
        $manijasTexto = isset\($row\['manijas'\]\) && $row\['manijas'\] ? 'Sí' : 'No';

        echo "<tr>";
        echo "<td>" . htmlspecialchars\($row\['ID\_formato'\]\) . "</td>";
        echo "<td>" . htmlspecialchars\($row\['formato'\]\) . "</td>";
        echo "<td>" . htmlspecialchars\($row\['color'\]\) . "</td>";
        echo "<td>" . htmlspecialchars\($row\['gramaje'\]\) . " gr</td>";
        echo "<td>" . $manijasTexto . "</td>"; 
        echo "<td>" . htmlspecialchars\($row\['cantidades'\]\) . "</td>";
        echo "<td>" . formatearFecha\($row\['fechatiempo'\], 'H:i d/m/Y'\) . "</td>";
        echo "<td>" . $precioUnitarioFormatted . "</td>"; 
        echo "<td>" . formatearFecha\($row\['fecha\_listado'\]\) . "</td>";
        echo "<td>" . htmlspecialchars\($row\['cantidad'\]\) . "</td>";
        echo "<td>" . $valorTotalFormatted . "</td>"; 
        echo "</tr>";
    }
    echo "<tr><td colspan='5' style='text-align: right;'><strong>Cantidad Total</strong></td><td>" . number\_format\($cant\_total, 0, '.', ','\) . "</td>";
    echo "<td colspan='4' style='text-align: right;'><strong>Valor Total</strong></td><td>" . number\_format\($totalSuma, 2, '.', ','\) . "</td></tr>";
}


?>

<\!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Stock de bolsas</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <h1>Registro y control de stock de bolsas de papel</h1>
    <?php include 'Stock/filtroForm.php'; ?>
    <table>
        <thead>
            <tr>
                <th>ID Formato</th>
                <th>Formato</th>
                <th>Color</th>
                <th>Gramaje</th>
                <th>Manijas</th>
                <th>Cantidad</th>
                <th>Fecha inventario</th>
                <th>Valor Unitario</th>
                <th>Fecha lista precio</th>
                <th>Precio cantidad</th>
                <th>Valor SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php mostrarTabla\($data\); ?>
        </tbody>
    </table>


</body>
</html>

```

### C:\AppServ\www\Bolsas\ventas.php
```plaintext
<\!--costos\_operativos.php-->
<?php
require "includes/header.php";

function obtenerDatosCosto\($conexion\) {
    $sql = "SELECT Nombre, Total FROM ventas ORDER BY Total DESC";
    $resultado = $conexion->query\($sql\);
    $datos = \[\["Nombre", "Total"\]\]; // Encabezado para Google Charts

    if \($resultado->num\_rows > 0\) {
        while\($fila = $resultado->fetch\_assoc\(\)\) {
            $datos\[\] = \[$fila\["Nombre"\], floatval\($fila\["Total"\]\)\];
        }
    }
    return $datos;
            }
?>
<\!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Costos Operativos</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
<h1>Ventas Mensuales - Año 2023 valores nominales</h1>
<?php
    $data = include\('includes/GetData\_3.php'\); // Inclusión de los datos
    if \(count\($data\) > 0\) {
        echo '<table border="1" class="responsive-table">';
        echo "<tr><th>Nombre</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th><th>Total</th></tr>";
        foreach \($data as $row\) {
            echo "<tr>";
            foreach \($row as $key => $cell\) {
                // Formatea los números con separadores de miles y decimales
                if \($key \!= 'Nombre' && $cell \!= NULL\) {
                    $cell = number\_format\($cell, 2, '.', ','\);
                }
                echo "<td>" . $cell . "</td>";
                }
            echo "</tr>";
            }
            echo "</table>";
            } 
            else {
                echo "No se encontraron registros en la tabla.";
            }

             
            try {
                $conexion = new mysqli\($server, $usuario, $pass, 'bolsas'\);
                if \($conexion->connect\_error\) {
                    throw new Exception\("Fallo en la conexión: " . $conexion->connect\_error\);
                }
                $datosGrafico = obtenerDatosCosto\($conexion\);
                $datosJson = json\_encode\($datosGrafico\);
            } catch \(Exception $e\) {
                error\_log\("Error: " . $e->getMessage\(\)\);
                // Manejo del error
                $datosJson = "\[\]";
            }
            
            //echo "<br><br><br><br>datosJson:<br><br>".$datosJson."<br><br><br><br>";
            $conexion->close\(\);
            
            include 'includes/chart.php'; 
            include 'includes/table.php'; 
                  
    ?>
<h1>Ventas Mensuales - Año 2023 valores actualizados a diciembre 2023</h1>
<?php
$datosVentas = \[
    \["Descripción" => "Ventas", "Valor" => "38403282.65"\],
    \["Descripción" => "Stock", "Valor" => "24525291.56"\]
\];

// Calcular el total
$total = array\_sum\(array\_column\($datosVentas, 'Valor'\)\);

echo '<table>';
echo '    <thead>';
echo '        <tr>';
echo '            <th>Descripción</th>';
echo '            <th>Valor anual actualizado dic 2023</th>';
echo '            <th>Porcentaje \[%\]</th>';
echo '        </tr>';
echo '    </thead>';
echo '    <tbody>';

foreach \($datosVentas as $venta\) {
    $porcentaje = \($venta\['Valor'\] / $total\) \* 100; // Calcular el porcentaje
    echo "<tr>";
    echo "<td>{$venta\['Descripción'\]}</td>";
    echo "<td>$" . number\_format\($venta\['Valor'\], 2, '.', ','\) . "</td>"; // Formatear el valor como moneda
    echo "<td>" . number\_format\($porcentaje, 2, '.', ','\) . "%</td>"; // Formatear el porcentaje
    echo "</tr>";
}

echo '    <tr><td></td><td>Total</td><td>$' . number\_format\($total, 2, '.', ','\) . '</td></tr>'; // Imprimir el total formateado
echo '    </tbody>';
echo '</table>';
?>

</body>

</html>

```

### C:\AppServ\www\Bolsas\CSS\header.css
```plaintext
/\*-----------------------CONTENT--------------\*/

div.content {
  margin-left: 250px;
  padding: 1px 16px;

}

@media screen and \(max-width: 750px\) {

  div.content {margin-left: 0;
              padding: 220px 16px;}
            }


@media screen and \(max-width: 690px\) { div.content {padding: 1px 8px;}        }
@media screen and \(max-width: 680px\) { div.content {padding: 1px 6px;}        }
@media screen and \(max-width: 670px\) { div.content {padding: 1px 4px;}        }
@media screen and \(max-width: 660px\) { div.content {padding: 1px 2px;}        }
@media screen and \(max-width: 650px\) {div.content {padding: 1px 1px;}        }


/\*---------------------------TOPNAV--------------------------\*/

 .topnav ul {
           list-style-type: none;
           margin: 0;
           padding: 0;
           overflow: hidden;
           background-color: #333;
           position: fixed;
           top: 0;
           width: 100%;                     }

.topnav li {  float: left;
              font-size: 16px;
                   }

.topnav li a {
  display: block;
  color: white;
  text-align: center;
  padding: 12px 8px;
  text-decoration: none;
}

.topnav li a:hover:not\(.active\) {
  background-color: #111;
}

.topnav .active {
  background-color: #4CAF50;
}


@media screen and \(max-width: 1275px\) { .topnav li {font-size: 15px;         }
@media screen and \(max-width: 1200px\) { .topnav li {font-size: 14px;         }
@media screen and \(max-width: 1150px\) { .topnav li {font-size: 13px;         }
@media screen and \(max-width: 1100px\) { .topnav li {font-size: 12px;         }
@media screen and \(max-width: 1075px\) { .topnav li {font-size: 11px;         }
@media screen and \(max-width: 1010px\) { .topnav li {font-size: 10px;         }
@media screen and \(max-width: 995px\) { .topnav li {font-size: 9px;         }




.alert-danger{color:#721c24;background-color:#f8d7da;border-color:#f5c6cb}
.alert-danger hr{border-top-color:#f1b0b7}
.alert-danger .alert-link{color:#491217}

```

### C:\AppServ\www\Bolsas\CSS\index.css
```plaintext
body {
  font-family: verdana;
  resize: none;
}
.hoja{      box-sizing: border-box;
            border-radius: 25px;
            height: 100%;
            z-index: -1;                      }
.info{      z-index: 2;
            position: relative;               }
.dataspace{ margin: 0;
            width: 100%;                      }

.graf{      margin: 0 auto;
            width: 95%;                       }
.fire{      height: 50%;
            width: 120%;
            left: -25px;
            background-size: contain;
            background-repeat: repeat-x;
            background-position: bottom;
            position: fixed;
            bottom: 0;
            z-index: 1;                     }
.cabecera { background-color: rgba\(240,240,240,.5\);
            margin-bottom: 0.3em;
            /\* z-index: 2; \*/
            position: relative;             }
.c1 {       text-align: center;
            font-family: verdana;
            padding-top: 5px;               }
p2{         font-size:28pt;
            margin: 0;
            display: block;                 }
p1 {        font-size:34pt;
            padding-bottom: 5px;
            display: block;                 }
.botonera { width: 100%;
            margin: 0;
            background-color: white;
                    }
.periodo, .botonI, .botonD, .spacer, .fin{
            display: inline-block;
            height:55px;
            margin: 0;                      }
.periodo {  width:18%;                      }
.botonI {   width:20%;                      }
.botonD {   width:15%;                      }
.fin {      width:5%;                       }
.spacer{    width:1%;                       }
.presione, .presado{    font-size: 14pt;
                        width: 100%;
                        height: inherit;    }
.presado{   color: #339;                    }
.test{      text-align: center;
            position: fixed;
            right: 17px;
            bottom: 0;
            height: 70px;
            width: 70px;
            z-index: 3;
            background-image: url\('pixil-frame-0.png'\);
            background-size: cover;         }
.test input{
            width: 100%;
            height:100%;
            margin: 0;
            border: 0;
            background-color: #0000;        }
/\*---------------------------TOPNAV--------------------------\*/

 .topnav ul {
           list-style-type: none;
           margin: 0;
           padding: 0;
           overflow: hidden;
           background-color: #333;
           position: fixed;
           top: 0;
           width: 100%;                     }

.topnav li { float: left;                    }

.topnav li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.topnav li a:hover:not\(.active\) {
  background-color: #111;
}

.topnav .active {
  background-color: #4CAF50;
}

/\*-----------------------CONTENT--------------\*/

div.content {
  margin-left: 250px;
  padding: 1px 32px;

}

    /\*----------------------------energia----------\*/

    #fondo {
      border-radius: 20px 20px 0 0;
      width: 100%;
      height: 100%;
      background-image:linear-gradient\(90deg, #77B 0%, #AAF 10%, #55A 90%\);
    }
    #cabecera {
      text-align:center;
      color: #EEE;
      width: 100%;
      height: 100px;
      border-radius: 20px 20px 0 0;
      background: #AAA8;
      margin: 0;
      padding: 0;
    }
    #espacio1 {
      height: 20px;
    }
    h1, #cabecera p {
      margin: 0;
      padding: 0;
    }
    #recuadro {
      font-size: 14pt;
      font-weight: bold;
      width: 380px;
      /\* height: 160px; \*/
      margin: 50px auto 0 auto;
      padding: 10px 50px;
      background: #8888;
      background-image:linear-gradient\(90deg, #8888 10%, #AAA8 90%, #5558 100%\);
    }
    #fechas {
      width: 100%;
      margin: 0;
    }
    #boton {
      font-weight: bold;
    }
    #energ, #costoUnitario, #costo, td p {
      font-weight: normal;
      font-size: 18pt;
      margin-right: 10px;
    }
    #costou td p {
      font-size: 0.8em;
      color: #444;
    }
    #inp1, #inp2 {
      text-align: center;
    }
/\*--------------------------------------------------------------------\*/




.MyButton {
     background:none\!important;
     color:inherit;
     border:none;
     padding:0\!important;
     font: inherit;
     /\*border is optional\*/
     border-bottom:1px solid #444;
     cursor: pointer;
}



/\*----------------------------------------------\*/
.w3-table,.w3-table-all{

      margin: auto;
  border-collapse:collapse;
  border-spacing:0;
  display:table}



.w3-bordered tr,.w3-table-all tr{border-bottom:1px solid #ddd}

.w3-striped tbody tr:nth-child\(even\){background-color:#f1f1f1}

.w3-table-all tr:nth-child\(odd\){background-color:#fff}

.w3-table-all tr:nth-child\(even\){background-color:#f1f1f1}

.w3-hoverable tbody tr:hover,
.w3-ul.w3-hoverable li:hover{background-color:#ccc}

.w3-centered tr th,
.w3-centered tr td{text-align:center}

.w3-table td,
.w3-table th,
.w3-table-all td,
.w3-table-all th{display:table-cell;text-align:left;vertical-align:top}

\*/

.w3-table-all table {border-spacing: 0;}

.w3-table-all tbody,.w3-table-all  thead tr { display: block; }

.w3-table-all tbody {
  width:75%;
    
    overflow-y: auto;
    overflow-x: hidden;
}

.w3-table-all tbody td,.w3-table-all  thead th {
    width: 140px;
}

.w3-table-all thead th:last-child {
    width: 140px; /\* 140px + 16px scrollbar width \*/
}




/\*----------------------------------------\*/


.image img {

   max-width:75%;
   border: 1px solid #000000;
   display:block;
   margin:auto;

}





/\*---------------------SIDENAV---------------\*/


.sidenav ul{
  list-style-type: none;
  margin: 0px;
  padding: 0;
  width: 250px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidenav ul li a {
  display: block;
  color: #000;
  padding: 1px 8px;
  text-decoration: none;
}



.sidenav ul li a.active {
  background-color: #4CAF50;
  color: white;
}

.sidenav ul li a:hover:not\(.active\) {
  background-color: #555;
  color: white;
}
@media screen and \(max-width: 875px\) { .topnav li {font-size: 15px; } }
@media screen and \(max-width: 825px\) { .topnav li {font-size: 14px; } }
@media screen and \(max-width: 805px\) { .topnav li {font-size: 13px; } }
@media screen and \(max-width: 775px\) { .topnav li {font-size: 12px; } }
@media screen and \(max-width: 750px\) {
  div.content {margin-left: 0;}
  .topnav li {font-size: 16px;}
  .topnav li a {padding: 14px 16px; }
}
@media screen and \(max-width: 600px\) { 
  .topnav li {font-size: 14px;}
  .topnav li a {padding: 12px 14px;}
  div.content {padding: 1px 8px;}
}
@media screen and \(max-width: 510px\) { 
  .topnav li {font-size: 12px;}
  div.content {padding: 1px 6px;}
}
@media screen and \(max-width: 480px\) { 
  .topnav li {font-size: 11px;}
  .topnav li a {padding: 10px 12px;}
  div.content {padding: 1px 4px;}
}
@media screen and \(max-width: 435px\) { 
  /\*.topnav li {font-size: 10px;}\*/
  .topnav li a {padding: 8px 10px;}
  div.content {padding: 1px 2px;}
}
@media screen and \(max-width: 410px\) { 
  /\*.topnav li {font-size: 9px;}\*/
  .topnav li a {padding: 6px 8px;}
  div.content {padding: 1px 1px;}
}

```

### C:\AppServ\www\Bolsas\CSS\style.css
```plaintext
body {
    font-family: Arial, sans-serif; /\* Fuente más moderna y legible \*/
    background-color: #f4f4f4; /\* Color de fondo suave para la página \*/
    color: #333; /\* Color del texto \*/
}

table {
    border-collapse: collapse;
    width: 80%;
    margin: 20px auto;
    background-color: #ffffff; /\* Fondo blanco para la tabla \*/
    box-shadow: 0 0 10px rgba\(0,0,0,0.1\); /\* Sombra suave alrededor de la tabla \*/
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #e9e9e9; /\* Color de fondo para las cabeceras \*/
    color: #000; /\* Color del texto para las cabeceras \*/
}

tr:nth-child\(even\) {
    background-color: #f2f2f2; /\* Color de fondo para filas alternas \*/
}

tr:hover {
    background-color: #ddd; /\* Efecto hover para las filas \*/
}

@media screen and \(max-width: 600px\) {
    table {
        width: 100%; /\* Ajuste para dispositivos móviles \*/
    }
}

/\* Estilos generales \*/
body {
    font-family: Arial, sans-serif;
    background-color: #f1f1f1;
    padding: 20px;
}

h1 {
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th,
table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

table th {
    background-color: #f5f5f5;
}

/\* Estilos específicos para la tabla \*/
table tr:hover {
    background-color: #f9f9f9;
}

table td a {
    color: #3366cc;
    text-decoration: none;
}

table td a:hover {
    text-decoration: underline;
}
/\*-----------------------CONTENT--------------\*/

div.content {
    margin-left: 250px;
    padding: 1px 16px;
  
  }
  
  @media screen and \(max-width: 750px\) {
  
    div.content {margin-left: 0;
                padding: 220px 16px;}
              }
  
  
  @media screen and \(max-width: 690px\) { div.content {padding: 1px 8px;}        }
  @media screen and \(max-width: 680px\) { div.content {padding: 1px 6px;}        }
  @media screen and \(max-width: 670px\) { div.content {padding: 1px 4px;}        }
  @media screen and \(max-width: 660px\) { div.content {padding: 1px 2px;}        }
  @media screen and \(max-width: 650px\) {div.content {padding: 1px 1px;}        }
  
  
  /\*---------------------------TOPNAV--------------------------\*/
  
   .topnav ul {
             list-style-type: none;
             margin: 0;
             padding: 0;
             overflow: hidden;
             background-color: #333;
             position: fixed;
             top: 0;
             width: 100%;                     }
  
  .topnav li {  float: left;
                font-size: 16px;
                     }
  
  .topnav li a {
    display: block;
    color: white;
    text-align: center;
    padding: 12px 8px;
    text-decoration: none;
  }
  
  .topnav li a:hover:not\(.active\) {
    background-color: #111;
  }
  
  .topnav .active {
    background-color: #4CAF50;
  }
  
  
  body {
    font-family: Arial, sans-serif; /\* Fuente más moderna y legible \*/
    background-color: #f4f4f4; /\* Color de fondo suave para la página \*/
    color: #333; /\* Color del texto \*/
}

table {
    border-collapse: collapse;
    width: 80%;
    margin: 20px auto;
    background-color: #ffffff; /\* Fondo blanco para la tabla \*/
    box-shadow: 0 0 10px rgba\(0,0,0,0.1\); /\* Sombra suave alrededor de la tabla \*/
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #e9e9e9; /\* Color de fondo para las cabeceras \*/
    color: #000; /\* Color del texto para las cabeceras \*/
}

tr:nth-child\(even\) {
    background-color: #f2f2f2; /\* Color de fondo para filas alternas \*/
}

tr:hover {
    background-color: #ddd; /\* Efecto hover para las filas \*/
}

@media screen and \(max-width: 600px\) {
    table {
        width: 100%; /\* Ajuste para dispositivos móviles \*/
    }
}

/\* Estilos generales \*/
body {
    font-family: Arial, sans-serif;
    background-color: #f1f1f1;
    padding: 20px;
}

h1 {
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th,
table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

table th {
    background-color: #f5f5f5;
}

/\* Estilos específicos para la tabla \*/
table tr:hover {
    background-color: #f9f9f9;
}

table td a {
    color: #3366cc;
    text-decoration: none;
}

table td a:hover {
    text-decoration: underline;
}
/\*-----------------------CONTENT--------------\*/

div.content {
    margin-left: 250px;
    padding: 1px 16px;
  
  }
  
  @media screen and \(max-width: 750px\) {
  
    div.content {margin-left: 0;
                padding: 220px 16px;}
              }
  
  
  @media screen and \(max-width: 690px\) { div.content {padding: 1px 8px;}        }
  @media screen and \(max-width: 680px\) { div.content {padding: 1px 6px;}        }
  @media screen and \(max-width: 670px\) { div.content {padding: 1px 4px;}        }
  @media screen and \(max-width: 660px\) { div.content {padding: 1px 2px;}        }
  @media screen and \(max-width: 650px\) {div.content {padding: 1px 1px;}        }
  
  
  /\*---------------------------TOPNAV--------------------------\*/
  
   .topnav ul {
             list-style-type: none;
             margin: 0;
             padding: 0;
             overflow: hidden;
             background-color: #333;
             position: fixed;
             top: 0;
             width: 100%;                     }
  
  .topnav li {  float: left;
                font-size: 16px;
                     }
  
  .topnav li a {
    display: block;
    color: white;
    text-align: center;
    padding: 12px 8px;
    text-decoration: none;
  }
  
  .topnav li a:hover:not\(.active\) {
    background-color: #111;
  }
  
  .topnav .active {
    background-color: #4CAF50;
  }
  
  
  @media screen and \(max-width: 1275px\) { .topnav li {font-size: 15px;         }}
  @media screen and \(max-width: 1200px\) { .topnav li {font-size: 14px;         }}
  @media screen and \(max-width: 1150px\) { .topnav li {font-size: 13px;         }}
  @media screen and \(max-width: 1100px\) { .topnav li {font-size: 12px;         }}
  @media screen and \(max-width: 1075px\) { .topnav li {font-size: 11px;         }}
  @media screen and \(max-width: 1010px\) { .topnav li {font-size: 10px;         }}
  @media screen and \(max-width: 995px\) { .topnav li {font-size: 9px;         }}
  
  


  /\*---------------------------TOPNAV2--------------------------\*/
  
  .topnav2 ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    position: fixed;
    top: 0;
    width: 100%;    
    margin-top: 40px;                 }

  
    .topnav2 li {  float: left;
        font-size: 16px;
             }

.topnav2 li a {
display: block;
color: white;
text-align: center;
padding: 12px 8px;
text-decoration: none;
}

.topnav2 li a:hover:not\(.active\) {
background-color: #111;
}

.topnav2 .active {
background-color: #4CAF50;
}


@media screen and \(max-width: 1275px\) { .topnav2 li {font-size: 15px;         }}
@media screen and \(max-width: 1200px\) { .topnav2 li {font-size: 14px;         }}
@media screen and \(max-width: 1150px\) { .topnav2 li {font-size: 13px;         }}
@media screen and \(max-width: 1100px\) { .topnav2 li {font-size: 12px;         }}
@media screen and \(max-width: 1075px\) { .topnav2 li {font-size: 11px;         }}
@media screen and \(max-width: 1010px\) { .topnav2 li {font-size: 10px;         }}
@media screen and \(max-width: 995px\) { .topnav2 li {font-size: 9px;         }}

  
  
  .alert-danger{color:#721c24;background-color:#f8d7da;border-color:#f5c6cb}
  .alert-danger hr{border-top-color:#f1b0b7}
  .alert-danger .alert-link{color:#491217}
  
  
  
  .alert-danger{color:#721c24;background-color:#f8d7da;border-color:#f5c6cb}
  .alert-danger hr{border-top-color:#f1b0b7}
  .alert-danger .alert-link{color:#491217}
  
```

### C:\AppServ\www\Bolsas\database\bolsas.sql
```plaintext
INSERT INTO \`costos\_operativos\` 
\('9 - ENERGÍA',             '10000.00',   '10000.00',   '10000.00',   '10000.00',   '10000.00',   '9309.16',    '8642.16',    '8860.53',    '9166.42',    '9166.42',    '9166.42',    '9166.42'     \);
INSERT INTO \`excedente\_repartible\_2023\` \(\`Legajo\`, \`Apellido\`, \`Nombre\`, \`Enero\`, \`Febrero\`, \`Marzo\`, \`Abril\`, \`Mayo\`, \`Junio\`, \`Julio\`, \`Agosto\`, \`Septiembre\`, \`Octubre\`, \`Noviembre\`\) VALUES
\(1456, 'Hogas', 'Mariana Soledad', '50232.00', '39222.00', '52244.00', '52244.28', '84344.38', '84738.89', '98939.16', NULL, NULL, '222724.00', '245340.00'\);
INSERT INTO \`ventas\` \(\`Nombre\`, \`Enero\`, \`Febrero\`, \`Marzo\`, \`Abril\`, \`Mayo\`, \`Junio\`, \`Julio\`, \`Agosto\`, \`Septiembre\`, \`Octubre\`, \`Noviembre\`, \`Diciembre\`\) VALUES
\('INGRESOS', '2112876.46', '1989044.00', '1753811.40', '1262354.29', '771333.00', '1116105.67', '2364639.00', '2603461.89', '4454292.25', '1678702.30', '2298153.00', '3535258.60'\);
```

### C:\AppServ\www\Bolsas\includes\chart.php
```plaintext
<\!--includes/chart.php-->
<\!DOCTYPE html>
<html>
<head>
    <title>Total Horas por Centro de Costo</title>
    <link rel="stylesheet" type="text/css" href="CSS/table\_styles.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load\('current', {'packages':\['corechart'\]}\);
        google.charts.setOnLoadCallback\(function\(\) {
            drawChart\(<?php echo $datosJson; ?>\);
        }\);
        function drawChart\(dataArray\) {
            var data = google.visualization.arrayToDataTable\(dataArray\);
            var options = {
                title: 'Total Horas por Centro de Costo',
                pieHole: 0.4, // Para un diseño de donut chart
                chartArea: { width: '100%', height: '80%' }, // Ajustar para responsividad
            };
            var chart = new google.visualization.PieChart\(document.getElementById\('piechart'\)\);
            chart.draw\(data, options\);
        }
    </script>
    <style> #piechart {
            margin-left: auto;
                margin-right: auto;
                width: 100%; 
                max-width: 900px;
                height: 500px; }

    </style>
</head>
<body>
    <div id="piechart" style="width: 100%; max-width: 900px; height: 500px;" role="img" aria-label="Gráfico circular mostrando las horas por centro de costo"></div>
</body>
</html>

```

### C:\AppServ\www\Bolsas\includes\conn.php
```plaintext
<\!-- includes/conn.php -->
<?php
$server = "localhost";
$usuario = "root";
$pass = "12345678";
$dbname = "bolsas"; 

define\('DB\_SERVER', 'localhost'\);
define\('DB\_USERNAME', 'root'\);
define\('DB\_PASSWORD', '12345678'\);
define\('DB\_NAME', 'registro\_stock'\);

?>

```

### C:\AppServ\www\Bolsas\includes\datos.php
```plaintext
<\!--datos.php-->
<?php
$data1 = \[ 
        \["Descripción" => "Papel marginal",         "Valor unitario" =>  "1026", "Unidad" => "$/kg",    "KPI" => "$peso", "Unidad KPI" => "Kg/bolsa"\],
        \["Descripción" => "Mano de obra marginal",  "Valor unitario" =>  "2000", "Unidad" => "$/hora",  "KPI" => "0.00833","Unidad KPI" => "horas/bolsa"\],
        \["Descripción" => "Energía marginal",       "Valor unitario" =>    "50", "Unidad" => "$/kWh",   "KPI" => "0.0012", "Unidad KPI" => "kWh/bolsa"\],
        \["Descripción" => "Gluer marginal",         "Valor unitario" =>     "0", "Unidad" => "$/kg",    "KPI" => "0",      "Unidad KPI" => "kg/bolsa"\]
    \];   

    $data2 = \[ 
        \["Descripción" => "Energía máquina",    "Valor unitario" =>  "50", "Unidad" => "$/kWh", "Potencia" => "252.4",  "Horas por día" => "24",              "Días por mes" => "30"\],
        \["Descripción" => "Energía Compresor",  "Valor unitario" =>  "50", "Unidad" => "$/kWh", "Potencia" => "400",    "Horas por día" => "8",               "Días por mes" => "20"\],
        \["Descripción" => "Energía Iluminación","Valor unitario" =>  "50", "Unidad" => "$/kWh", "Potencia" => "2200",   "Horas por día" => "16",              "Días por mes" => "20"\]
    \]; 
    $data3 = \[ 
        \["Descripción" => "Bolsas",    "Valor unitario" =>  "2800", "Unidad" => "$/M2", "Superficie" => "500"\],
        \["Descripción" => "Galpon 1",    "Valor unitario" =>  "2800", "Unidad" => "$/M2", "Superficie" => "100"\],
        \["Descripción" => "Galpon 2",    "Valor unitario" =>  "2800", "Unidad" => "$/M2", "Superficie" => "100"\]
    \];
    $data4 = \[ 
        \["Descripción" => "Coordinación",                   "Valor unitario" =>  "2000", "Unidad" => "$/h", "Horas" => "500"\],
        \["Descripción" => "Confeccion de bolsas",           "Valor unitario" =>  "2000", "Unidad" => "$/h", "Horas" => "100"\],
        \["Descripción" => "Confeccion y pegado de manijas", "Valor unitario" =>  "2000", "Unidad" => "$/h", "Horas" => "100"\],
        \["Descripción" => "Armado de pedidos",              "Valor unitario" =>  "2000", "Unidad" => "$/h", "Horas" => "100"\]
    \];
?>
```

### C:\AppServ\www\Bolsas\includes\db_functions.php
```plaintext
<\!--includes/db\_functions.php-->
<?php
require 'conn.php';

/\*\*
 \* Conectar a la base de datos.
 \*
 \* @return mysqli $conexion Objeto de conexión a la base de datos.
 \*/
function conectarBD\(\) {
    $conexion = mysqli\_connect\(DB\_SERVER, DB\_USERNAME, DB\_PASSWORD, DB\_NAME\);
    if \(\!$conexion\) {
        die\("Error en la conexión de la base de datos: " . mysqli\_connect\_error\(\)\);
    }
    return $conexion;
}

/\*\*
 \* Desconectar la conexión a la base de datos.
 \*
 \* @param mysqli $conexion Objeto de conexión a la base de datos.
 \*/
function desconectarBD\($conexion\) {
    if \(\!mysqli\_close\($conexion\)\) {
        die\("Error al desconectar la base de datos."\);
    }
}

/\*\*
 \* Obtener un array multidimensional con el resultado de la consulta SQL.
 \*
 \* @param string $sql La consulta SQL para ejecutar.
 \* @return array $rawdata Array asociativo con los resultados de la consulta.
 \*/
function getArraySQL\($sql\) {
    $conexion = conectarBD\(\);
    $result = mysqli\_query\($conexion, $sql\);

    if \(\!$result\) {
        die\("Error en la consulta SQL: " . mysqli\_error\($conexion\)\);
    }

    $rawdata = \[\];
    while \($row = mysqli\_fetch\_assoc\($result\)\) {
        $rawdata\[\] = $row;
    }

    desconectarBD\($conexion\);
    return $rawdata;
}
?>

```

### C:\AppServ\www\Bolsas\includes\GetData_0.php
```plaintext
<\!--includes/GetData\_0.php-->
<?php
require 'conn.php'; 

$conn = new mysqli\($server, $usuario, $pass, 'bolsas'\); 

if \($conn->connect\_error\) {
    die\("La conexión a la base de datos falló: " . $conn->connect\_error\);
}

$stmt = $conn->prepare\("SELECT Legajo, Apellido, Nombre, Enero, Febrero, Marzo, Abril, Mayo, Junio, Julio, Agosto, Septiembre, Octubre, Noviembre FROM excedente\_repartible\_2023"\);
$stmt->execute\(\);
$result = $stmt->get\_result\(\);

$data = \[\];
if \($result->num\_rows > 0\) {
    while\($row = $result->fetch\_assoc\(\)\) {
        $data\[\] = $row;
    }
}

$stmt->close\(\);
$conn->close\(\);

return $data;
?>

```

### C:\AppServ\www\Bolsas\includes\GetData_2.php
```plaintext
<\!--includes/GetData\_2.php-->
<?php
require 'conn.php'; 
$conn = new mysqli\($server, $usuario, $pass, 'bolsas'\); 

if \($conn->connect\_error\) {
    die\("La conexión a la base de datos falló: " . $conn->connect\_error\);
}

$stmt = $conn->prepare\("SELECT \* FROM costos\_operativos"\);
$stmt->execute\(\);
$result = $stmt->get\_result\(\);
$data = \[\];
$totales = array\_fill\_keys\(\['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'\], 0\);

if \($result->num\_rows > 0\) {
    while\($row = $result->fetch\_assoc\(\)\) {
        foreach \($row as $mes => $valor\) {
            if \($mes \!= 'Nombre' && $valor \!= NULL\) {
                $totales\[$mes\] += $valor;
            }
        }
        $data\[\] = $row;
    }
    $data\[\] = array\_merge\(\['Nombre' => 'Total'\], $totales\); // Añade los totales al final de $data
}

$stmt->close\(\);
$conn->close\(\);

return $data;
?>

```

### C:\AppServ\www\Bolsas\includes\GetData_3.php
```plaintext
<\!--includes/GetData\_2.php-->
<?php
require 'conn.php'; 
$conn = new mysqli\($server, $usuario, $pass, 'bolsas'\); 

if \($conn->connect\_error\) {
    die\("La conexión a la base de datos falló: " . $conn->connect\_error\);
}

$stmt = $conn->prepare\("SELECT \* FROM ventas"\);
$stmt->execute\(\);
$result = $stmt->get\_result\(\);
$data = \[\];
$totales = array\_fill\_keys\(\['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'\], 0\);

if \($result->num\_rows > 0\) {
    while\($row = $result->fetch\_assoc\(\)\) {
        foreach \($row as $mes => $valor\) {
            if \($mes \!= 'Nombre' && $valor \!= NULL\) {
                $totales\[$mes\] += $valor;
            }
        }
        $data\[\] = $row;
    }
    $data\[\] = array\_merge\(\['Nombre' => 'Total'\], $totales\); // Añade los totales al final de $data
}

$stmt->close\(\);
$conn->close\(\);

return $data;
?>

```

### C:\AppServ\www\Bolsas\includes\header.php
```plaintext
<?php 
//header.php

echo '<\!DOCTYPE html><html><head> <meta charset="UTF-8"> <link rel="stylesheet" type="text/css" href="CSS/index.css"> <link rel="stylesheet" type="text/css" href="CSS/header.css"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"> <link rel="icon" href="/imagenes/favicon.ico" type="image/x-icon"> </head><body>';
echo "<header> <br><br><br> <div class='topnav'> <ul>";

// Identificar la página actual
$paginaActual = basename\($\_SERVER\['PHP\_SELF'\]\);

// Clase para el enlace activo
$claseActiva = "class='active'";
echo "<li><a href='/Bolsas/index.php' ".\($paginaActual == 'Bolsas/index.php' ? $claseActiva : ""\).">Inicio</a></li>";
echo "<li><a href='/Bolsas/asociados.php' ".\($paginaActual == 'Bolsas/asociados.php' ? $claseActiva : ""\).">asociados</a></li>";
echo "<li><a href='/Bolsas/costos\_operativos.php' ".\($paginaActual == 'Bolsas/costos\_operativos.php' ? $claseActiva : ""\).">Costos Operativos</a></li>";
echo "<li><a href='/Bolsas/ventas.php' ".\($paginaActual == 'Bolsas/ventas.php' ? $claseActiva : ""\).">Ventas</a></li>";
echo "<li><a href='/Bolsas/stock.php' ".\($paginaActual == 'Bolsas/stock.php' ? $claseActiva : ""\).">Stock</a></li>";
echo "<li><a href='/Bolsas/lista\_precios.php' ".\($paginaActual == 'Bolsas/lista\_precios.php' ? $claseActiva : ""\).">Lista Precios</a></li>";
echo "<li><a href='/Bolsas/presupuesto.php?peso=' ".\($paginaActual == 'Bolsas/presupuesto.php?peso=' ? $claseActiva : ""\).">Presupuesto</a></li>";
echo "<li><a href='/horas/index.php' ".\($paginaActual == '/horas/index.php' ? $claseActiva : ""\).">Horas</a></li>";
echo "<li><a href='/DigiRail/index.php' ".\($paginaActual == '/DigiRail/index.php' ? $claseActiva : ""\).">DigiRail</a></li>";
echo "<li><a href='/phpMyAdmin/' target='\_blank'>PHP MyAdmin</a></li>";
echo "</ul></div></header>";






```

### C:\AppServ\www\Bolsas\Stock\busqueda.php
```plaintext
<\!--stock/busqueda.php-->
<?php
require "../includes/header.php";
require\_once 'conn.php';

// Obtener el valor de búsqueda
$ID\_formato = intval\($\_GET\['ID\_formato'\]\);

// Realizar la consulta de búsqueda
$query1 = "SELECT \* FROM tabla\_1 WHERE ID\_formato = $ID\_formato ";
$result1 = mysqli\_query\($conn, $query1\);
$query2 = "SELECT \* FROM tabla\_2 WHERE ID\_formato = $ID\_formato ";
$result2 = mysqli\_query\($conn, $query2\);
?>

<\!DOCTYPE html>
<html>
<head>
    <title>Búsqueda de Stock</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

    <div class='topnav2'>

    <ul>
        <li class="<?php echo \(basename\($\_SERVER\['PHP\_SELF'\]\) == '../stock.php'\)       ? 'active' : ''; ?>">   <a href='../stock.php'                                             >Ir a Stock    </a></li>
        <li class="<?php echo \(basename\($\_SERVER\['PHP\_SELF'\]\) == 'busqueda.php'\)    ? 'active' : ''; ?>">   <a href='busqueda.php?ID\_formato=   <?php echo $ID\_formato;?>'  >Búsqueda       </a></li>
        <li class="<?php echo \(basename\($\_SERVER\['PHP\_SELF'\]\) == 'ingreso.php'\)     ? 'active' : ''; ?>">   <a href='ingreso.php?ID\_formato=    <?php echo $ID\_formato;?>'  >Ingreso        </a></li>
        <li class="<?php echo \(basename\($\_SERVER\['PHP\_SELF'\]\) == 'egreso.php'\)      ? 'active' : ''; ?>">   <a href='egreso.php?ID\_formato=     <?php echo $ID\_formato;?>'  >Egreso         </a></li>
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
        <?php while \($row = mysqli\_fetch\_assoc\($result1\)\) { ?>
            <tr>
                <td><?php echo $row\['ID\_formato'\];  ?></td>
                <td><?php echo $row\['formato'\];     ?></td>
                <td><?php echo $row\['color'\];       ?></td>
                <td><?php echo $row\['gramaje'\];     ?></td>
                <td><?php echo $row\['cantidades'\];  ?></td>
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
        <?php while \($row = mysqli\_fetch\_assoc\($result2\)\) { ?>
            <tr>
                <td><?php echo $row\['papel'\];   ?></td>
                <td><?php echo $row\['fecha'\];   ?></td>
                <td><?php echo $row\['pedido'\];  ?></td>
                <td><?php echo $row\['detalle'\]; ?></td>
                <td><?php echo $row\['origen'\];  ?></td>
            </tr>
        <?php } ?>
    </table>

    <?php mysqli\_close\($conn\); ?>
</body>
</html>

```

### C:\AppServ\www\Bolsas\Stock\conn.php
```plaintext
<?php
$conn = mysqli\_connect\("localhost", "root", "12345678", "registro\_stock"\);

if \(\!$conn\) {
    die\("Error de conexión: " . mysqli\_connect\_error\(\)\);
}

```

### C:\AppServ\www\Bolsas\Stock\egreso.php
```plaintext
<\!-- ingreso.php -->
<\!DOCTYPE html>
<html>
<head>
    <title>Egreso de Stock</title>
    <link rel="stylesheet" href="style.css">
    <?php
        require\_once 'input.php';
    ?>
</head>
<body>

</body>
</html>

```

### C:\AppServ\www\Bolsas\Stock\filtroForm.php
```plaintext
<\!--Stock/filtroForm.php-->
<form action="stock.php" method="GET" id="filtroForm">
    <table>
        <tr>
            <th>Formato:</th>
            <th>Color:</th>
            <th>Gramaje:</th>
            <th>Listado precio Fecha:</th>
            <th>Listado precio Cantidades:</th>
            <th><input type="submit" value="Filtrar"></th>

        </tr>
        <tr>
            <td>
                <select name="Formato" onchange="submitForm\(\)">
                    <option value="todos" <?php echo $formatoFilter === 'todos' ? 'selected' : ''; ?>>Todos</option>
                    
                    <option value="12 X 08 X 19" <?php echo $formatoFilter === '12 X 08 X 19' ? 'selected' : ''; ?>>12 X 08 X 19</option>
                    <option value="12 X 08 X 26" <?php if \($formatoFilter === '12 X 08 X 26'\) echo 'selected'; ?>>12 x 08 x 26</option> 
                    <option value="12 X 08 X 40" <?php if \($formatoFilter === '12 X 08 X 40'\) echo 'selected'; ?>>12 x 08 x 40</option>

                    <option value="22 X 10 X 20" <?php echo $formatoFilter === '22 X 10 X 20' ? 'selected' : ''; ?>>22 X 10 X 20</option>
                    <option value="22 X 10 X 24" <?php if \($formatoFilter === '22 X 10 X 24'\) echo 'selected'; ?>>22 x 10 x 24</option>
                    <option value="22 X 10 X 30" <?php if \($formatoFilter === '22 X 10 X 30'\) echo 'selected'; ?>>22 x 10 x 30</option>
                    <option value="22 X 10 X 42" <?php if \($formatoFilter === '22 X 10 X 42'\) echo 'selected'; ?>>22 x 10 x 42</option>

                    <option value="26 X 12 X 36" <?php if \($formatoFilter === '26 X 12 X 36'\) echo 'selected'; ?>>26 x 12 x 36</option>
                    <option value="26 X 12 X 41" <?php if \($formatoFilter === '26 X 12 X 41'\) echo 'selected'; ?>>26 x 12 x 41</option>

                    <option value="28 X 12 X 41" <?php if \($formatoFilter === '28 X 12 X 41'\) echo 'selected'; ?>>28 x 12 x 41</option>
                    <option value="28 X 16 X 38" <?php if \($formatoFilter === '28 X 16 X 38'\) echo 'selected'; ?>>28 x 16 x 38</option>

                    <option value="30 X 12 X 32" <?php if \($formatoFilter === '30 X 12 X 32'\) echo 'selected'; ?>>30 x 12 x 32</option>
                    <option value="30 X 12 X 41" <?php if \($formatoFilter === '30 X 12 X 41'\) echo 'selected'; ?>>30 x 12 x 41</option>
                    <option value="30 X 16 X 43" <?php if \($formatoFilter === '30 X 16 X 43'\) echo 'selected'; ?>>30 x 16 x 43</option>
                </select>
            </td>
            <td>
                <select name="color" onchange="submitForm\(\)" value="sda">
                    <option value="todos" <?php echo $colorFilter === 'todos' ? 'selected' : ''; ?>>Todos</option>
                    <option value="Marrón" <?php echo $colorFilter === 'Marrón' ? 'selected' : ''; ?>>Marrón</option>
                    <option value="Blanco" <?php echo $colorFilter === 'Blanco' ? 'selected' : ''; ?>>Blanco</option>
                </select>
            </td>
            <td>
                <select name="gramaje" onchange="submitForm\(\)">
                    <option value="todos" <?php echo $gramajeFilter === 'todos' ? 'selected' : ''; ?>>Todos</option>
                    <option value="80" <?php echo $gramajeFilter === '80' ? 'selected' : ''; ?>>80</option>
                    <option value="100" <?php echo $gramajeFilter === '100' ? 'selected' : ''; ?>>100</option>
                </select>
            </td>
            <td>
            <select name="fechaSeleccionada"  onchange="submitForm\(\)">
                <?php foreach \($fechas as $fecha\) {
                    echo '<option value="'.$fecha\['fecha\_listado'\].'">'.$fecha\['fecha\_listado'\].'</option>';} ?>
            </select>
            </td>      
            <td>
                <select name="cantidades" onchange="submitForm\(\)">
                    <option value="5000" >5000</option>
                    <option value="10000" >10000</option>
                </select>
            </td>      
        </tr>

        <td><?php echo strval\($filtros\['formatoFilter'\]\); ?></td>
        <td><?php echo strval\($filtros\['colorFilter'\]\); ?></td>
        <td><?php echo strval\($filtros\['gramajeFilter'\]\); ?></td>
        <td><?php echo strval\($filtros\['fechaListadoFilter'\]\); ?></td>
        <td><?php echo strval\($filtros\['cantidadSeleccionada'\]\); ?></td>
        <tr>
        </tr>
    </table>
    
</form>
```

### C:\AppServ\www\Bolsas\Stock\ingreso.php
```plaintext
<\!-- ingreso.php -->
<\!DOCTYPE html>
<html>
<head>
    <title>Ingreso de Stock</title>
    <link rel="stylesheet" href="style.css">
    <?php
        require\_once 'input.php';
    ?>
</head>
<body>

</body>
</html>

```

### C:\AppServ\www\Bolsas\Stock\input.php
```plaintext
<\!-- ingreso.php -->
<\!DOCTYPE html>
<html>
<head>
    <title>Ingreso de Stock</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <?php
    require "../includes/header.php";

    require\_once 'conn.php';

    // Obtener el valor de ID desde la URL
    $ID\_formato = $\_GET\['ID\_formato'\];

    // Realizar la consulta para obtener los datos del registro correspondiente
    $query  = "SELECT \* FROM tabla\_1 WHERE ID\_formato = $ID\_formato";
    $result = mysqli\_query\($conn, $query\);
    $row    = mysqli\_fetch\_assoc\($result\);

    // Verificar si se encontró un registro con el ID especificado
    if \($row\) {
        $formato    = $row\['formato'\];
        $color      = $row\['color'  \];
        $gramaje    = $row\['gramaje'\];
    } else {
        // Si no se encuentra un registro, se establecen valores predeterminados
        $formato    = "";
        $color      = "";
        $gramaje    = "";
    }

    mysqli\_close\($conn\);
    ?>
</head>
<body>
<div class='topnav2'>
    <ul>
        <li class="<?php echo \(basename\($\_SERVER\['PHP\_SELF'\]\) == '../stock.php'\)       ? 'active' : ''; ?>">   <a href='../stock.php'                                             >Ir a Stock    </a></li>
        <li class="<?php echo \(basename\($\_SERVER\['PHP\_SELF'\]\) == 'busqueda.php'\)    ? 'active' : ''; ?>">   <a href='busqueda.php?ID\_formato=   <?php echo $ID\_formato;?>'  >Búsqueda       </a></li>
        <li class="<?php echo \(basename\($\_SERVER\['PHP\_SELF'\]\) == 'ingreso.php'\)     ? 'active' : ''; ?>">   <a href='ingreso.php?ID\_formato=    <?php echo $ID\_formato;?>'  >Ingreso        </a></li>
        <li class="<?php echo \(basename\($\_SERVER\['PHP\_SELF'\]\) == 'egreso.php'\)      ? 'active' : ''; ?>">   <a href='egreso.php?ID\_formato=     <?php echo $ID\_formato;?>'  >Egreso         </a></li>
    </ul>
</div>

    <h1>Ingreso de Stock</h1>

    <form action="procesar.php" method="GET">
        <table>
            <tr>
                <td><label for="ID\_formato" >ID\_formato:    </label></td>
                <td><label for="formato"    >Formato:       </label></td>
                <td><label for="color"      >Color:         </label></td>
                <td><label for="gramaje"    >Gramaje:       </label></td>                
            </tr>
            <tr>
                <td><input type="text" id="ID\_formato"          name="ID\_formato"       value="<?php echo $ID\_formato;      ?>" readonly></td>
                <td><input type="text" id="formato"     name="formato"  value="<?php echo $formato; ?>" readonly></td>
                <td><input type="text" id="color"       name="color"    value="<?php echo $color;   ?>" readonly></td>
                <td><input type="text" id="gramaje"     name="gramaje"  value="<?php echo $gramaje; ?>" readonly></td>
            </tr>
            
        </table>
        <table>
            <tr>
                <th>ID\_Formato               </th>
                <th><input type="text" name="ID\_formato" id="ID\_formato" value=<?php echo $ID\_formato; ?> readonly></th>
            </tr>
            <tr>
                <th>Papel               </th>
                <th><select name="papel">
                        <option value="Kraft">Kraft</option>
                        <option value="Obra">Obra</option>
                        <option value="Couché">Couché</option>
                        <option value="Couché Mate">Couché Mate</option>
                        <option value="Superacalandrado">Superacalandrado</option>
                        <option value="LWC">LWC</option>
                        <option value="Diario mejorado">Diario mejorado</option>
                    </select>
                </th>
            </tr>
            <tr>
                <th>fecha               </th>                
                <th><input type="date" name="fecha" id="fecha" value = "0" ></th>
            </tr>
            <tr>
                <th>pedido              </th>                
                <th><input type="number" name="pedido" id="pedido" value = "0" ></th>
            </tr>
            <tr>
                <th>detalle             </th>                
                <th><input type="text" name="detalle" id="detalle" value = "0" ></th>
            </tr>
            <tr>
                <th>origen              </th>                
                <th><input type="text" name="origen" id="origen" value = "0" ></th>
            </tr>
            <tr>
                <th>ingreso             </th>                
                <th><input type="text" name="ingreso" id="ingreso" value = "0" ></th>
            </tr>
            <tr>
                <th>egreso              </th>                
                <th><input type="text" name="egreso" id="egreso" value = "0" ></th>
            </tr>
            <tr>
                <th>saldo               </th>                
                <th><input type="text" name="saldo" id="saldo" value = "0" ></th>
            </tr>
            <tr>
                <th>destino	sobrante    </th>                
                <th><input type="text" name="destino\_sobrante" id="destino\_sobrante" value = "0" ></th>
            </tr>
            <tr>
                <th>facturado           </th>                
                <th><input type="text" name="facturado" id="facturado" value = "0" ></th>
            </tr>
            <tr>
                <th>entregado           </th>                
                <th><input type="text" name="entregado" id="entregado" value = "0" ></th>
            </tr>
            <tr>
                <th>remito              </th>                
                <th><input type="text" name="remito" id="remito" value = "0" ></th>
            </tr>
            <tr>
                <th>sobreconsumo        </th>                
                <th><input type="text" name="sobreconsumo" id="sobreconsumo" value = "0" ></th>
            </tr>
            <tr>
                <th>lote                </th>                
                <th><input type="text" name="lote" id="lote" value = "0" ></th>
            </tr>
        </table>

        <input type="submit" name="add" value="Ingresar">
    </form>
</body>
</html>

```

### C:\AppServ\www\Bolsas\Stock\procesar.php
```plaintext
<\!-- procesar.php -->
<?php
require\_once 'conn.php';

// Manejar la adición de stock
if \(isset\($\_GET\['add'\]\)\) {
    $ID\_formato     = $\_GET\['ID\_formato'    \];
    $papel          = $\_GET\['papel'         \];
    $fecha          = $\_GET\['fecha'         \];
    $pedido         = $\_GET\['pedido'        \];
    $detalle        = $\_GET\['detalle'       \];
    $origen         = $\_GET\['origen'        \];
    $ingreso        = $\_GET\['ingreso'       \];
    $egreso         = $\_GET\['egreso'        \];
    $saldo          = $\_GET\['saldo'         \];
    $destino\_sobrante = $\_GET\['destino\_sobrante'\];
    $facturado      = $\_GET\['facturado'     \];
    $entregado      = $\_GET\['entregado'     \];
    $remito         = $\_GET\['remito'        \];
    $sobreconsumo   = $\_GET\['sobreconsumo'  \];
    $lote           = $\_GET\['lote'          \];

    // Resto de campos aquí...

    $query = "INSERT INTO \`tabla\_2\` \(\`ID\_formato\`, \`papel\`,  \`fecha\`, \`pedido\`, \`detalle\`, \`origen\`, \`ingreso\`, \`egreso\`, \`saldo\`, \`destino\_sobrante\`, \`facturado\`, \`entregado\`, \`remito\`, \`sobreconsumo\`, \`lote\`\)
              VALUES \('$ID\_formato', '$papel', '$fecha', '$pedido', '$detalle', '$origen', '$ingreso', '$egreso', '$saldo', '$destino\_sobrante', '$facturado', '$entregado', '$remito', '$sobreconsumo', '$lote'\)";
    mysqli\_query\($conn, $query\);
    echo  $query;
    //header\("Location: index.php"\);
    exit;
}
?>

```

### C:\AppServ\www\Bolsas\Stock\registro_stock.sql
```plaintext
INSERT INTO \`listado\_precios\` \(\`ID\_listado\`, \`ID\_formato\`, \`cantidad\`, \`precio\_u\_sIVA\`, \`fecha\_listado\`\) VALUES
\(66, 99, 10000, '0',      '2024-02-01'\);
INSERT INTO \`tabla\_1\` \(\`ID\_formato\`, \`formato\`, \`ancho\`, \`fuelle\`, \`alto\`, \`color\`, \`gramaje\`, \`cantidades\`, \`manijas\`\) VALUES
\(99, '12 X 08 X 26',  '12','08','26',   'MARRON', 100, 1295,  b'0'\);
INSERT INTO \`tabla\_2\` \(\`ID\_registro\`, \`ID\_formato\`, \`papel\`, \`fecha\`, \`pedido\`, \`detalle\`, \`origen\`, \`ingreso\`, \`egreso\`, \`saldo\`, \`destino\_sobrante\`, \`sobrante\`, \`facturado\`, \`entregado\`, \`remito\`, \`sobreconsumo\`, \`lote\`\) VALUES
\(3, 10, 'Kraft', '2024-01-23', 0, '0', 0, 5000, 0, 0, 0, 0, 0, 0, 0, 0, 0\);
```

### C:\AppServ\www\Bolsas\Stock\stockFunctions.php
```plaintext
<\!--Stock/stockFunctions.php-->
<?php
require\_once 'conn.php';

/\*\*
 \* Obtiene datos de stock filtrados por formato, color, gramaje, y cantidad seleccionada.
 \*
 \* @param string $formatoFilter Filtro para el formato, 'todos' para no aplicar filtro.
 \* @param string $colorFilter Filtro para el color, 'todos' para no aplicar filtro.
 \* @param string $gramajeFilter Filtro para el gramaje, 'todos' para no aplicar filtro.
 \* @param string $cantidadSeleccionada Filtro para la cantidad seleccionada, 'todos' para no aplicar filtro.
 \* @return array Resultados de la consulta como un array asociativo.
 \*/
function obtenerDatosStock\($formatoFilter, $colorFilter, $gramajeFilter, $cantidadSeleccionada, $fechaListadoFilter\) {
    $conexion = conectarBD\(\); // Asume conectarBD\(\) devuelve una conexión mysqli válida

    // Inicia el query base
    $query = "SELECT t1.\*, t2.precio\_u\_sIVA, t2.fecha\_listado, t2.cantidad FROM tabla\_1 t1
              LEFT JOIN listado\_precios t2 ON t1.ID\_formato = t2.ID\_formato";

    // Arrays para condiciones SQL y sus parámetros
    $conditions = \[\];
    $params = \[\];

    // Agrega condiciones basadas en los filtros
    if \($formatoFilter \!== 'todos'\) {
        $conditions\[\] = "t1.formato = ?";
        $params\[\] = $formatoFilter;
    }
    if \($colorFilter \!== 'todos'\) {
        $conditions\[\] = "t1.color = ?";
        $params\[\] = $colorFilter;
    }
    if \($gramajeFilter \!== 'todos'\) {
        $conditions\[\] = "t1.gramaje = ?";
        $params\[\] = $gramajeFilter;
    }
    if \(\!empty\($cantidadSeleccionada\) && $cantidadSeleccionada \!= 'todos'\) {
        $conditions\[\] = "t2.cantidad = ?";
        $params\[\] = $cantidadSeleccionada;
    }
    if \($fechaListadoFilter \!== 'todos'\) { // Nueva condición para filtrar por fecha de listado
        $conditions\[\] = "t2.fecha\_listado = ?";
        $params\[\] = $fechaListadoFilter;
    }

    // Combina las condiciones en el query si existen
    if \(\!empty\($conditions\)\) {
        $query .= " WHERE " . implode\(" AND ", $conditions\);
    }

    // Ordena los resultados
    $query .= " ORDER BY t1.cantidades DESC";

    //echo "<br><br><br>query=<br>$query<br><br>";

    // Prepara y ejecuta la consulta
    $stmt = $conexion->prepare\($query\);
    if \(\!$stmt\) {
        die\("Error al preparar la consulta: " . $conexion->error\);
    }

    if \(\!empty\($params\)\) {
        $stmt->bind\_param\(str\_repeat\("s", count\($params\)\), ...$params\);
    }

    $stmt->execute\(\);
    $result = $stmt->get\_result\(\);
    $data = \[\];
    while \($row = $result->fetch\_assoc\(\)\) {
        $data\[\] = $row;
    }

    $stmt->close\(\);
    desconectarBD\($conexion\);

    return $data;
}

```
