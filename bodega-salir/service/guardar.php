<?php session_start();
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";
date_default_timezone_set('America/Guayaquil');

$id = $_POST["id"];
$codigo = $_POST["subarea"].".".$_POST["codigo"];
$detalle = $_POST["detalle"];
$subarea = $_POST["subarea"];
$is_imagen = $_POST["is_imagen"];
$detalles = $_POST["detalles"];
$horas = $_POST["horas"];
$proveedor = $_POST["proveedor"];
$kilometros = $_POST["kilometros"];
$fecha = date("Y/m/d");
$estado = "funcionamineto";

$empleado = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
$code_image = setCode('IMG-', 8, 'ep_equipos', 'eparam_cont_img');

$detalles = json_decode($detalles);

if($id == ""){
  $countCod = $pdo->query("SELECT eequi_cod_eequi FROM smgeequi 
          WHERE eequi_cod_eequi='$codigo'");

  if($countCod->rowCount() > 0){
    echo 1;
    return false;
  }
  $img_equipo = upload_image($code_image, "equipos");

  $equipos = $pdo->prepare("INSERT INTO smgeequi (eequi_cod_eequi, eequi_det_eequi, eequi_fec_eequi, eequi_sare_eequi, eequi_emp_eequi,
    eequi_ima_eequi, eequi_est_eequi, eequi_horas_eequi, eequi_kil_eequi, eequi_prov_eequi) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $equipos->bindParam(1, $codigo);
  $equipos->bindParam(2, $detalle);
  $equipos->bindParam(3, $fecha);
  $equipos->bindParam(4, $subarea);
  $equipos->bindParam(5, $empleado);
  $equipos->bindParam(6, $img_equipo);
  $equipos->bindParam(7, $estado);
  $equipos->bindParam(8, $horas);
  $equipos->bindParam(9, $kilometros);
  $equipos->bindParam(10, $proveedor);

  $equipos->execute();
  updateCode('eparam_cont_img');

  $equiDetail = $pdo->prepare("INSERT INTO sgmedequ (edequ_inv_edequ, edequ_cant_edequ, edequ_tot_edequ, edequ_cod_edequ) VALUES (?, ?, ?, ?)");

  $equiDetail->bindParam(1, $inven);
  $equiDetail->bindParam(2, $cant);
  $equiDetail->bindParam(3, $total);
  $equiDetail->bindParam(4, $codigo);

}
else{

  if($is_imagen == 0){
    $equipos = $pdo->query("UPDATE smgeequi SET  eequi_det_eequi='$detalle', eequi_sare_eequi='$subarea', eequi_kil_eequi='$kilometros', 
      eequi_prov_eequi='$proveedor', eequi_horas_eequi='$horas' 
      WHERE eequi_cod_eequi='$id'");

  }
  else {

    $img_equipo = upload_image($code_image, "equipos");

    $equipos = $pdo->query("UPDATE smgeequi SET eequi_det_eequi='$detalle', eequi_sare_eequi='$subarea',eequi_kil_eequi='$kilometros', 
      eequi_prov_eequi='$proveedor',
      eequi_ima_eequi='$img_equipo', eequi_horas_eequi='$horas'
      WHERE eequi_cod_eequi='$id'");

    updateCode('eparam_cont_img');
  }


  $pdo->query("DELETE FROM sgmedequ WHERE edequ_cod_edequ='$id'");

  $equiDetail = $pdo->prepare("INSERT INTO sgmedequ (edequ_inv_edequ, edequ_cant_edequ, edequ_tot_edequ, edequ_cod_edequ) VALUES (?, ?, ?, ?)");

  $equiDetail->bindParam(1, $inven);
  $equiDetail->bindParam(2, $cant);
  $equiDetail->bindParam(3, $total);
  $equiDetail->bindParam(4, $id);

}



foreach ($detalles as $detail) {

  $inven = $detail->id;
  $producto = $detail->producto;
  $price = $detail->price;
  $total = $detail->total;
  $cant = $detail->cant;

  $equiDetail->execute();
}

if($equipos) {
  echo 201;
}
