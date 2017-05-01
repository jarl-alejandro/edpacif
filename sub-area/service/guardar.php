<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];
$general = $_POST["general"];
$detalle = strtoupper($_POST["detalle"]);

$nameRepeat = $pdo->query("SELECT subare_det_subare FROM sgmesuba
    WHERE subare_det_subare='$detalle'");


$areaQuery = $pdo->query("SELECT * FROM sgmesuba WHERE subare_are_subare='$general'");

$index = $areaQuery->rowCount() + 1;
$codigo = $_POST["general"].".".$index;

if($id == ""){

  if($nameRepeat->rowCount() > 0){
    echo 1;
    return false;
  }

  $area = $pdo->prepare("INSERT INTO sgmesuba
    (subare_cod_subare, subare_det_subare, subare_are_subare) VALUES (?, ?, ?)");

  $area->bindParam(1, $codigo);
  $area->bindParam(2, $detalle);
  $area->bindParam(3, $general);

  $area->execute();
}
else{
  $newGeneral = $_POST["newGeneral"];

  if($newGeneral == $general){
    $area = $pdo->query("UPDATE sgmesuba SET subare_det_subare='$detalle',
                subare_are_subare='$general' WHERE subare_cod_subare='$id'");
  }
  else {
    $area = $pdo->query("UPDATE sgmesuba SET subare_det_subare='$detalle',
                subare_are_subare='$general', subare_cod_subare='$codigo' WHERE subare_cod_subare='$id'");    
  }
}

if($area) {
  echo 2;
}
