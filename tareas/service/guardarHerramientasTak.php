<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

$id = $_POST["id"];

$update = $pdo->query("UPDATE sgmetare SET etare_est_etare='pedido' WHERE etare_cod_etare='$id'");

if (isset($_POST["herramientas"])) {
  $herramientas = $_POST["herramientas"];

  $herrQuery = $pdo->prepare("INSERT INTO sgmeherta (herta_herr_herta, herta_cant_herta, herta_pric_herta, herta_cod_herta) VALUES (?, ?, ?, ?)");

  foreach($herramientas as $herram) {
    $idHerram = $herram["id"];
    $cantHerram = $herram["cant"];
    $priceHerram = $herram["price"];

    $herrQuery->bindParam(1, $idHerram);
    $herrQuery->bindParam(2, $cantHerram);
    $herrQuery->bindParam(3, $priceHerram);
    $herrQuery->bindParam(4, $id);
    $herrQuery->execute();

    $eherr = $pdo->query("SELECT * FROM sgmeherr WHERE eherr_cod_eherr='$idHerram'");
    $fetcHer = $eherr->fetch();
    $cantNew = $fetcHer["eherr_cant_eherr"] - $cantHerram;
    
    $pdo->query("UPDATE sgmeherr SET eherr_cant_eherr='$cantNew' WHERE eherr_cod_eherr='$idHerram'");
  }
}
if (isset($_POST["repuestos"])) {
  $repuestos = $_POST["repuestos"];
  $respQuery = $pdo->prepare("INSERT INTO sgmerepta (repta_herr_repta, repta_cant_repta, repta_pric_repta, repta_cod_repta) VALUES (?, ?, ?, ?)");

  foreach($repuestos as $resp) {
    $idResp = $resp["id"];
    $cantResp = $resp["cant"];
    $priceResp = $resp["price"];

    $respQuery->bindParam(1, $idResp);
    $respQuery->bindParam(2, $cantResp);
    $respQuery->bindParam(3, $priceResp);
    $respQuery->bindParam(4, $id);
    $respQuery->execute();

    $sgmeInv = $pdo->query("SELECT * FROM sgmeinve WHERE einven_cod_einven='$idResp'");
    $fetcSgmeInv = $sgmeInv->fetch();
    $cantNew = $fetcSgmeInv["einven_cant_einven"] - $cantResp;
    
    $pdo->query("UPDATE sgmeinve SET einven_cant_einven='$cantNew' WHERE einven_cod_einven='$idResp'");

  }
}


if($update){
  echo 2;
}