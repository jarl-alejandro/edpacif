<?php
session_start();
include "./conexion/conexion.php";
date_default_timezone_set('America/Guayaquil');

$id = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
$hoy = date("Y/m/d");
$count = 0;


$tareas = $pdo->query("SELECT * FROM v_tarea 
      WHERE etare_fet_etare='$hoy' AND eempl_ced_eempl='$id' AND
      (etare_est_etare='asginado' OR etare_est_etare='visto' OR etare_est_etare='pedido' OR etare_est_etare='aprobado' OR etare_est_etare='fecha')
      ORDER BY etare_pri_etare ASC");
?>
<table class="table table-bordered table-default table-striped nomargin"
       id="Tab_FilterTask">
  <thead class="success">
    <tr>
      <th>#</th>
      <th class="text-center">Codigo</th>
      <th class="text-center">Detalle</th>
      <th class="text-center" colspan="3">Accion</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($rows = $tareas->fetch()) { 
        $count++;
    ?>
      <tr style="background:<?= $rows['etare_col_etare']; ?>;color: white;">
        <td class=""><?= $count; ?></td>
        <td class=""><?= $rows["etare_cod_etare"]; ?></td>
        <td class=""><?= $rows["ltare_det_ltare"]; ?></td>
        <td class="space-around">
        <?php if($rows["etare_est_etare"] == 'pedido'){ ?>
          <button class="btn btn-raised btn-warning center button__little TareasPedidoByEmployee"
                data-id="<?= $rows["etare_cod_etare"]; ?>">
            <i class="fa fa-check" aria-hidden="true"></i>
          </button>
        <?php } else if($rows["etare_est_etare"] == 'aprobado'){ ?>
           <button class="btn btn-raised btn-primary center button__little TareasPedidoByEmployee"
                data-id="<?= $rows["etare_cod_etare"]; ?>">
            <i class="fa fa-flag-checkered" aria-hidden="true"></i>
          </button>
        <?php } else if($rows["etare_est_etare"] == 'fecha'){ ?>
           <button class="btn btn-raised btn-primary center button__little TareasPedidoByEmployee"
                data-id="<?= $rows["etare_cod_etare"]; ?>">
            <i class="fa fa-flag-checkered" aria-hidden="true"></i>
          </button>
        <?php } else{ ?>
          <button class="btn btn-raised btn-warning center button__little TareasVistoByEmployee"
                data-id="<?= $rows["etare_cod_etare"]; ?>">
            <i class="fa fa-check" aria-hidden="true"></i>
          </button>
        <?php } ?>
        </td>
      </tr>
     <?php } ?>
   </tbody>
</table>
<script src="../assets/js/task.js"></script>