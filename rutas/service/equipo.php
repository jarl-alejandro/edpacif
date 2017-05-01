<?php
include "../../conexion/conexion.php";

$id = $_GET["equipo"];

$query = $pdo->query("SELECT * FROM sgmeruta WHERE eruta_equi_eruta='$id'");
$bod = $query->fetch();

// ORDER BY DESC LIMIT 1

print json_encode($bod);
