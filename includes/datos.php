<!--DataMaq/datos.php-->
<?php

$KPI_ManoObra = $Trabajadores /($vel * 60);
//$KPI_ManoObra = 0.00833;
$data1 = [ 
["Descripción" => "Papel",                      "Valor unitario" =>  "1026", "Unidad" => "$/kg",    "KPI" => "$peso",           "Unidad KPI" => "Kg/bolsa"  ],
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