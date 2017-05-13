<?php 
  include "../../conexion/conexion.php";
  $id = $_GET["subarea"];
  $equipo = $pdo->query("SELECT * FROM smgeequi WHERE eequi_sare_eequi='$id'");
?>
<select id="equipo" class="form-control">
  <option value="">Selecione el equipo</option>
  <?php while($row = $equipo->fetch()){ ?>
  <option value="<?= $row["eequi_cod_eequi"] ?>"><?= $row["eequi_det_eequi"]?></option>
  <?php } ?>
</select>