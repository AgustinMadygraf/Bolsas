<!-- ingreso.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Ingreso de Stock</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <?php
    require "../includes/header.php";

    require_once 'conn.php';

    // Obtener el valor de ID desde la URL
    $ID_formato = $_GET['ID_formato'];

    // Realizar la consulta para obtener los datos del registro correspondiente
    $query  = "SELECT * FROM tabla_1 WHERE ID_formato = $ID_formato";
    $result = mysqli_query($conn, $query);
    $row    = mysqli_fetch_assoc($result);

    // Verificar si se encontró un registro con el ID especificado
    if ($row) {
        $formato    = $row['formato'];
        $color      = $row['color'  ];
        $gramaje    = $row['gramaje'];
    } else {
        // Si no se encuentra un registro, se establecen valores predeterminados
        $formato    = "";
        $color      = "";
        $gramaje    = "";
    }

    mysqli_close($conn);
    ?>
</head>
<body>
<div class='topnav2'>
    <ul>
        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == '../stock.php')       ? 'active' : ''; ?>">   <a href='../stock.php'                                             >Ir a Stock    </a></li>
        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'busqueda.php')    ? 'active' : ''; ?>">   <a href='busqueda.php?ID_formato=   <?php echo $ID_formato;?>'  >Búsqueda       </a></li>
        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'ingreso.php')     ? 'active' : ''; ?>">   <a href='ingreso.php?ID_formato=    <?php echo $ID_formato;?>'  >Ingreso        </a></li>
        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'egreso.php')      ? 'active' : ''; ?>">   <a href='egreso.php?ID_formato=     <?php echo $ID_formato;?>'  >Egreso         </a></li>
    </ul>
</div>

    <h1>Ingreso de Stock</h1>

    <form action="procesar.php" method="GET">
        <table>
            <tr>
                <td><label for="ID_formato" >ID_formato:    </label></td>
                <td><label for="formato"    >Formato:       </label></td>
                <td><label for="color"      >Color:         </label></td>
                <td><label for="gramaje"    >Gramaje:       </label></td>                
            </tr>
            <tr>
                <td><input type="text" id="ID_formato"          name="ID_formato"       value="<?php echo $ID_formato;      ?>" readonly></td>
                <td><input type="text" id="formato"     name="formato"  value="<?php echo $formato; ?>" readonly></td>
                <td><input type="text" id="color"       name="color"    value="<?php echo $color;   ?>" readonly></td>
                <td><input type="text" id="gramaje"     name="gramaje"  value="<?php echo $gramaje; ?>" readonly></td>
            </tr>
            
        </table>
        <table>
            <tr>
                <th>ID_Formato               </th>
                <th><input type="text" name="ID_formato" id="ID_formato" value=<?php echo $ID_formato; ?> readonly></th>
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
                <th><input type="text" name="destino_sobrante" id="destino_sobrante" value = "0" ></th>
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
