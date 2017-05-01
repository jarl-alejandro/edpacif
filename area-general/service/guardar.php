<?php
include "../../conexion/conexion.php";

$codigo = $_POST["codigo"];
$id = $_POST["id"];
$detalle = strtoupper($_POST["detalle"]);
$dependeAguaje = $_POST["dependeAguaje"];

$nameRepeat = $pdo->query("SELECT earege_det_earege FROM sgmearege
    WHERE earege_det_earege='$detalle'");


if($id == ""){
  $code = $pdo->query("SELECT COUNT(*) FROM sgmearege
  WHERE earege_cod_earege='$codigo'");
  $fetch_code = $code->fetch();

  if ($fetch_code["count"] > 0) {
    echo 3;
    return false;
  }
  if($nameRepeat->rowCount() > 0){
    echo 1;
    return false;
  }

  $area = $pdo->prepare("INSERT INTO sgmearege(earege_cod_earege, earege_det_earege, earege_agu_earege) 
                          VALUES (?, ?, ?)");

  $area->bindParam(1, $codigo);
  $area->bindParam(2, $detalle);
  $area->bindParam(3, $dependeAguaje);

  $area->execute();
}
else{
  $area = $pdo->query("UPDATE sgmearege SET earege_det_earege='$detalle' WHERE earege_cod_earege='$id'");
}

if($area) {
  echo 2;
}
