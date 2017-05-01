<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";


$codigo = setCode('CR-', 8, 'sgmecarg', 'eparam_cont_cargo');
$id = $_POST["id"];
$detalle = strtoupper($_POST["detalle"]);

$nameRepeat = $pdo->query("SELECT ecarg_det_ecarg FROM sgmecarg 
    WHERE ecarg_det_ecarg='$detalle'");


if($id == ""){
  $code = $pdo->query("SELECT COUNT(*) FROM sgmecarg
  WHERE ecarg_cod_ecarg='$codigo'");
  $fetch_code = $code->fetch();

  if ($fetch_code["count"] > 0) {
    echo 3;
    return false;
  }
  if($nameRepeat->rowCount() > 0){
    echo 1;
    return false;
  }

  $cargo = $pdo->prepare("INSERT INTO sgmecarg
    (ecarg_cod_ecarg, ecarg_det_ecarg) VALUES (?, ?)");

  $cargo->bindParam(1, $codigo);
  $cargo->bindParam(2, $detalle);

  $cargo->execute();
  updateCode("eparam_cont_cargo");
}
else{
  $cargo = $pdo->query("UPDATE sgmecarg SET ecarg_det_ecarg='$detalle'
                        WHERE ecarg_cod_ecarg='$id'");
}

if($cargo) {
  echo 2;
}
