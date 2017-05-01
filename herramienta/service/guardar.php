<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

$codeNew = strtoupper($_POST["code"]);
$id = $_POST["id"];
$producto = strtoupper($_POST["producto"]);
$unidad = $_POST["unidad"];
$costo = $_POST["costo"];
$bodega = $_POST["bodega"];
$max = $_POST["max"];
$min = $_POST["min"];
$cant = $_POST["cant"];

$nameRepeat = $pdo->query("SELECT eherr_det_eherr FROM sgmeherr
    WHERE eherr_det_eherr='$producto'");

$codeRepeat = $pdo->query("SELECT eherr_inic_eherr FROM sgmeherr
    WHERE eherr_inic_eherr='$codeNew'");

if($id == ""){
  $iin = $codeRepeat->rowCount() + 1;
  $codigo = $codeNew."-00".$iin;

  if($nameRepeat->rowCount() > 0){
    echo 1;
    return false;
  }
  
  $herr = $pdo->prepare("INSERT INTO sgmeherr (eherr_cod_eherr,
    eherr_det_eherr, eherr_uni_eherr, eherr_cos_eherr, eherr_cant_eherr,
    eherr_max_eherr, eherr_min_eherr, eherr_id_eherr, eherr_bod_eherr, eherr_inic_eherr)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $herr->bindParam(1, $codigo);
  $herr->bindParam(2, $producto);
  $herr->bindParam(3, $unidad);
  $herr->bindParam(4, $costo);
  $herr->bindParam(5, $cant);
  $herr->bindParam(6, $max);
  $herr->bindParam(7, $min);
  $herr->bindParam(8, $iin);
  $herr->bindParam(9, $bodega);
  $herr->bindParam(10, $codeNew);

  $herr->execute();
}
else{
  $herr = $pdo->query("UPDATE sgmeherr SET eherr_det_eherr='$producto',
    eherr_uni_eherr='$unidad', eherr_cos_eherr='$costo',
    eherr_cant_eherr='$cant', eherr_max_eherr='$max',
    eherr_min_eherr='$min', eherr_bod_eherr='$bodega'
    WHERE eherr_cod_eherr='$id'");
}

if($herr) {
  echo 2;
}
