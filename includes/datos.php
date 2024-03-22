<!--Bolsas/includes/datos.php-->
<?php
require 'includes/conn_bolsas.php';
include 'includes/db_functions.php'; 

$KPI_ManoObra = $Trabajadores /($vel * 60);

function obtenerDatosValorUnitario() {
    $sql = "SELECT * FROM valor_unitario";
    $resultados = getArraySQL($sql);
    
    $data = [];
    foreach ($resultados as $fila) {
        $descripcion = $fila['Concepto']; // Modificar según sea necesario
        $valorUnitario = $fila['Valor']; // Modificar según sea necesario
        $fecha = $fila['Fecha']; // Modificar según sea necesario

        // Aquí puedes adaptar cómo quieres usar los datos de cada fila
        // Por ejemplo, si quieres incluir lógica específica basada en el Concepto
        if ($descripcion == "Papel") {
            $KPI = "EjemploKPI"; // Define cómo calcular o extraer este valor
            $data[] = [
                "Descripción" => $descripcion,
                "Valor unitario" => $valorUnitario,
                "Unidad" => "$/kg", // Asume que todos son $/kg, ajusta según sea necesario
                "KPI" => $KPI,
                "Unidad KPI" => "Kg/bolsa" // Asume un valor común, ajusta según sea necesario
            ];
        }
    }
    //echo "<br>". var_dump($data). "<br>"; //array(1) { [0]=> array(5) { ["Descripción"]=> string(5) "Papel" ["Valor unitario"]=> string(7) "1026.00" ["Unidad"]=> string(4) "$/kg" ["KPI"]=> string(10) "EjemploKPI" ["Unidad KPI"]=> string(8) "Kg/bolsa" } }

    
    return $data;
}

$data1_aux = obtenerDatosValorUnitario();

$val_unit_papel = $data1_aux[0]["Valor unitario"];

$data1 = [ 
["Descripción" => "Papel",                      "Valor unitario" =>  "$val_unit_papel", "Unidad" => "$/kg",    "KPI" => "$peso",           "Unidad KPI" => "Kg/bolsa"  ],
["Descripción" => "Mano de obra ($Trabajadores personas)",  "Valor unitario" =>  "2000", "Unidad" => "$/hora",  "KPI" => "$KPI_ManoObra",   "Unidad KPI" => "horas/bolsa"],
["Descripción" => "Energía",                    "Valor unitario" =>    "50", "Unidad" => "$/kWh",   "KPI" => "0.0012",          "Unidad KPI" => "kWh/bolsa" ],
["Descripción" => "Gluer",                      "Valor unitario" =>     "0", "Unidad" => "$/kg",    "KPI" => "0",               "Unidad KPI" => "kg/bolsa"  ]
    ];   



    $data2 = [ 
        ["Descripción" => "Energía máquina",    "Valor unitario" =>  "50", "Unidad" => "$/kWh", "Potencia" => "252.4",  "Horas por día" => "24",              "Días por mes" => "30"],
        ["Descripción" => "Energía Compresor",  "Valor unitario" =>  "50", "Unidad" => "$/kWh", "Potencia" => "400",    "Horas por día" => "8",               "Días por mes" => "20"],
        ["Descripción" => "Energía Iluminación","Valor unitario" =>  "50", "Unidad" => "$/kWh", "Potencia" => "2200",   "Horas por día" => "16",              "Días por mes" => "20"]
    ]; 
    $data3 = [ 
        ["Descripción" => "Bolsas",    "Valor unitario" =>  "2800", "Unidad" => "$/M2", "Superficie" => "500"],
        ["Descripción" => "Galpon 1",    "Valor unitario" =>  "2800", "Unidad" => "$/M2", "Superficie" => "100"],
        ["Descripción" => "Galpon 2",    "Valor unitario" =>  "2800", "Unidad" => "$/M2", "Superficie" => "100"]
    ];
    $data4 = [ 
        ["Descripción" => "Coordinación",                   "Valor unitario" =>  "2000", "Unidad" => "$/h", "Horas" => "500"],
        ["Descripción" => "Confeccion de bolsas",           "Valor unitario" =>  "2000", "Unidad" => "$/h", "Horas" => "100"],
        ["Descripción" => "Confeccion y pegado de manijas", "Valor unitario" =>  "2000", "Unidad" => "$/h", "Horas" => "100"],
        ["Descripción" => "Armado de pedidos",              "Valor unitario" =>  "2000", "Unidad" => "$/h", "Horas" => "100"]
    ];
?>