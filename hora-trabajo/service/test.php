<?php
include "../../conexion/conexion.php";

$hora = "01:00:00";
$horaFinal = "02:00:00";

$res = $horaFinal -$hora;
echo $res;

// (string) 

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

$valor = RestarHoras($hora, $horaFinal);
// print_r(explode("-", $valor));

function restar ($inicio, $fin) {
	$dif = date("H:i", strtolower($inicio) - strtotime($inicio));
	return $dif;
}


function decimal ($hora_descimal) {
	$desglose = explode("-", $hora_descimal);
	$desc = $desglose[0] + $desglose[1] / 60;
	return $desc;
}

$dif = (string) restar($hora, $horaFinal);
$valor = decimal($valor);

// echo $valor;

