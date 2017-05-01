<?php
include "../../conexion/conexion.php";
$id = $_GET["id"];
?>
<select class="form-control" id="subarea">
  <option value="">Selecciona la subarea</option>
  <?php
  $subarea = $pdo->query("SELECT * FROM sgmesuba WHERE subare_are_subare='$id'");
  while ($row = $subarea->fetch()) {
  ?>
  <option value="<?=$row["subare_cod_subare"]?>">
    <?=$row["subare_det_subare"]?>
  </option>
  <?php } ?>
</select>