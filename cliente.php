<?php include "conexion\conexion.php";?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themetrace.com/demo/quirk/templates/index.html by HTTrack Website Copier/3.x [XR&CO'2010], Sun, 27 Nov 2016 14:50:56 GMT -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--<link rel="shortcut icon" href="images/favicon.png" type="image/png">-->

  <title>Empleado | EdPacif</title>

  <link rel="stylesheet" href="lib/Hover/hover.css">
  <link rel="stylesheet" href="lib/fontawesome/css/font-awesome.css">
  <link rel="stylesheet" href="lib/weather-icons/css/weather-icons.css">
  <link rel="stylesheet" href="lib/ionicons/css/ionicons.css">
  <link rel="stylesheet" href="lib/jquery-toggles/toggles-full.css">
  <link rel="stylesheet" href="lib/morrisjs/morris.css">

  <link rel="stylesheet" href="css/quirk.css">
  <link rel="stylesheet" href="assets/css/materialize.min.css">

  <script src="lib/modernizr/modernizr.js"></script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="lib/html5shiv/html5shiv.js"></script>
  <script src="lib/respond/respond.src.js"></script>
  <![endif]-->
</head>
<body>
<header>
</header>

<section>
<div class="mainpanel">
  <div class="contentpanel">
    <div class="row">
      <div class="col-md-9 col-lg-8 dash-left">

          <div class="panel panel-announcement">
            <ul class="panel-options">
              <li><a><i class="fa fa-refresh"></i></a></li>
              <li><a class="panel-remove"><i class="fa fa-remove"></i></a></li>
            </ul>
            </div><!-- panel -->
            <div class="panel panel-site-traffic">
              <div class="table-responsive">
                      <button class="btn waves-effect waves-ligh">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                      </button>
                      <button class="btn red waves-effect waves-light">
                        <i class="fa fa-minus" aria-hidden="true"></i>
                      </button>
                      <button class="btn waves-effect waves-light">
                        <i class="fa fa-fast-forward"></i>
                      </button>

                      <table class="table table-bordered table-default table-striped nomargin">
                        <thead class="success">
                          <tr>
                            <th>Empleado</th>
                            <th class="text-right">Direccion</th>
                            <th class="text-right">Telefono</th>
                            <th class="text-right">Estado</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php $proveedor=$pdo->query("SELECT * FROM ep_empleado");
                          while ($rows=$proveedor->fetch()) {
                        ?>
                          <tr>
                            <td class="mdl-data-table__cell--non-numeric"><?php echo $rows["no_empleado"]." ".$rows["ap_empleado"] ?></td>
                                 <td class="mdl-data-table__cell--non-numeric"><?php echo $rows["ap_empleado"]; ?></td>
                                 <td class="mdl-data-table__cell--non-numeric"><?php echo $rows["te_empleado"]; ?></td>
                                <td class="mdl-data-table__cell--non-numeric">

                                  <button class="mdl-button mdl-js-button mdl-js-ripple-effect" onclick="editar_proveedor('<?= $rows["id_empleado"] ?>')">
                                    <i class="material-icons">border_color</i>
                                  </button>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                </div><!-- table-responsive -->
            </div><!-- panel aqui-->

        </div><!-- col-md-9 -->
            </div><!-- col-md-12 -->
            </div><!-- col-md-12 -->
          </div><!-- row -->
        </section>

<script src="lib/jquery/jquery.js"></script>
<script src="lib/jquery-ui/jquery-ui.js"></script>
<script src="lib/bootstrap/js/bootstrap.js"></script>
<script src="lib/jquery-toggles/toggles.js"></script>

<script src="lib/morrisjs/morris.js"></script>
<script src="lib/raphael/raphael.js"></script>

<script src="lib/flot/jquery.flot.js"></script>
<script src="lib/flot/jquery.flot.resize.js"></script>
<script src="lib/flot-spline/jquery.flot.spline.js"></script>

<script src="lib/jquery-knob/jquery.knob.js"></script>

<script src="js/quirk.js"></script>
<script src="js/dashboard.js"></script>
<script type="text/javascript" src="assets/css/materialize.min.css"></script>

</body>

</html>
