<?php session_start();
  include "conexion/conexion.php";

  if(isset($_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"])){
    header("Location: empleado");
  }

  $empleados = $pdo->query("SELECT * FROM sgmeempl");
  $params = $pdo->query("SELECT * FROM sgmeparam");

  if($empleados->rowCount() == 0){
    $codCargo = "CR-00001";
    $detalle = "SUPERVISOR";

    $cargo = $pdo->prepare("INSERT INTO sgmecarg
           (ecarg_cod_ecarg, ecarg_det_ecarg) VALUES (?, ?)");

    $cargo->bindParam(1, $codCargo);
    $cargo->bindParam(2, $detalle);

    $cargo->execute();

    $cedula = "1234567890";
    $nombre = strtoupper("admin");
    $apellido = strtoupper("admin");
    $direccion = strtoupper("admin");
    $telefono = strtoupper("admin");
    $email = "admin@admin.com";
    $sueldo = "0.00";
    $avatar = "user_create.png";
    $password = sha1($cedula);

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
    $employ->bindParam(8, $codCargo);
    $employ->bindParam(9, $avatar);
    $employ->bindParam(10, $password);

    $employ->execute();
  }

  if($params->rowCount() == 0) {
    $paramQu = $pdo->query("INSERT INTO sgmeparam (eparam_id_eparam, eparam_cont_aguajes,
       eparam_cont_bodega, eparam_cont_invent, eparam_cont_img, eparam_cont_cargo, eparam_cont_prove,
       eparam_cont_orden, eparam_cont_tarea, eparam_cont_ped, eparam_cont_ruta, eparam_cont_tacom,
       eparam_cont_orin) 
       VALUES (1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0)");

  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edpacif</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="shortcut icon" href="assets/img/edpacif.ico" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="assets/css/material.css">
    <style>
      body{
        background-image: url('assets/img/fondo.png') !important;
        background-size: 100%;
        background-position-y: -23em;
      }
      .login-form legend{
        background: #2d7176 !important;
      }
      button{
            border-radius: inherit !important;
      }
    </style>
  </head>
  <body class="full-heigth center middle">
    <form class="form-horizontal white login-form">
      <legend class="text-center">Iniciar Session</legend>
      <fieldset>
        <div class="form-group">
          <label for="inputEmail" class="col-md-2 control-label">E-mail</label>
          <div class="col-md-10">
            <input type="email" name="email" class="form-control" id="inputEmail"
              placeholder="perez@gmail.com">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="col-md-2 control-label">Password</label>

          <div class="col-md-10">
            <input type="password" class="form-control" id="inputPassword" placeholder="Contraseña" name="password">
          </div>
        </div>

        <div class="form-group center">
            <button type="submit" class="btn ripple-effect btn-raised btn-primary"
              id="login-button">Inicar Sessión</button>
        </div>
      </fieldset>
    </form>
    <?php
    require "templates/alert.php";
    require "templates/info.php";
    ?>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="lib/jquery-toggles/toggles.js"></script>

    <script src="assets/js/quirk.js"></script>
    <script src="assets/js/material.min.js"></script>
    <script src="assets/js/ripples.min.js"></script>

    <script src="assets/js/validaciones.js"></script>
    <script src="assets/js/form_object.js"></script>
    <script src="assets/js/botones.js"></script>

    <script type="text/javascript">
      $.material.init()
    </script>
    <script type="text/javascript" src="assets/js/login.js"></script>
  </body>
</html>
