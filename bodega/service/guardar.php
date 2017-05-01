<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

$codigo = setCode('BO-', 8, 'sgmebod', 'eparam_cont_bodega');
$id = $_POST["id"];
$detalle = strtoupper($_POST["detalle"]);

$nameRepeat = $pdo->query("SELECT ebod_det_ebod FROM sgmebod 
    WHERE ebod_det_ebod='$detalle'");


if($id == ""){
  $code = $pdo->query("SELECT COUNT(*) FROM sgmebod
  WHERE ebod_cod_ebod='$codigo'");
  $fetch_code = $code->fetch();

  if ($fetch_code["count"] > 0) {
    echo 3;
    return false;
  }
  if($nameRepeat->rowCount() > 0){
    echo 1;
    return false;
  }

  $area = $pdo->prepare("INSERT INTO sgmebod
    (ebod_cod_ebod, ebod_det_ebod) VALUES (?, ?)");

  $area->bindParam(1, $codigo);
  $area->bindParam(2, $detalle);

  $area->execute();
  updateCode("eparam_cont_bodega");
}
else{
  $area = $pdo->query("UPDATE sgmebod SET ebod_det_ebod='$detalle'
                        WHERE ebod_cod_ebod='$id'");
}

if($area) {
  echo 2;
}
