<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

$codigo = setCode('HTA-', 8, 'sgmehora', 'eparam_cont_ruta');

$id = $_POST["id"];
$hora = $_POST["hora"];
$horaFinal = $_POST["horaFinal"];
$fecha = $_POST["fecha"];
$llegada = $_POST["llegada"];
$equipo = $_POST["equipo"];
$empleado = $_POST["empleado"];

// function restar ($inicio, $fin) {
// 	$dif = date("H:i", strtotime($inicio) - strtotime($inicio));
// 	return $dif;
// }

function RestarHoras($horaini,$horafin){
	$horai=substr($horaini,0,2);
	$mini=substr($horaini,3,2);
	$segi=substr($horaini,6,2);
 
	$horaf=substr($horafin,0,2);
	$minf=substr($horafin,3,2);
	$segf=substr($horafin,6,2);
 
	$ini=((($horai*60)*60)+($mini*60)+$segi);
	$fin=((($horaf*60)*60)+($minf*60)+$segf);
 
	$dif=$fin-$ini;
 
	$difh=floor($dif/3600);
	$difm=floor(($dif-($difh*3600))/60);
	$difs=$dif-($difm*60)-($difh*3600);
	return date("H-i",mktime($difh,$difm,$difs));
}

function decimal ($hora_descimal) {
	$desglose = explode("-", $hora_descimal);
	$desc = $desglose[0] + $desglose[1] / 60;
	return $desc;
}


if($id == ""){
  
  $code = $pdo->query("SELECT COUNT(*) FROM sgmehora WHERE ehora_cod_hora='$codigo'");
  $fetch_code = $code->fetch();

  if ($fetch_code["count"] > 0) {
    echo 3;
    return false;
  }

// ehora_horf_ehora,
				// ehora_llegf_ehora
  $hora = $pdo->query("INSERT INTO sgmehora (ehora_cod_hora, ehora_hor_ehora, 
				ehora_fet_ehora, ehora_equi_ehora, ehora_emp_ehora) 
				VALUES ('$codigo', '$hora', '$fecha', '$equipo', '$empleado')");

  updateCode("eparam_cont_ruta");
}
else{
  $query_equi = $pdo->query("SELECT * FROM smgeequi WHERE eequi_cod_eequi='$equipo'");
	$fetch_equi = $query_equi->fetch();

	$hora = $pdo->query("UPDATE sgmehora SET ehora_horf_ehora='$horaFinal',
									ehora_llegf_ehora='$llegada' WHERE ehora_cod_hora='$id'");

	$valor = $horaFinal - $hora;
	$horaEs = $valor + $fetch_equi["eequi_hoe_eequi"];

	$pdo->query("UPDATE smgeequi SET eequi_hoe_eequi='$horaEs' WHERE eequi_cod_eequi='$equipo'");
}

if($hora) {
  echo 2;
}
