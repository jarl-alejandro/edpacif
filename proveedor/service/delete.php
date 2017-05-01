<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$employ = $pdo->query("DELETE FROM sgmepro WHERE eprov_cod_eprov='$id'");

if($employ){
  echo 2;
}
