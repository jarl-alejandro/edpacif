<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];

$query = $pdo->query("SELECT * FROM sgmeruta WHERE eruta_cod_eruta='$id'");
$bod = $query->fetch();

print json_encode($bod);
