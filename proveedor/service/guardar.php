<?php
include "../../conexion/conexion.php";
include "../../conexion/codigo.php";

$codigo = setCode('PR-', 8, 'sgmepro', 'eparam_cont_prove');

$id = $_POST["id_proveedor"];
$nombre = strtoupper($_POST["nombre"]);
$direccion = strtoupper($_POST["direccion"]);
$celular = strtoupper($_POST["celular"]);
$telefono = strtoupper($_POST["telefono"]);
$email = strtoupper($_POST["email"]);

$nombreContacto = strtoupper($_POST["nombreContacto"]);
$celularContacto = strtoupper($_POST["celularContacto"]);
$telefonoContacto = strtoupper($_POST["telefonoContacto"]);
$emailContacto = strtoupper($_POST["emailContacto"]);

if($id == ""){
  $provee = $pdo->prepare("INSERT INTO sgmepro (eprov_cod_eprov, eprov_nom_eprov,
     eprov_dir_eprov, eprov_cel_eprov, eprov_tel_eprov, eprov_mai_eprov,
     eprov_noc_eprov, eprov_cec_eprov, eprov_tec_eprov, eprov_emc_eprov)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


  $provee->bindParam(1, $codigo);
  $provee->bindParam(2, $nombre);
  $provee->bindParam(3, $direccion);
  $provee->bindParam(4, $celular);
  $provee->bindParam(5, $telefono);
  $provee->bindParam(6, $email);
  $provee->bindParam(7, $nombreContacto);
  $provee->bindParam(8, $celularContacto);
  $provee->bindParam(9, $telefonoContacto);
  $provee->bindParam(10, $emailContacto);

  $provee->execute();
  updateCode("eparam_cont_prove");
}
else {
  $provee = $pdo->query("UPDATE sgmepro SET eprov_nom_eprov='$nombre',
     eprov_dir_eprov='$direccion', eprov_cel_eprov='$celular',
     eprov_tel_eprov='$telefono', eprov_mai_eprov='$email',
     eprov_noc_eprov='$nombreContacto', eprov_tec_eprov='$telefonoContacto', 
     eprov_emc_eprov='$emailContacto', eprov_cec_eprov='$celularContacto'
     WHERE eprov_cod_eprov='$id'");

}

if($provee){
  echo 2;
}