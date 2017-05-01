<?php include "../../conexion/conexion.php";?>
<select id="secundaria" class="form-control">
  <option value="">Seleciona la cuenta</option>
  <?php
    $departamentos = $pdo->query("SELECT * FROM ep_departamento WHERE est_depart='principal'");
    foreach ($departamentos as $key):
  ?>
  <option value="<?= $key["cod_depart"] ?>"><?= $key["des_depart"] ?></option>
<?php endforeach ?>
</select>