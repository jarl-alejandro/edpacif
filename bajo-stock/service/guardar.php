<?php
include "../../conexion/conexion.php";

$inventarios = $_POST['inventarios'];


foreach ($inventarios as $row) {
  $id = $row['id'];
  $cant = $row['cant'];
  $qs = $pdo->query("SELECT * FROM sgmeinve WHERE einven_cod_einven='$id'");
  $fetch = $qs->fetch();
  $new_cant = $fetch['einven_cant_einven'] + $cant;

  $pdo->query("UPDATE sgmeinve SET einven_cant_einven='$new_cant' WHERE einven_cod_einven='$id'");
}

echo 2;
