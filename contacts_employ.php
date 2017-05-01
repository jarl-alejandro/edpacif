<?php
 include "./conexion/conexion.php";

 $empleados = $pdo->query("SELECT * FROM sgmeempl");
 foreach ($empleados as $key):
?>
  <li class="media">
    <a href="#">
      <div class="media-left">
        <img class="media-object img-circle"
        src="../media/avatar/<?= $key["eempl_ava_eempl"] ?>" />
      </div>
      <div class="media-body">
        <h4 class="media-heading">
          <?= $key["eempl_nom_eempl"]." ".$key["eempl_ape_eempl"] ?>
        </h4>
        <span><i class="fa fa-phone"></i> <?= $key["eempl_tel_eempl"] ?></span>
      </div>
    </a>
  </li>
<?php endforeach ?>
