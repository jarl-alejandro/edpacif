<?php
include "../../conexion/conexion.php";

$id = $_GET["id"];
$exist = $pdo->query("SELECT * FROM sgmedequ WHERE edequ_inv_edequ='$id'");

if($exist->rowCount() > 0) {
  $query = $pdo->query("SELECT * FROM sgmeinve WHERE einven_cod_einven='$id'");
  $inven = $query->fetch();
  $json = array('inventarios'=> $inven, 'status'=>3);
  print json_encode($json);
}
else{
  $query = $pdo->query("SELECT * FROM sgmeinve WHERE einven_cod_einven='$id'");
  $inven = $query->fetch();
  print json_encode($inven);
}
