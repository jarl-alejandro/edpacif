<?php include "../conexion/conexion.php";?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Perfil | Edpacif</title>
	<?php require '../head.php'; ?>
</head>
<body>
	<header>
		<?php include '../header.php'; ?>
	</header>
	<section>
		<div class="mainpanel">
			<div class="contentpanel">
				<div class="row">
					<div class="col-md-9 col-lg-8 dash-left">
						<h2 class="text-center no-margin title">Cambiar contraseña</h2>
					
						<div class="panel panel-site-traffic">
              <?php include "templates/form.php" ?>
						</div>

					</div>
					<?php require "../asider.php" ?>
				</div>
			</div>
		</div>
	</section>
	<?php
		require "../templates/alert.php";
		require "../templates/info.php";
		require "../scripts.php";
	?>
</body>
</html>
