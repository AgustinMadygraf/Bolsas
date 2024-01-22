
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
    AMIS/
        00-Prompt-for-ProjectAnalysis.md
    CSS/
        style.css
    database/
        bolsas.sql
    includes/
        conn.php
        GetData.php
        header.php
```


## Contenido de Archivos Seleccionados

### C:\AppServ\www\Bolsas\asociados.php
```plaintext
<\!--asociados.php-->
<\!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Asociados</title>
    <link rel="stylesheet" href="CSS/style.css"> 
</head>
<body>
    <h1>Tabla de Asociados en bolsas</h1>
    <?php
        $data = include\('includes/GetData.php'\); // Inclusión de los datos

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

```

### C:\AppServ\www\Bolsas\database\bolsas.sql
```plaintext
INSERT INTO \`costos\_operativos\` \(\`Nombre\`, \`Enero\`, \`Febrero\`, \`Marzo\`, \`Abril\`, \`Mayo\`, \`Junio\`, \`Julio\`, \`Agosto\`, \`Septiembre\`, \`Octubre\`, \`Noviembre\`, \`Diciembre\`\) VALUES
\('RETIRO ASOCIADOS', '838234.00', '969355.00', '988284.00', '988285.81', '1530631.94', '1327002.56', '1632309.79', '377025.98', '473667.01', '3852074.00', '3998004.00', '5808000.00'\);
INSERT INTO \`excedente\_repartible\_2023\` \(\`Legajo\`, \`Apellido\`, \`Nombre\`, \`Enero\`, \`Febrero\`, \`Marzo\`, \`Abril\`, \`Mayo\`, \`Junio\`, \`Julio\`, \`Agosto\`, \`Septiembre\`, \`Octubre\`, \`Noviembre\`\) VALUES
\(1456, 'Hogas', 'Mariana Soledad', '50232.00', '39222.00', '52244.00', '52244.28', '84344.38', '84738.89', '98939.16', NULL, NULL, '222724.00', '245340.00'\);
```

### C:\AppServ\www\Bolsas\includes\conn.php
```plaintext
<\!-- includes/conn.php -->
<?php
$server = "localhost";
$usuario = "root";
$pass = "12345678";
$dbname = "bolsas"; // Incluye el nombre de la base de datos
?>

```

### C:\AppServ\www\Bolsas\includes\GetData.php
```plaintext
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

echo "<li><a href='index.php' ".\($paginaActual == 'index.php' ? $claseActiva : ""\).">Inicio</a></li>";
echo "<li><a href='PanelControlModbus.php' ".\($paginaActual == 'PanelControlModbus.php' ? $claseActiva : ""\).">Estado del Equipo</a></li>";
echo "<li><a href='/phpMyAdmin/' target='\_blank'>PHP MyAdmin</a></li>";

echo "</ul></div></header>";

```
