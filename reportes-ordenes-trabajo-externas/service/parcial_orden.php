<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

date_default_timezone_set('America/Guayaquil');

function uploadFile ($name, $route, $type) {
	$code_pdf = $name;
	$diagnostico = $_FILES[$type]['name'];
	$diagnostico = $code_pdf . ".pdf";

	$ruta = $_FILES[$type]["tmp_name"];
	$destino = "../../media/$route/$diagnostico";

	copy($ruta, $destino);
	return $diagnostico;
}

$id = $_POST["id"];
$costo = $_POST["costo"];
$fecha = $_POST["fecha"];

$is_informe = $_POST["is_informe"];
$is_factura = $_POST["is_factura"];


if($costo > 0) {
	$pdo->query("UPDATE sgmeorex SET eorex_cos_eorex='$costo' WHERE eorex_cod_eorex='$id'");
}
else if($fecha != "") {
	$pdo->query("UPDATE sgmeorex SET eorex_ffe_eorex='$fecha' WHERE eorex_cod_eorex='$id'");
}
else if ($is_factura == 0 && $is_informe > 0) {
	$code_informe = setCode('INF-', 8, 'sgmeorex', 'eparam_cont_img');
	$informe = uploadFile($code_informe, "externas", 'informe');
	updateCode('eparam_cont_img');

	$pdo->query("UPDATE sgmeorex SET eorex_cos_eorex='$costo', eorex_ffe_eorex='$fecha', eorex_infor_eorex='$informe'
					WHERE eorex_cod_eorex='$id'");	
}

else if ($is_factura > 0 && $is_informe == 0) {
	$code_factura = setCode('FAC-', 8, 'sgmeorex', 'eparam_cont_img');
	$factura = uploadFile($code_factura, "externas", 'factura');
	updateCode('eparam_cont_img');

	$pdo->query("UPDATE sgmeorex SET eorex_cos_eorex='$costo', eorex_ffe_eorex='$fecha', eorex_fact_eorex='$factura'
					WHERE eorex_cod_eorex='$id'");	
}
else if ($is_factura > 0 && $is_informe > 0) {
	$code_informe = setCode('INF-', 8, 'sgmeorex', 'eparam_cont_img');
	$informe = uploadFile($code_informe, "externas", 'informe');
	updateCode('eparam_cont_img');

	$code_factura = setCode('FAC-', 8, 'sgmeorex', 'eparam_cont_img');
	$factura = uploadFile($code_factura, "externas", 'factura');
	updateCode('eparam_cont_img');

	$pdo->query("UPDATE sgmeorex SET eorex_cos_eorex='$costo', eorex_ffe_eorex='$fecha', eorex_fact_eorex='$factura', 
					eorex_infor_eorex='$informe' WHERE eorex_cod_eorex='$id'");		
}

