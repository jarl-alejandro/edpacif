<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";
date_default_timezone_set('America/Guayaquil');

$codigo = setCode('OR-', 8, 'sgmeorex', 'eparam_cont_orxt');
$hoy = date("Y/m/d");

$emitidoPor = $_POST["emitidoPor"];
$subarea = $_POST["subarea"];
$equipo = $_POST["equipo"];
$proveedor = $_POST["proveedor"];
$mantenimiento = $_POST["mantenimiento"];
$detalle = $_POST["detalle"];
$motivo = $_POST["motivo"];
$estado = "envio";

$externa = $pdo->prepare("INSERT INTO sgmeorex (eorex_cod_eorex, eorex_emi_eorex, eorex_sub_eorex, eorex_equ_eorex,
 		eorex_prov_eorex, eorex_fet_eorex, eorex_man_eorex, eorex_det_eorex, eorex_est_eorex, eorex_mot_eorex) 
        VALUES (?,?,?,?,?,?,?,?,?,?)");

$externa->bindParam(1, $codigo);
$externa->bindParam(2, $emitidoPor);
$externa->bindParam(3, $subarea);
$externa->bindParam(4, $equipo);
$externa->bindParam(5, $proveedor);
$externa->bindParam(6, $hoy);
$externa->bindParam(7, $mantenimiento);
$externa->bindParam(8, $detalle);
$externa->bindParam(9, $estado);
$externa->bindParam(10, $motivo);

$externa->execute();

if($externa) {
  updateCode("eparam_cont_orxt");
  echo $codigo;
}