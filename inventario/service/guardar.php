<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";


// $codigo = setCode('IV-', 8, 'sgmeinve', 'eparam_cont_invent');
$codeNew = strtoupper($_POST["code"]);
$id = $_POST["id"];
$producto = strtoupper($_POST["producto"]);
$unidad = $_POST["unidad"];
$disponibilidad = $_POST["disponibilidad"];
$costo = $_POST["costo"];
$bodega = $_POST["bodega"];
$max = $_POST["max"];
$min = $_POST["min"];
$cant = $_POST["cant"];

$nameRepeat = $pdo->query("SELECT einven_pro_einven FROM sgmeinve 
    WHERE einven_pro_einven='$producto'");

$codRepeat = $pdo->query("SELECT einven_inici_einven FROM sgmeinve 
    WHERE einven_inici_einven='$codeNew'");

if($id == ""){
  $iin = $codRepeat->rowCount() + 1;
  $codigo = $codeNew."-00".$iin;

  if($nameRepeat->rowCount() > 0){
    echo 1;
    return false;
  }

  $inve = $pdo->prepare("INSERT INTO sgmeinve (einven_cod_einven,
    einven_pro_einven, einven_uni_einven, einven_dis_einven, einven_cos_einven, 
    einven_bod_einven, einven_max_einven, einven_min_einven, einven_cant_einven,
    einven_iin_einven, einven_inici_einven) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $inve->bindParam(1, $codigo);
  $inve->bindParam(2, $producto);
  $inve->bindParam(3, $unidad);
  $inve->bindParam(4, $disponibilidad);
  $inve->bindParam(5, $costo);
  $inve->bindParam(6, $bodega);
  $inve->bindParam(7, $max);
  $inve->bindParam(8, $min);
  $inve->bindParam(9, $cant);
  $inve->bindParam(10, $iin);
  $inve->bindParam(11, $codeNew);

  $inve->execute();
  // updateCode("eparam_cont_invent");
}
else{
  $inve = $pdo->query("UPDATE sgmeinve SET einven_pro_einven='$producto',
    einven_uni_einven='$unidad', einven_dis_einven='$disponibilidad',
    einven_cos_einven='$costo', einven_bod_einven='$bodega',
    einven_max_einven='$max', einven_min_einven='$min', 
    einven_cant_einven='$cant'
    WHERE einven_cod_einven='$id'");
}

if($inve) {
  echo 2;
}
