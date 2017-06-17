<?php
include '../conexion/conexion.php';

$id = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];
$nombre = $_SESSION["f9f011a553550aef31a8ee2690e1d1b5f261c9ff"];
$employeQuery = $pdo->query("SELECT * FROM v_empleados
                      WHERE eempl_ced_eempl='$id'");

$employee = $employeQuery->fetch();
?>
<div class="headerpanel">
  <!-- logopanel -->
  <div class="logopanel">
    <h2><a href="../">Edpacif</a></h2>
  </div>
  <!-- /logopanel -->
  <!-- headerbar -->
  <div class="headerbar">
    <a id="menuToggle" class="menutoggle Header-button--toolbar">
      <!-- <i class="fa fa-bars"></i> -->
      <span class="Header-icons--line"></span>
    </a>
    <div class="header-right">
      <ul class="headermenu">
        <li>
          <div class="btn-group no-margin">
            <button class="btn btn-logged" data-toggle="dropdown">
              <img src="../media/avatar/<?= $employee["eempl_ava_eempl"] ?>" alt="" />
              <?= $_SESSION["f9f011a553550aef31a8ee2690e1d1b5f261c9ff"]?>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right">
              <li>
                <a href="profile.html">
                  <i class="glyphicon glyphicon-user"></i>Acerca de ..
                </a>
              </li>
              <li>
                <a href="../perfil">
                  <i class="glyphicon glyphicon-cog"></i> Configuraciones
                </a>
              </li>
              <li>
                <a href="#"><i class="glyphicon glyphicon-question-sign">
                </i> Ayuda
              </a>
            </li>
            <li>
              <a href="../service/logout.php">
                <i class="glyphicon glyphicon-log-out"></i> Cerar Sesion
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>
<!-- /headerbar -->
</div>

<section>
  <div class="leftpanel">
    <div class="media leftpanel-profile">
      <div class="media-left">
        <a href="#">
          <img src="../media/avatar/<?= $employee["eempl_ava_eempl"] ?>" class="media-object img-circle" />

        </a>
      </div>
      <div class="media-body">

        <h4 class="media-heading">
          <?= $_SESSION["f9f011a553550aef31a8ee2690e1d1b5f261c9ff"]?>
          <a data-toggle="collapse" data-target="#loguserinfo" class="pull-right">
            <i class="fa fa-angle-down"></i>
          </a>
        </h4>
        <span>Cargo: <?= $employee["ecarg_det_ecarg"] ?></span>
      </div>
    </div>
    <!-- leftpanel-userinfo -->
    <div class="leftpanel-userinfo collapse" id="loguserinfo">
      <h5 class="sidebar-title">Direccion</h5>
      <address>
         <?= $employee["eempl_dir_eempl"] ?>
      </address>
      <h5 class="sidebar-title">Contacto</h5>
      <ul class="list-group">
        <li class="list-group-item">
          <label class="pull-left">Email</label>
          <span class="pull-right"> <?= $employee["eempl_mai_eempl"] ?></span>
        </li>
        <li class="list-group-item">
          <label class="pull-left">Casa</label>
          <span class="pull-right"> <?= $employee["eempl_tel_eempl"] ?></span>
        </li>
        <!-- <li class="list-group-item">
          <label class="pull-left">Celular</label>
          <span class="pull-right">+63012 3456 789</span>
        </li> -->
        <!-- <li class="list-group-item">
          <label class="pull-left">Social</label>
          <div class="social-icons pull-right">
            <a href="#"><i class="fa fa-facebook-official"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
          </div>
        </li> -->
      </ul>
    </div>
    <!-- /leftpanel-userinfo -->
    <!-- menu options -->
    <ul class="nav nav-tabs nav-justified nav-sidebar">
      <li class="tooltips active" data-toggle="tooltip" title="Main Menu">
        <a data-toggle="tab" data-target="#mainmenu">
          <i class="tooltips fa fa-ellipsis-h"></i>
        </a>
      </li>
      <li class="tooltips unread" data-toggle="tooltip" title="Check Mail">
        <a data-toggle="tab" data-target="#emailmenu">
          <i class="tooltips fa fa-envelope"></i>
        </a>
      </li>
      <li class="tooltips" data-toggle="tooltip" title="Contacts">
        <a data-toggle="tab" data-target="#contactmenu">
          <i class="fa fa-user"></i>
        </a>
      </li>
      <li class="tooltips" data-toggle="tooltip" title="Settings">
        <a data-toggle="tab" data-target="#settings">
          <i class="fa fa-cog"></i>
        </a>
      </li>
      <li class="tooltips" data-toggle="tooltip" title="Log Out">
        <a href="../service/logout.php">
          <i class="fa fa-sign-out"></i>
        </a>
      </li>
    </ul>
    <!-- menu options -->

    <!-- Tabs -->
    <div class="tab-content">
      <div class="tab-pane active" id="mainmenu">
        <h5 class="sidebar-title">Menu Principal</h5>
        <ul class="nav nav-pills nav-stacked nav-quirk">
            <li class="active">
              <a href="../">
                <i class="fa fa-home"></i> <span>Incio</span>
              </a>
            </li>
        </ul>
        <!-- MenuItems -->
        <ul class="nav nav-pills nav-stacked nav-quirk">
          <li class="nav-parent">
            <a href="#"><i class="fa fa-check-square"></i> <span>Archivo</span></a>
            <ul class="children">
              <!-- <li><a href="../roles">Cargos</a></li> -->
              <li><a href="../area-general">Area General</a></li>
              <li><a href="../area">Area</a></li>
              <li><a href="../sub-area">Sub Area</a></li>
              <li><a href="../proveedor">Proveedor</a></li>
              <li><a href="../empleado">Empleados</a></li>
              <li><a href="../cargo">Cargo</a></li>
              <li><a href="../aguajes">Aguajes</a></li>
              <li><a href="../bodega">Bodega</a></li>
              <li><a href="../inventario">Inventario</a></li>
              <li><a href="../herramienta">Herramienta</a></li>
              <li><a href="../equipos">Equipos</a></li>
              <li><a href="../listado-tareas">Listado tareas</a></li>
            </ul>
          </li>
          <li class="nav-parent">
            <a href="#"><i class="fa fa-suitcase"></i> <span>Procesos</span></a>
            <ul class="children">
              <li><a href="../ordenes-trabajo-interno">O.T. interno</a></li>
              <li><a href="../mis-ordenes-trabajo-interno">Mis O.T. interno</a></li>
              <li><a href="../ordenes-trabajo-externas">O.T. externas</a></li>
              <li><a href="../tareas">Tareas</a></li>
              <li><a href="../pedidos">Pedido</a></li>
              <li><a href="../rutas">Rutas</a></li>
              <li><a href="../hora-trabajo">Hora de trabajo</a></li>
              <li><a href="../entrega-herramientas">Entrega de Herramientas</a></li>
              <li><a href="../bajo-stock">Bajo Stock</a></li>
              <li><a href="../reporta-errores">Reporta daños</a></li>
              <li><a href="../listado-errores">Listado daños</a></li>
            </ul>
          </li>
          <li class="nav-parent">
            <a href="#"><i class="fa fa-file-text"></i> <span>Reportes</span></a>
            <ul class="children">

              <li><a href="../reportes-ordenes-trabajo-externas">Reporte O.T. Externa</a></li>
              <li><a href="../equipos-baja">Equipos de baja</a></li>
              <li><a href="../ordenes-asignadas">Ordenes asignadas</a></li>
              <li><a href="../ordenes-visto">Ordenes en visto</a></li>
              <li><a href="../ordenes-revisar">Ordenes por revisar</a></li>
              <li><a href="../ordenes-terminadas">Ordenes terminadas</a></li>
              <li><a href="../tareas-visto">Tareas visto</a></li>
              <li><a href="../tareas-revisar">Tareas revisar</a></li>
              <li><a href="../tareas-terminados">Tareas terminados</a></li>

              <li><a href="../ordenes-trabajo-interno-por-fecha">
                Ordenes trabajo interno por fecha
              </a></li>
              <li><a href="../tareas-por-fecha">Tareas por fecha</a></li>
              <li><a href="../listado-equipos">Listado de equipos</a></li>
            </ul>
          </li>
          <li class="nav-parent">
            <a href="#"><i class="fa fa-th-list"></i> <span>Estadisticas</span></a>
            <ul class="children">
              <li><a href="../estadistica-aguaje">Estadistica de Aguaje</a></li>
              <li><a href="../estadistica-bodega">Estadistica de bodega</a></li>
              <li><a href="../estadistica-mantenimeinto-equipos">Estadistica mantenimeinto equipos</a></li>
              <li><a href="../estadistica-ote-equipos">Estadistica mantenimeinto O.T.E</a></li>
              <li><a href="../estadistica-tareas-equipos">Estadistica mantenimeinto tareas</a></li>
            </ul>
          </li>
        </ul>
        <!-- MenuItems -->
      </div>

      <!-- emailmenu -->
      <div class="tab-pane" id="emailmenu">
        <div class="sidebar-btn-wrapper">
          <a href="compose.html" class="btn btn-danger btn-block">Compose</a>
        </div>

        <h5 class="sidebar-title">Mailboxes</h5>
        <ul class="nav nav-pills nav-stacked nav-quirk nav-mail">
          <li><a href="email.html"><i class="fa fa-inbox"></i> <span>Inbox (3)</span></a></li>
          <li><a href="email.html"><i class="fa fa-pencil"></i> <span>Draft (2)</span></a></li>
          <li><a href="email.html"><i class="fa fa-paper-plane"></i> <span>Sent</span></a></li>
        </ul>

        <h5 class="sidebar-title">Tags</h5>
        <ul class="nav nav-pills nav-stacked nav-quirk nav-label">
          <li><a href="#"><i class="fa fa-tags primary"></i> <span>Communication</span></a></li>
          <li><a href="#"><i class="fa fa-tags success"></i> <span>Updates</span></a></li>
          <li><a href="#"><i class="fa fa-tags warning"></i> <span>Promotions</span></a></li>
          <li><a href="#"><i class="fa fa-tags danger"></i> <span>Social</span></a></li>
        </ul>
      </div>
      <!-- /emailmenu -->

      <!-- contactmenu -->
      <div class="tab-pane" id="contactmenu">
        <div class="form-group">
          <div class="col-md-10">
            <input type="email" class="form-control" id="inputEmail" placeholder="Buscar Empleados">
          </div>
        </div>
        <h5 class="sidebar-title padding-top">Lista de Empleados</h5>
        <ul class="media-list media-list-contacts"></ul>
      </div>
      <!-- /contactmenu -->

      <!-- settings -->
      <div class="tab-pane" id="settings">
        <h5 class="sidebar-title">Parametros</h5>
        <ul class="list-group list-group-settings">
          <li class="list-group-item">
            <h5>Asignar contraseñas</h5>
            <small>Get notified when someone else is trying to access your account.</small>
            <div class="toggle-wrapper">
              <div class="leftpanel-toggle toggle-light success"></div>
            </div>
          </li>
          <li class="list-group-item">
            <h5>OTROS</h5>
            <small>Make calls to friends and family right from your account.</small>
            <div class="toggle-wrapper">
              <div class="leftpanel-toggle-off toggle-light success"></div>
            </div>
          </li>
        </ul>
        <h5 class="sidebar-title">Security Settings</h5>
        <ul class="list-group list-group-settings">
          <li class="list-group-item">
            <h5>Login Notifications</h5>
            <small>Get notified when someone else is trying to access your account.</small>
            <div class="toggle-wrapper">
              <div class="leftpanel-toggle toggle-light success"></div>
            </div>
          </li>
          <li class="list-group-item">
            <h5>Phone Approvals</h5>
            <small>Use your phone when login as an extra layer of security.</small>
            <div class="toggle-wrapper">
              <div class="leftpanel-toggle toggle-light success"></div>
            </div>
          </li>
        </ul>
      </div>
      <!-- /settings -->

    </div>
    <!-- /Tabs -->

  </div>
</section>
