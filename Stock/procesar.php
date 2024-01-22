<!-- procesar.php -->
<?php
require_once 'conn.php';

// Manejar la adición de stock
if (isset($_GET['add'])) {
    $ID_formato     = $_GET['ID_formato'    ];
    $papel          = $_GET['papel'         ];
    $fecha          = $_GET['fecha'         ];
    $pedido         = $_GET['pedido'        ];
    $detalle        = $_GET['detalle'       ];
    $origen         = $_GET['origen'        ];
    $ingreso        = $_GET['ingreso'       ];
    $egreso         = $_GET['egreso'        ];
    $saldo          = $_GET['saldo'         ];
    $destino_sobrante = $_GET['destino_sobrante'];
    $facturado      = $_GET['facturado'     ];
    $entregado      = $_GET['entregado'     ];
    $remito         = $_GET['remito'        ];
    $sobreconsumo   = $_GET['sobreconsumo'  ];
    $lote           = $_GET['lote'          ];

    // Resto de campos aquí...

    $query = "INSERT INTO `tabla_2` (`ID_formato`, `papel`,  `fecha`, `pedido`, `detalle`, `origen`, `ingreso`, `egreso`, `saldo`, `destino_sobrante`, `facturado`, `entregado`, `remito`, `sobreconsumo`, `lote`)
              VALUES ('$ID_formato', '$papel', '$fecha', '$pedido', '$detalle', '$origen', '$ingreso', '$egreso', '$saldo', '$destino_sobrante', '$facturado', '$entregado', '$remito', '$sobreconsumo', '$lote')";
    mysqli_query($conn, $query);
    echo  $query;
    //header("Location: index.php");
    exit;
}
?>
