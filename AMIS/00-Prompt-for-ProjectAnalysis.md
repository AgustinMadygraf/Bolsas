
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
    bolsas.sql
    index.php
    AMIS/
        00-Prompt-for-ProjectAnalysis.md
```


## Contenido de Archivos Seleccionados

### C:\AppServ\www\Bolsas\bolsas.sql
```plaintext
INSERT INTO \`excedente\_repartible\_2023\` \(\`Legajo\`, \`Apellido\`, \`Nombre\`, \`Enero\`, \`Febrero\`, \`Marzo\`, \`Abril\`, \`Mayo\`, \`Junio\`, \`Julio\`, \`Agosto\`, \`Septiembre\`, \`Octubre\`, \`Noviembre\`\) VALUES
\(1456, 'Hogas', 'Mariana Soledad', '50232.00', '39222.00', '52244.00', '52244.28', '84344.38', '84738.89', '98939.16', NULL, NULL, '222724.00', '245340.00'\);
```

### C:\AppServ\www\Bolsas\index.php
```plaintext
<\!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Empleados</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Tabla de Asociados en bolsas</h1>
    <?php
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "12345678";
    $dbname = "bolsas";

    $conn = new mysqli\($servername, $username, $password, $dbname\);

    if \($conn->connect\_error\) {
        die\("La conexión a la base de datos falló: " . $conn->connect\_error\);
    }

    // Consulta SQL para obtener los datos de la tabla
    $sql = "SELECT \* FROM excedente\_repartible\_2023";
    $result = $conn->query\($sql\);

    if \($result->num\_rows > 0\) {
        echo "<table>";
        echo "<tr><th>Legajo</th><th>Apellido</th><th>Nombre</th><th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th><th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th></tr>";
        
        while\($row = $result->fetch\_assoc\(\)\) {
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
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron registros en la tabla.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close\(\);
    ?>
</body>
</html>

```
