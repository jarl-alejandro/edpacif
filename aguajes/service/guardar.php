<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

date_default_timezone_set('America/Guayaquil');

$codigo = setCode('AG-', 8, 'sgmeagua', 'eparam_cont_aguajes');
$inicio = $_POST["inicio"];
$fin = $_POST["fin"];
$id = $_POST["id"];
$estado = "libre";
$prioridad = $_POST["prioridad"];
$split = explode("_", $prioridad);
$color = $split["0"];
$orden = $split["1"];


$valid = $pdo->query("SELECT * FROM sgmeagua WHERE (
  (eagua_ini_eagua <='$inicio' AND eagua_fin_eagua >= '$fin')
  OR eagua_ini_eagua BETWEEN '$inicio' AND '$fin'
  OR eagua_fin_eagua BETWEEN '$inicio' AND '$fin') AND eagua_est_eagua='libre'");


if($id == ""){

  if($valid->rowCount() > 0){
    echo 3;
    return false;
  }
  $tipos = $pdo->prepare("INSERT INTO sgmeagua (eagua_cod_eagua, eagua_ini_eagua,
      eagua_fin_eagua, eagua_est_eagua, eagua_pri_eagua, eagua_col_eagua) 
      VALUES (?,?,?,?,?,?)");

  $tipos->bindParam(1, $codigo);
  $tipos->bindParam(2, $inicio);
  $tipos->bindParam(3, $fin);
  $tipos->bindParam(4, $estado);
  $tipos->bindParam(5, $orden);
  $tipos->bindParam(6, $color);

  $tipos->execute();
  updateCode("eparam_cont_aguajes");
}
else {

  $tipos = $pdo->query("UPDATE sgmeagua SET eagua_ini_eagua='$inicio',
      eagua_fin_eagua='$fin', eagua_pri_eagua='$orden', eagua_col_eagua='$color' WHERE eagua_cod_eagua='$id'");
}
if($tipos) {
  echo 2;
}
