<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$query = $pdo->query("SELECT * FROM sgmehora WHERE ehora_cod_hora='$id'");
$bod = $query->fetch();

print json_encode($bod);
