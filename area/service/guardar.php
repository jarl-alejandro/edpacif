<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];
// $codigo = $_POST["general"].".".$_POST["codigo"];
$general = $_POST["general"];
$detalle = strtoupper($_POST["detalle"]);

$nameRepeat = $pdo->query("SELECT earea_det_earea FROM sgmearea
    WHERE earea_det_earea='$detalle'");

$genQuery = $pdo->query("SELECT * FROM sgmearea WHERE earea_gen_earea='$general'");

$index = $genQuery->rowCount() + 1;
$codigo = $_POST["general"].".".$index;

if($id == ""){
  if($nameRepeat->rowCount() > 0){
    echo 1;
    return false;
  }

  $area = $pdo->prepare("INSERT INTO sgmearea (earea_cod_earea, earea_det_earea, earea_gen_earea, earea_id_earea) 
        VALUES (?, ?, ?, ?)");

  $area->bindParam(1, $codigo);
  $area->bindParam(2, $detalle);
  $area->bindParam(3, $general);
  $area->bindParam(4, $index);

  $area->execute();
}
else{
  $newGeneral = $_POST["newGeneral"];

  if($newGeneral == $general){
    $area = $pdo->query("UPDATE sgmearea SET earea_det_earea='$detalle',
                earea_gen_earea='$general' WHERE earea_cod_earea='$id'");    
  }
  else {
    $area = $pdo->query("UPDATE sgmearea SET earea_det_earea='$detalle',
                earea_gen_earea='$general', earea_cod_earea='$codigo' WHERE earea_cod_earea='$id'");        
  }

}

if($area) {
  echo 2;
}