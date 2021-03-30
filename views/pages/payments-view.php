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

	<?php include "./views/modules/menuPayments.php"; ?>


	<div class="row">
		<div class="col-12 col-m-12 col-sm-12">
			<div class="card">
				<div class="card-content">

					<form action="ajax/classAjax.php" class="form-class" method="post" autocomplete="off" class="formulario-ajax">
						<div class="header-class">
							<h1>Lista de Pagos</h1>
						</div>

						<div class="card-content">
							<p>Seleciona una fecha: <input class="input-class" type="date" name="fechaesperada"></p>

					</form>
					<div class="container-class">
						<button>Exportar</button>
					</div>
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

<script src="<?php echo SERVERURL; ?>assets/script/assistance.js"></script>