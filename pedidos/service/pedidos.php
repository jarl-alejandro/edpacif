<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];
$arrayPedidos = array();

$pedidos = $pdo->query("SELECT * FROM sgmepedi
                          WHERE epedi_cod_epedi='$id'");

while ($row = $pedidos->fetch()) {
  $arrayPedidos[] = $row;
}

$ped = array('pedidos'=>$arrayPedidos);

$json = json_encode($ped);
print $json;
