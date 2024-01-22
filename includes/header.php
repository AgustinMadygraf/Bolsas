<?php 
//header.php

echo '<!DOCTYPE html><html><head> <meta charset="UTF-8"> <link rel="stylesheet" type="text/css" href="CSS/index.css"> <link rel="stylesheet" type="text/css" href="CSS/header.css"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"> <link rel="icon" href="/imagenes/favicon.ico" type="image/x-icon"> </head><body>';
echo "<header> <br><br><br> <div class='topnav'> <ul>";

// Identificar la página actual
$paginaActual = basename($_SERVER['PHP_SELF']);

// Clase para el enlace activo
$claseActiva = "class='active'";

echo "<li><a href='index.php' ".($paginaActual == 'index.php' ? $claseActiva : "").">Inicio</a></li>";
echo "<li><a href='asociados.php' ".($paginaActual == 'asociados.php' ? $claseActiva : "").">asociados</a></li>";
echo "<li><a href='costos_operativos.php' ".($paginaActual == 'costos_operativos.php' ? $claseActiva : "").">Costos Operativos</a></li>";
echo "<li><a href='ingresos.php' ".($paginaActual == 'ingresos.php' ? $claseActiva : "").">ingresos</a></li>";
echo "<li><a href='/phpMyAdmin/' target='_blank'>PHP MyAdmin</a></li>";

echo "</ul></div></header>";


