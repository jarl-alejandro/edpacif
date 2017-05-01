<?php
include "../../conexion/conexion.php";
$id = $_GET["id"];
$tareas = $pdo->query("SELECT * FROM sgmeltare WHERE ltare_suba_ltare='$id'");
?>

<select id="detalleTask" class="form-control" name="detalle">
  <option value="">Selecione la tarea</option>
  <?php
    while ($row = $tareas->fetch()) { ?>
    <option value="<?=$row['ltare_cod_ltare']?>">
      <?= $row["ltare_det_ltare"] ?>
    </option>
  <?php } ?>
</select>