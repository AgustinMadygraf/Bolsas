<!--Bolsas/includes/datos.php-->
<?php
require 'includes/conn_bolsas.php';
include 'includes/db_functions.php'; 

$KPI_ManoObra = $Trabajadores /($vel * 60);

function obtenerDatosValorUnitario() {
    $sql = "SELECT * FROM valor_unitario";
    $resultados = getArraySQL($sql);
    
    $data = [];
    $data = $resultados;

    return $resultados;
}

$data1_aux = obtenerDatosValorUnitario();
//print_r($data1_aux); //Array ( [0] => Array ( [ID] => 1 [Concepto] => Papel [Unidad] => $/Kg [Valor] => 1026.00 [Fecha] => 2024-02-15 ) [1] => Array ( [ID] => 2 [Concepto] => Mano de Obra [Unidad] => $/h [Valor] => 4000.00 [Fecha] => 2024-02-15 ) [2] => Array ( [ID] => 3 [Concepto] => Energía [Unidad] => $/kWh [Valor] => 50.00 [Fecha] => 2024-02-15 ) [3] => Array ( [ID] => 4 [Concepto] => Gluer [Unidad] => $/Kg [Valor] => 0.00 [Fecha] => 2024-02-15 ) )
$val_unit_mano_obra = $data1_aux[1]['Valor'];
$val_unit_papel     = $data1_aux[0]['Valor'];
$valor_unit_energia = $data1_aux[2]['Valor'];
$valor_unit_gluer   = $data1_aux[3]['Valor'];

$data1 = [ 
["Descripción" => "Papel",                      "Valor unitario"                =>  "$val_unit_papel",      "Unidad"    => "$/kg",  "KPI" => "$peso",           "Unidad KPI" => "Kg/bolsa"  ],
["Descripción" => "Mano de obra ($Trabajadores personas)",  "Valor unitario"    =>  "$val_unit_mano_obra",  "Unidad"    => "$/hora","KPI" => "$KPI_ManoObra",   "Unidad KPI" => "horas/bolsa"],
["Descripción" => "Energía",                    "Valor unitario"                =>  "$valor_unit_energia",  "Unidad"    => "$/kWh", "KPI" => "0.0012",          "Unidad KPI" => "kWh/bolsa" ],
["Descripción" => "Gluer",                      "Valor unitario"                =>  "$valor_unit_gluer",    "Unidad"    => "$/kg",  "KPI" => "0",               "Unidad KPI" => "kg/bolsa"  ]
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