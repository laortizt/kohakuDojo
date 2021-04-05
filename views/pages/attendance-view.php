<?php
require_once "./controller/controllerAdmin.php";
$insAdmin = new controllerAdmin();
?>

<!-- CMABIAR POR EL CONTROLADOR DE ASISTENCIA -->

<!-- <?php
		require_once "./controller/controllerClass.php";
		$insClass = new controllerClass();
		?> -->

<div class="container-fluid">

	<?php include "./views/modules/menuClass.php"; ?>

	<div class="row">
		<div class="col-12 col-m-12 col-sm-12">
			<div class="card attendance">
				<div class="card-content">
					<div class="header-class">
						<h1>Asistencia</h1>
						<div class="container-class">
							<button class="btn-kohaku"> Exportar</button>
						</div>
					</div>
					<form action="ajax/classAjax.php" class="form-class" method="post" autocomplete="off" class="formulario-ajax">
						<div class="card-content">
							<p>Seleciona una fecha: <input class="input-class" type="date" name="fechaesperada"></p>
							
					
				</div>

				<?php
				$pages = explode("/", $_GET['page']);
				// echo $insAdmin->pages_admin_controller($pages[1], 10, $_SESSION['role_sk'], $_SESSION['code']);
				echo $insAdmin->pages_admin_controller(0, 10, $_SESSION['role_sk'], 'code');
				?>
			</div>

			<div class="RespuestaAjax"></div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo SERVERURL; ?>assets/script/attendance.js"></script>