<?php
$data = [ 
        ["Descripción" => "Papel marginal",         "Valor unitario" =>  "1026", "Unidad" => "$/kg",    "KPI" => "0.0174",               "Unidad KPI" => "Kg/bolsa"],
        ["Descripción" => "Mano de obra marginal",  "Valor unitario" =>  "2000", "Unidad" => "$/hora",  "KPI" => "0.00833",             "Unidad KPI" => "horas/bolsa"],
        ["Descripción" => "Energía marginal",       "Valor unitario" =>    "50", "Unidad" => "$/kWh",   "KPI" => "0.0011979386792453",  "Unidad KPI" => "kWh/bolsa"],
        ["Descripción" => "Gluer marginal",         "Valor unitario" =>     "0", "Unidad" => "$/kg",    "KPI" => "0",                   "Unidad KPI" => "kg/bolsa"]
    ];   
    visualizarTabla($data);

    echo "<h2>Costo fijo - Electrico</h2>";
    $data2 = [ 
        ["Descripción" => "Energía máquina",    "Valor unitario" =>  "50", "Unidad" => "$/kWh", "Potencia" => "252.4",    "Horas por día" => "24",               "Días por mes" => "30"],
        ["Descripción" => "Energía Compresor",    "Valor unitario" =>  "50", "Unidad" => "$/kWh", "Potencia" => "400",    "Horas por día" => "8",               "Días por mes" => "20"],
        ["Descripción" => "Energía Iluminación",    "Valor unitario" =>  "50", "Unidad" => "$/kWh", "Potencia" => "2200",    "Horas por día" => "16",               "Días por mes" => "20"]
    ]; 
?>