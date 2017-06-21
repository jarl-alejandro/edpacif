<div class="LayoutHome">
  <section class="tareas-pendientes">
    <h3 class="tareas-pendientes__title">STOCK MINIMO REPUESTOS</h3>
    <article class="tareas-pendientes__card">
      <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
          <tr>
            <th>#</th>
            <th>CODIGO</th>
            <th>DETALLE</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $cedula = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
            $qs = $pdo->query("SELECT * FROM v_ba_stock_inventario");
            $index = 0;
            $count = $qs->rowCount();
            foreach ($qs as $row) {
              $index++;
          ?>
              <tr>
                <td><?= $index ?></td>
                <td><?= $row['einven_cod_einven'] ?></td>
                <td><?= $row['einven_pro_einven'] ?></td>
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
  <section class="tareas-pendientes">
    <h3 class="tareas-pendientes__title">STOCK MINIMO HERRAMIENTAS</h3>
    <article class="tareas-pendientes__card">
      <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
          <tr>
            <th>#</th>
            <th>CODIGO</th>
            <th>DETALLE</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $cedula = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
            $qs = $pdo->query("SELECT * FROM v_bajostock_herramienta");
            $index = 0;
            $count = $qs->rowCount();
            foreach ($qs as $row) {
              $index++;
          ?>
              <tr>
                <td><?= $index ?></td>
                <td><?= $row['doih_herr_doih'] ?></td>
                <td><?= $row['herramienta'] ?></td>
              </tr>
          <?php
              if ($index == 2) break;
            }
          ?>
        </tbody>
      </table>
      <?php if ($count > 2){ ?>
      <div class="center">
        <button class="btn btn-raised btn-success" id="tareas-ver-mas" data-toggle="modal" data-target="#stock-herramientas">VER MAS</button>
      </div>
      <?php } ?>
    </article>
  </section>
</div>

<div class="LayoutHome" style="margin-top:1em">
  <section class="tareas-pendientes">
    <h3 class="tareas-pendientes__title">HERRMIENTAS POR DEVOLVER</h3>
    <article class="tareas-pendientes__card">
      <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
          <tr>
            <th>#</th>
            <th>CODIGO</th>
            <th>DETALLE</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $qs = $pdo->query("SELECT * FROM view_herramienta WHERE doih_esta_doih IS NULL");
          $index = 0;
          $count = $qs->rowCount();
          foreach ($qs as $row) {
            $index++;
            ?>
            <tr>
              <td><?= $index ?></td>
              <td><?= $row['doih_herr_doih'] ?></td>
              <td><?= $row['eherr_det_eherr'] ?></td>
            </tr>
            <?php
            if ($index == 2) break;
          }
          ?>
        </tbody>
      </table>
      <?php if ($count > 2){ ?>
        <div class="center">
          <button class="btn btn-raised btn-success" id="tareas-ver-mas" data-toggle="modal" data-target="#herramienta-devolver">VER MAS</button>
        </div>
      <?php } ?>
    </article>
  </section>
  <section class="tareas-pendientes">
    <h3 class="tareas-pendientes__title">HERRMIENTAS DEVUELTAS</h3>
    <article class="tareas-pendientes__card">
      <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
          <tr>
            <th>#</th>
            <th>CODIGO</th>
            <th>DETALLE</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $qs = $pdo->query("SELECT * FROM view_herramienta WHERE doih_esta_doih='entregado'");
          $index = 0;
          $count = $qs->rowCount();
          foreach ($qs as $row) {
            $index++;
            ?>
            <tr>
              <td><?= $index ?></td>
              <td><?= $row['doih_herr_doih'] ?></td>
              <td><?= $row['eherr_det_eherr'] ?></td>
            </tr>
            <?php
            if ($index == 2) break;
          }
          ?>
        </tbody>
      </table>
      <?php if ($count > 2){ ?>
        <div class="center">
          <button class="btn btn-raised btn-success" id="tareas-ver-mas" data-toggle="modal" data-target="#herramienta-entrgadas">VER MAS</button>
        </div>
      <?php } ?>
    </article>
  </section>
</div>

<!-- Tareas Pendientes -->
<section id="herramienta-entrgadas" class="modal fade in" tabindex="-1">
  <article class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2 class="modal-title title--modal">HERRAMIENTAS DEVUELTAS</h2>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-hover table-bordered table-responsive">
          <thead>
            <tr>
              <th>#</th>
              <th>CODIGO</th>
              <th>DETALLE</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $qs = $pdo->query("SELECT * FROM view_herramienta WHERE doih_esta_doih='entregado'");
            $index = 0;
            $count = $qs->rowCount();
            foreach ($qs as $row) {
              $index++;
          ?>
              <tr>
                <td><?= $index ?></td>
                <td><?= $row['doih_herr_doih'] ?></td>
                <td><?= $row['eherr_det_eherr'] ?></td>
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

<!-- Tareas Pendientes -->
<section id="herramienta-devolver" class="modal fade in" tabindex="-1">
  <article class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2 class="modal-title title--modal">HERRAMIENTAS POR DEVOLVER</h2>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-hover table-bordered table-responsive">
          <thead>
            <tr>
              <th>#</th>
              <th>CODIGO</th>
              <th>DETALLE</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $qs = $pdo->query("SELECT * FROM view_herramienta WHERE doih_esta_doih IS NULL");
            $index = 0;
            $count = $qs->rowCount();
            foreach ($qs as $row) {
              $index++;
          ?>
              <tr>
                <td><?= $index ?></td>
                <td><?= $row['doih_herr_doih'] ?></td>
                <td><?= $row['eherr_det_eherr'] ?></td>
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

<!-- Tareas Pendientes -->
<section id="complete-dialog" class="modal fade in" tabindex="-1">
  <article class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2 class="modal-title title--modal">STOCK MINIMO DE HERRAMIENTAS</h2>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-hover table-bordered table-responsive">
          <thead>
            <tr>
              <th>#</th>
              <th>CODIGO</th>
              <th>DETALLE</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $qs = $pdo->query("SELECT * FROM v_ba_stock_inventario");
            $index = 0;
            $count = $qs->rowCount();
            foreach ($qs as $row) {
              $index++;
          ?>
              <tr>
                <td><?= $index ?></td>
                <td><?= $row['einven_cod_einven'] ?></td>
                <td><?= $row['einven_pro_einven'] ?></td>
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

<!-- Tareas Pendientes -->
<section id="stock-herramientas" class="modal fade in" tabindex="-1">
  <article class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2 class="modal-title title--modal">STOCK MINIMO DE HERRAMIENTAS</h2>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-hover table-bordered table-responsive">
          <thead>
            <tr>
              <th>#</th>
              <th>CODIGO</th>
              <th>DETALLE</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $qs = $pdo->query("SELECT * FROM v_bajostock_herramienta");
            $index = 0;
            $count = $qs->rowCount();
            foreach ($qs as $row) {
              $index++;
          ?>
              <tr>
                <td><?= $index ?></td>
                <td><?= $row['doih_herr_doih'] ?></td>
                <td><?= $row['herramienta'] ?></td>
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
