<?php
include "../../conexion/conexion.php";

$id = $_POST["id"];
$cedula = $_POST["cedula"];
$nombre = strtoupper($_POST["nombre"]);
$apellido = strtoupper($_POST["apellido"]);
$direccion = strtoupper($_POST["direccion"]);
$rol = $_POST["rol"];
$telefono = strtoupper($_POST["telefono"]);
$email = $_POST["email"];
$sueldo = $_POST["sueldo"];
$avatar = "user_create.png";
$password = sha1($cedula);

if($id == ""){
  $employ = $pdo->prepare("INSERT INTO sgmeempl (eempl_ced_eempl, eempl_nom_eempl,
     eempl_ape_eempl, eempl_tel_eempl, eempl_dir_eempl, eempl_mai_eempl,
     eempl_suel_eempl, eempl_car_eempl, eempl_ava_eempl, eempl_cont_eempl)
      VALUES (?,?,?,?,?,?,?,?,?, ?)");


  $employ->bindParam(1, $cedula);
  $employ->bindParam(2, $nombre);
  $employ->bindParam(3, $apellido);
  $employ->bindParam(4, $telefono);
  $employ->bindParam(5, $direccion);
  $employ->bindParam(6, $email);
  $employ->bindParam(7, $sueldo);
  $employ->bindParam(8, $rol);
  $employ->bindParam(9, $avatar);
  $employ->bindParam(10, $password);

  $employ->execute();
}
else {
  $employ = $pdo->query("UPDATE sgmeempl SET eempl_nom_eempl='$nombre',
     eempl_ape_eempl='$apellido', eempl_tel_eempl='$telefono',
     eempl_dir_eempl='$direccion', eempl_mai_eempl='$email',
     eempl_suel_eempl='$sueldo', eempl_car_eempl='$rol'
     WHERE eempl_ced_eempl='$id'");

}

if($employ){
  echo 2;
}
