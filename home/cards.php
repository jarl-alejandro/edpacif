<?php
$id = $_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"];

$ordenes = $pdo->query("SELECT * FROM sgmeorin WHERE eorin_est_eorin='asignado'
	AND eorin_emp_eorin='$id'");
$countOrden = $ordenes->rowCount();

$task = $pdo->query("SELECT * FROM sgmetare WHERE etare_est_etare='asginado' AND etare_emp_etare='$id'");
$countTask = $task->rowCount();
?>
<article class="col-xs-10 col-md-5 cardHome">
	<?php
		if ($countTask == 0) {
			echo '<a>No Tienes Tareas pendientes</a>';
		}
		else {
			echo '<a class="activeHome">Tienes '.$countTask.' Tareas pendientes</a>';
		}
	?>
</article>
<article class="col-xs-10 col-md-5 cardHome">
<?php
 	if ($countOrden == 0) {
 		echo '<a href="#">No Tienes O.T Interna pendientes</a>';
 	}else {
 		echo '<a href="../mis-ordenes-trabajo-interno/" class="activeHome">Tienes '.$countOrden.' O.T Interna pendientes</a>';
 	}
 ?>
</article>
