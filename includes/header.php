<?php 
//header.php

echo '<!DOCTYPE html><html><head> <meta charset="UTF-8"> <link rel="stylesheet" type="text/css" href="CSS/index.css"> <link rel="stylesheet" type="text/css" href="CSS/header.css"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"> <link rel="icon" href="/imagenes/favicon.ico" type="image/x-icon"> </head><body>';
echo "<header> <br><br><br> <div class='topnav'> <ul>";

// Identificar la página actual
$paginaActual = basename($_SERVER['PHP_SELF']);

// Clase para el enlace activo
$claseActiva = "class='active'";
echo "<li><a href='/Bolsas/index.php' ".($paginaActual == 'Bolsas/index.php' ? $claseActiva : "").">Inicio</a></li>";
echo "<li><a href='/Bolsas/asociados.php' ".($paginaActual == 'Bolsas/asociados.php' ? $claseActiva : "").">asociados</a></li>";
echo "<li><a href='/Bolsas/costos_operativos.php' ".($paginaActual == 'Bolsas/costos_operativos.php' ? $claseActiva : "").">Costos Operativos</a></li>";
echo "<li><a href='/Bolsas/ventas.php' ".($paginaActual == 'Bolsas/ventas.php' ? $claseActiva : "").">Ventas</a></li>";
echo "<li><a href='/Bolsas/stock.php' ".($paginaActual == 'Bolsas/stock.php' ? $claseActiva : "").">Stock</a></li>";
echo "<li><a href='/Bolsas/lista_precios.php' ".($paginaActual == 'Bolsas/lista_precios.php' ? $claseActiva : "").">Lista Precios</a></li>";
echo "<li><a href='/Bolsas/manijas.php' ".($paginaActual == 'Bolsas/manijas.php' ? $claseActiva : "").">Manijas</a></li>";
echo "<li><a href='/Bolsas/valor_unitario.php' ".($paginaActual == 'Bolsas/valor_unitario.php' ? $claseActiva : "").">Valor Unitario</a></li>";
echo "<li><a href='/Bolsas/presupuesto.php?peso=' ".($paginaActual == 'Bolsas/presupuesto.php?peso=' ? $claseActiva : "").">Presupuesto</a></li>";
echo "<li><a href='/Bolsas/proveedores.php' ".($paginaActual == 'Bolsas/proveedores.php' ? $claseActiva : "").">Proveedores</a></li>";
echo "<li><a href='/horas/index.php' ".($paginaActual == '/horas/index.php' ? $claseActiva : "").">Horas</a></li>";
echo "<li><a href='/DataMaq/index.php' ".($paginaActual == '/DataMaq/index.php' ? $claseActiva : "").">DataMaq</a></li>";
echo "<li><a href='/phpMyAdmin/' target='_blank'>PHP MyAdmin</a></li>";
echo "</ul></div></header>";