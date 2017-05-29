<?php
include "../../conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];

$update = $pdo->query("UPDATE sgmeorin SET eorin_est_eorin='pedido' WHERE eorin_cod_eorin='$id'");

if (isset($_POST["herramientas"])) {
  $herramientas = $_POST["herramientas"];
  $herrQuery = $pdo->prepare("INSERT INTO sgmedoih (doih_herr_doih, doih_cant_doih, doih_pric_doih, doih_cod_doih)
                              VALUES (?, ?, ?, ?)");
  foreach($herramientas as $herram) {
    $idHerram = $herram["id"];
    $cantHerram = $herram["cant"];
    $priceHerram = $herram["price"];

    $herrQuery->bindParam(1, $idHerram);
    $herrQuery->bindParam(2, $cantHerram);
    $herrQuery->bindParam(3, $priceHerram);
    $herrQuery->bindParam(4, $id);
    $herrQuery->execute();

    /*$eherr = $pdo->query("SELECT * FROM sgmeherr WHERE eherr_cod_eherr='$idHerram'");
    $fetcHer = $eherr->fetch();
    $cantNew = $fetcHer["eherr_cant_eherr"] - $cantHerram;

    $pdo->query("UPDATE sgmeherr SET eherr_cant_eherr='$cantNew' WHERE eherr_cod_eherr='$idHerram'");*/
  }
}
if (isset($_POST["repuestos"])) {
  $repuestos = $_POST["repuestos"];
  $respQuery = $pdo->prepare("INSERT INTO sgmedoir (doir_herr_doir, doir_cant_doir, doir_pric_doir, doir_cod_doir)
                            VALUES (?, ?, ?, ?)");

  foreach($repuestos as $resp) {
    $idResp = $resp["id"];
    $cantResp = $resp["cant"];
    $priceResp = $resp["price"];

    $respQuery->bindParam(1, $idResp);
    $respQuery->bindParam(2, $cantResp);
    $respQuery->bindParam(3, $priceResp);
    $respQuery->bindParam(4, $id);
    $respQuery->execute();

    //$sgmeInv = $pdo->query("SELECT * FROM sgmeinve WHERE einven_cod_einven='$idResp'");
    //$fetcSgmeInv = $sgmeInv->fetch();
    //$cantNew = $fetcSgmeInv["einven_cant_einven"] - $cantResp;

    //$pdo->query("UPDATE sgmeinve SET einven_cant_einven='$cantNew' WHERE einven_cod_einven='$idResp'");

  }
}


if($update){
  echo 2;
}