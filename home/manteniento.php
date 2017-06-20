<div class="LayoutHome">
  <section class="tareas-pendientes">
    <h3 class="tareas-pendientes__title">TAREAS POR APROBAR</h3>
    <article class="tareas-pendientes__card">
      <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
          <tr>
            <th>#</th>
            <th>DETALLE</th>
            <th>ACCION</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $cedula = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
            $qs = $pdo->query("SELECT etare_cod_etare, ltare_det_ltare, etare_est_etare, etare_col_etare,
              eempl_ced_eempl FROM v_tarea WHERE etare_est_etare='visto' AND eempl_ced_eempl='$cedula'");
            $index = 0;
            $count = $qs->rowCount();
            foreach ($qs as $row) {
              $index++;
          ?>
              <tr style="background:<?= $row['etare_col_etare']; ?>;color: white;">
                <td><?= $index ?></td>
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
      <div class="center">
        <button class="btn btn-raised btn-success" id="tareas-ver-mas" data-toggle="modal"
          data-target="#complete-dialog">VER MAS</button>
      </div>
    </article>
  </section>

  <section class="orden-trabajo-pendientes">
    <h3 class="tareas-pendientes__title">ORDEN TRABAJO PENDIENTES</h3>
    <article class="tareas-pendientes__card">
      <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
          <tr>
            <th>#</th>
            <th>DETALLE</th>
            <th>ACCION</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $qs = $pdo->query("SELECT eorin_cod_eorin, eorin_det_eorin, eorin_est_eorin, eorin_emp_eorin
            FROM sgmeorin WHERE eorin_est_eorin='pedido' AND eorin_emp_eorin='$cedula'");
          $index = 0;
          $count = $qs->rowCount();
          foreach ($qs as $row) {
            $index++;
        ?>
            <tr>
              <td><?= $index ?></td>
              <td><?= $row['eorin_det_eorin'] ?></td>
              <td>
                <a href='../ordenes-trabajo-interno?open=1&codigo=<?= $row['eorin_cod_eorin'] ?>' class="btn btn-raised btn-primary">VER</a>
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

<div class="LayoutHome" style="margin-top:1em;">
  <section class="tareas-pendientes">
    <h3 class="tareas-pendientes__title">PEDIDOS PENDIENTES</h3>
    <article class="tareas-pendientes__card">
      <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
          <tr>
            <th>#</th>
            <th>DETALLE</th>
            <th>ACCION</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $qs = $pdo->query("SELECT eorin_cod_eorin, eorin_det_eorin, eorin_est_eorin, eorin_emp_eorin
            FROM sgmeorin WHERE eorin_est_eorin='proceso' AND eorin_emp_eorin='$cedula'");
          $index = 0;
          $count = $qs->rowCount();
          foreach ($qs as $row) {
            $index++;
        ?>
            <tr>
              <td><?= $index ?></td>
              <td><?= $row['eorin_det_eorin'] ?></td>
              <td>
                <a href='../ordenes-trabajo-interno?open=1&codigo=<?= $row['eorin_cod_eorin'] ?>' class="btn btn-raised btn-primary">VER</a>
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
        <button class="btn btn-raised btn-success" data-target="#pedidos-pendientes-modal" data-toggle="modal">VER MAS</button>
      </div>
      <?php } ?>
    </article>
  </section>

  <section class="tareas-pendientes">
    <h3 class="tareas-pendientes__title">ORDENES DE TRABAJO EXTERNA POR APROBAR</h3>
    <article class="tareas-pendientes__card">
      <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
          <tr>
            <th>#</th>
            <th>DETALLE</th>
            <th>ACCION</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $qs = $pdo->query("SELECT * FROM sgmeorex WHERE eorex_est_eorex='envio'");
          $index = 0;
          $count = $qs->rowCount();
          foreach ($qs as $row) {
            $index++;
        ?>
            <tr>
              <td><?= $index ?></td>
              <td><?= $row['eorex_det_eorex'] ?></td>
              <td>
                <a href='../ordenes-trabajo-externas?open=1&codigo=<?= $row['eorex_cod_eorex'] ?>' class="btn btn-raised btn-primary">VER</a>
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
        <button class="btn btn-raised btn-success" data-target="#pedidos-pendientes-modal" data-toggle="modal">VER MAS</button>
      </div>
      <?php } ?>
    </article>
  </section>
</div>
<!-- Tareas por aprobar -->
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
              <th>DETALLE</th>
              <th>ACCION</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $qs = $pdo->query("SELECT etare_cod_etare, ltare_det_ltare, etare_est_etare, etare_col_etare,
               eempl_ced_eempl FROM v_tarea WHERE etare_est_etare='visto' AND eempl_ced_eempl='$cedula'");
            $index = 0;
            $count = $qs->rowCount();
            foreach ($qs as $row) {
              $index++;
          ?>
              <tr style="background:<?= $row['etare_col_etare']; ?>;color: white;">
                <td><?= $index ?></td>
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
<!-- Fin de tareas por aprobar -->

<!-- Orden Trabajo -->
<section id="orden-trabajo-pendiente" class="modal fade in" tabindex="-1">
  <article class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2 class="modal-title title--modal">Orden de trabajo por aprobar</h2>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-hover table-bordered table-responsive">
          <thead>
            <tr>
              <th>#</th>
              <th>DETALLE</th>
              <th>ACCION</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $qs = $pdo->query("SELECT eorin_cod_eorin, eorin_det_eorin, eorin_est_eorin, eorin_emp_eorin
              FROM sgmeorin WHERE eorin_est_eorin='pedido' AND eorin_emp_eorin='$cedula'");
            $index = 0;
            $count = $qs->rowCount();
            foreach ($qs as $row) {
              $index++;
          ?>
              <tr>
                <td><?= $index ?></td>
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

<!-- pedidos pendientes -->
<section id="pedidos-pendientes-modal" class="modal fade in" tabindex="-1">
  <article class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2 class="modal-title title--modal">Pedidos pendientes</h2>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-hover table-bordered table-responsive">
          <thead>
            <tr>
              <th>#</th>
              <th>DETALLE</th>
              <th>ACCION</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $qs = $pdo->query("SELECT eorin_cod_eorin, eorin_det_eorin, eorin_est_eorin, eorin_emp_eorin
              FROM sgmeorin WHERE eorin_est_eorin='proceso' AND eorin_emp_eorin='$cedula'");
            $index = 0;
            $count = $qs->rowCount();
            foreach ($qs as $row) {
              $index++;
          ?>
              <tr>
                <td><?= $index ?></td>
                <td><?= $row['eorin_det_eorin'] ?></td>
                <td>
                  <a href='../ordenes-trabajo-interno?open=1&codigo=<?= $row['eorin_cod_eorin'] ?>' class="btn btn-raised btn-primary">VER</a>
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
<!-- Fin de pedidos pendientes -->
