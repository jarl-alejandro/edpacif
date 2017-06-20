<div class="LayoutHome">
  <section class="tareas-pendientes">
    <h3 class="tareas-pendientes__title">TAREAS PENDIENTES</h3>
    <article class="tareas-pendientes__card">
      <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
          <tr>
            <th>#</th>
            <th>CODIGO</th>
            <th>DETALLE</th>
            <th>ACCION</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $cedula = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
          $qs = $pdo->query("SELECT etare_cod_etare, ltare_det_ltare, etare_est_etare, etare_col_etare,
            eempl_ced_eempl FROM v_tarea WHERE etare_est_etare='asginado' AND eempl_ced_eempl='$cedula'");
          $index = 0;
          $count = $qs->rowCount();
          foreach ($qs as $row) {
            $index++;
        ?>
            <tr style="background:<?= $row['etare_col_etare']; ?>;color: white;">
              <td><?= $index ?></td>
              <td><?= $row['etare_cod_etare'] ?></td>
              <td><?= $row['ltare_det_ltare'] ?></td>
              <td>
                <button class="btn btn-raised btn-primary tareas-asigado-home"
                  data-id="<?= $row["etare_cod_etare"]; ?>">VER</button>
              </td>
            </tr>
        <?php
            if ($index == 2) break;
          }
        ?>
        </tbody>
      </table>
      <?php if ($count > 2){ ?>
      <div class="center">
        <button class="btn btn-raised btn-success" id="tareas-ver-mas" data-toggle="modal" data-target="#complete-dialog">VER MAS</button>
      </div>
      <?php } ?>
    </article>
  </section>

  <section class="orden-trabajo-pendientes">
  <h3 class="tareas-pendientes__title">ORDEN TRABAJO PENDIENTES</h3>
  <article class="tareas-pendientes__card">
    <table class="table table-striped table-hover table-bordered table-responsive">
      <thead>
        <tr>
          <th>#</th>
          <th>CODIGO</th>
          <th>DETALLE</th>
          <th>ACCION</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $qs = $pdo->query("SELECT eorin_cod_eorin, eorin_det_eorin, eorin_est_eorin, eorin_emp_eorin
          FROM sgmeorin WHERE eorin_est_eorin='asignado' AND eorin_emp_eorin='$cedula'");
        $index = 0;
        $count = $qs->rowCount();
        foreach ($qs as $row) {
          $index++;
      ?>
          <tr>
            <td><?= $index ?></td>
            <td><?= $row['eorin_cod_eorin'] ?></td>
            <td><?= $row['eorin_det_eorin'] ?></td>
            <td>
              <a href='../mis-ordenes-trabajo-interno?open=1&codigo=<?= $row['eorin_cod_eorin'] ?>' class="btn btn-raised btn-primary">VER</a>
            </td>
          </tr>
      <?php
          if ($index == 2) break;
        }
      ?>
      </tbody>
    </table>
    <?php if ($count > 2){ ?>
    <div class="center">
      <button class="btn btn-raised btn-success" data-target="#orden-trabajo-pendiente" data-toggle="modal">VER MAS</button>
    </div>
    <?php } ?>
  </article>
</section>
</div>
<!-- Tareas Pendientes -->
<section id="complete-dialog" class="modal fade in" tabindex="-1">
  <article class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2 class="modal-title title--modal">Tareas Pendientes</h2>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-hover table-bordered table-responsive">
          <thead>
            <tr>
              <th>#</th>
              <th>CODIGO</th>
              <th>DETALLE</th>
              <th>ACCION</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $qs = $pdo->query("SELECT etare_cod_etare, ltare_det_ltare, etare_est_etare, etare_col_etare,
               eempl_ced_eempl FROM v_tarea WHERE etare_est_etare='asginado' AND eempl_ced_eempl='$cedula'");
            $index = 0;
            $count = $qs->rowCount();
            foreach ($qs as $row) {
              $index++;
          ?>
              <tr style="background:<?= $row['etare_col_etare']; ?>;color: white;">
                <td><?= $index ?></td>
                <td><?= $row['etare_cod_etare'] ?></td>
                <td><?= $row['ltare_det_ltare'] ?></td>
                <td>
                  <button class="btn btn-raised btn-primary tareas-asigado-home"
                    data-id="<?= $row["etare_cod_etare"]; ?>">VER</button>
                </td>
              </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </article>
</section>
<!-- Fin de tareas pendientes -->

<!-- Orden Trabajo -->
<section id="orden-trabajo-pendiente" class="modal fade in" tabindex="-1">
  <article class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2 class="modal-title title--modal">Orden de trabajo pendiente</h2>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-hover table-bordered table-responsive">
          <thead>
            <tr>
              <th>#</th>
              <th>CODIGO</th>
              <th>DETALLE</th>
              <th>ACCION</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $qs = $pdo->query("SELECT eorin_cod_eorin, eorin_det_eorin, eorin_est_eorin, eorin_emp_eorin
              FROM sgmeorin WHERE eorin_est_eorin='asignado' AND eorin_emp_eorin='$cedula'");
            $index = 0;
            $count = $qs->rowCount();
            foreach ($qs as $row) {
              $index++;
          ?>
              <tr>
                <td><?= $index ?></td>
                <td><?= $row['eorin_cod_eorin'] ?></td>
                <td><?= $row['eorin_det_eorin'] ?></td>
                <td>
                  <a href='../mis-ordenes-trabajo-interno?open=1&codigo=<?= $row['eorin_cod_eorin'] ?>' class="btn btn-raised btn-primary">VER</a>
                </td>
              </tr>
          <?php
              if ($index == 2) break;
            }
          ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </article>
</section>
<!-- Fin de Orden Trabajo -->
