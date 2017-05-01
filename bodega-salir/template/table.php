<?php include "../../conexion/conexion.php";?>

<table class="table table-bordered table-default table-striped nomargin">
  <thead class="success">
    <tr>
      <th width="20%">Codigo</th>
      <th width="30%" class="text-center">Bodega</th>
      <th width="40%" class="text-center">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $id = 0;
    $departamento = $pdo->query("SELECT * FROM sgmebod");
    while ($rows = $departamento->fetch()) {
      $id++;
    ?>
      <tr>
        <td class="principal-cuenta"><?= $rows["ebod_cod_ebod"]; ?></td>
        <td class="principal-cuenta"><?= $rows["ebod_det_ebod"]; ?></td>
        <td class="space-around">
          <button class="btn btn-primary editar"
            data-id="<?= $rows["ebod_cod_ebod"]; ?>">
            <i class="fa fa-pencil text-medium"></i>
          </button>
          <button class="btn btn-danger eliminar"
            data-id="<?= $rows["ebod_cod_ebod"]; ?>">
            <i class="fa fa-trash text-medium"></i>
          </button>
          <button class="btn btn-info imprimir"
            data-id="<?= $rows["ebod_cod_ebod"]; ?>">
            <i class="fa fa-print text-medium"></i>
          </button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script type="text/javascript" src="app/app.js"></script>
