<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];
$general = $_POST["general"];
$detalle = strtoupper($_POST["detalle"]);
$estado = 1;

$nameRepeat = $pdo->query("SELECT ltare_det_ltare FROM sgmeltare
    WHERE ltare_det_ltare='$detalle' AND ltare_suba_ltare='$general'");

$genQuery = $pdo->query("SELECT * FROM sgmeltare WHERE ltare_suba_ltare='$general'");

$index = $genQuery->rowCount() + 1;
$codigo = $_POST["general"].".".$index;

if($id == ""){
  if($nameRepeat->rowCount() > 0){
    echo 1;
    return false;
  }

  $area = $pdo->prepare("INSERT INTO sgmeltare (ltare_cod_ltare, ltare_det_ltare, ltare_suba_ltare, ltare_est_ltare) 
        VALUES (?, ?, ?, ?)");

  $area->bindParam(1, $codigo);
  $area->bindParam(2, $detalle);
  $area->bindParam(3, $general);
  $area->bindParam(4, $estado);

  $area->execute();
}
else{
  $newGeneral = $_POST["newGeneral"];

  if($newGeneral == $general){
    $area = $pdo->query("UPDATE sgmeltare SET ltare_det_ltare='$detalle',
                ltare_suba_ltare='$general' WHERE ltare_cod_ltare='$id'");    
  }
  else {
    $area = $pdo->query("UPDATE sgmeltare SET ltare_det_ltare='$detalle',
                ltare_suba_ltare='$general', ltare_cod_ltare='$codigo' WHERE ltare_cod_ltare='$id'");        
  }

}


if($area) {
  echo 2;
}