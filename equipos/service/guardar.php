<?php session_start();
date_default_timezone_set('America/Guayaquil');

include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

$id = $_POST["id"];
$detalle = strtoupper($_POST["detalle"]);
$subarea = $_POST["subarea"];
$is_imagen = $_POST["is_imagen"];
$detalles = $_POST["detalles"];
$proveedor = $_POST["proveedor"];
$horas = $_POST["horas"];
$kilometros = $_POST["kilometros"];
$fechaCompra = $_POST["fechaCompra"];
$esEquipo = $_POST["esEquipo"];
$fecha = date("Y/m/d");
$estado = "funcionamineto";

$Model = $_POST["inputModel"] != "" ? $_POST["inputModel"] : 0;
$Marca = $_POST["inputMarca"] != "" ? $_POST["inputMarca"] : 0;
$Year = $_POST["inputYer"] != "" ? $_POST["inputYer"] : 0;
$NumeriFacu = $_POST["inputNumeriFacu"] != "" ? $_POST["inputNumeriFacu"] : 0;
$Valor = $_POST["inputValor"] != "" ? $_POST["inputValor"] : 0;
$Serie = $_POST["inputSerie"] != "" ? $_POST["inputSerie"] : 0;
$Placa = $_POST["inputPlaca"] != "" ? $_POST["inputPlaca"] : 0;
$SerieChasis = $_POST["inputSerieChasis"] != "" ? $_POST["inputSerieChasis"] : 0;
$SerieMotor = $_POST["inputSerieMotor"] != "" ? $_POST["inputSerieMotor"] : 0;

$empleado = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
$code_image = setCode('IMG-', 8, 'ep_equipos', 'eparam_cont_img');

$detalles = json_decode($detalles);

$genQuery = $pdo->query("SELECT * FROM smgeequi WHERE eequi_sare_eequi='$subarea'");

$index = $genQuery->rowCount() + 1;
$codigo = $_POST["subarea"].".".$index;

if($id == ""){
  $countCod = $pdo->query("SELECT eequi_cod_eequi FROM smgeequi
          WHERE eequi_cod_eequi='$codigo'");

  if($countCod->rowCount() > 0){
    echo 1;
    return false;
  }

  $countNom = $pdo->query("SELECT eequi_det_eequi FROM smgeequi WHERE eequi_det_eequi='$detalle'");

  if($countNom->rowCount() > 0) {
    echo 4;
    return false;
  }
  $img_equipo = upload_image($code_image, "equipos");

  $equipos = $pdo->prepare("INSERT INTO smgeequi (eequi_cod_eequi, eequi_det_eequi,
      eequi_fec_eequi, eequi_sare_eequi, eequi_emp_eequi, eequi_ima_eequi, eequi_est_eequi,
      eequi_horas_eequi, eequi_kil_eequi, eequi_prov_eequi, eequi_fcom_eequi, eequi_baja_eequi, eequi_esq_eequi)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $info = $pdo->prepare("INSERT INTO sgmeinfe (einfe_mod_infe, einfe_mar_infe, einfe_year_infe, einfe_nfac_infe,
    einfe_val_infe, einfe_ser_infe, einfe_pla_infe, einfe_cha_infe, einfe_mot_infe, einfe_equi_infe)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $cero = 0;

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
  $equipos->bindParam(11, $fechaCompra);
  $equipos->bindParam(12, $cero);
  $equipos->bindParam(13, $esEquipo);

  $info->bindParam(1, $Model);
  $info->bindParam(2, $Marca);
  $info->bindParam(3, $Year);
  $info->bindParam(4, $NumeriFacu);
  $info->bindParam(5, $Valor);
  $info->bindParam(6, $Serie);
  $info->bindParam(7, $Placa);
  $info->bindParam(8, $SerieChasis);
  $info->bindParam(9, $SerieMotor);
  $info->bindParam(10, $codigo);

  $info->execute();
  $equipos->execute();
  updateCode('eparam_cont_img');

  $equiDetail = $pdo->prepare("INSERT INTO sgmedequ (edequ_inv_edequ, edequ_cant_edequ, edequ_tot_edequ, edequ_cod_edequ) VALUES (?, ?, ?, ?)");

  $equiDetail->bindParam(1, $inven);
  $equiDetail->bindParam(2, $cant);
  $equiDetail->bindParam(3, $total);
  $equiDetail->bindParam(4, $codigo);
}
else{

  $newGeneral = $_POST["newGeneral"];
  // print_r($_POST);

  if($is_imagen == 0){
    if($newGeneral == $subarea){
      $equipos = $pdo->query("UPDATE smgeequi SET  eequi_det_eequi='$detalle', eequi_sare_eequi='$subarea', eequi_kil_eequi='$kilometros',
        eequi_prov_eequi='$proveedor', eequi_horas_eequi='$horas', eequi_esq_eequi='$esEquipo'
        WHERE eequi_cod_eequi='$id'");
    }
    else{
      $equipos = $pdo->query("UPDATE smgeequi SET  eequi_det_eequi='$detalle', eequi_sare_eequi='$subarea', eequi_kil_eequi='$kilometros',
        eequi_prov_eequi='$proveedor', eequi_horas_eequi='$horas', eequi_cod_eequi='$codigo'
        WHERE eequi_cod_eequi='$id'");
    }

  }
  else {
    $img_equipo = upload_image($code_image, "equipos");

    if($newGeneral == $subarea){
      $equipos = $pdo->query("UPDATE smgeequi SET eequi_det_eequi='$detalle', eequi_sare_eequi='$subarea',eequi_kil_eequi='$kilometros',
        eequi_prov_eequi='$proveedor',
        eequi_ima_eequi='$img_equipo', eequi_horas_eequi='$horas'
        WHERE eequi_cod_eequi='$id'");

    }
    else{
      $equipos = $pdo->query("UPDATE smgeequi SET eequi_det_eequi='$detalle', eequi_sare_eequi='$subarea',eequi_kil_eequi='$kilometros',
        eequi_prov_eequi='$proveedor', eequi_ima_eequi='$img_equipo', eequi_horas_eequi='$horas',
        eequi_cod_eequi='$codigo' WHERE eequi_cod_eequi='$id'");
    }

    updateCode('eparam_cont_img');
  }

  $info = $pdo->query("UPDATE sgmeinfe SET einfe_mod_infe='$Model', einfe_mar_infe='$Marca',
    einfe_year_infe='$Year', einfe_nfac_infe='$NumeriFacu', einfe_val_infe='$Valor', einfe_ser_infe='$Serie',
     einfe_pla_infe='$Placa', einfe_cha_infe='$SerieChasis', einfe_mot_infe='$SerieMotor'
     WHERE einfe_equi_infe='$id'");

  $pdo->query("DELETE FROM sgmedequ WHERE edequ_cod_edequ='$id'");

  $equiDetail = $pdo->prepare("INSERT INTO sgmedequ (edequ_inv_edequ, edequ_cant_edequ, edequ_tot_edequ, edequ_cod_edequ) VALUES (?, ?, ?, ?)");

  $equiDetail->bindParam(1, $inven);
  $equiDetail->bindParam(2, $cant);
  $equiDetail->bindParam(3, $total);

  if($newGeneral == $subarea){
    $equiDetail->bindParam(4, $id);
  }
  else{
    $equiDetail->bindParam(4, $codigo);
  }

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
