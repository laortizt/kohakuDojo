<?php
require_once "./controller/controllerPayment.php";
$insPayment = new controllerPayment();
?>

<!--  -->
<div class="container-fluid">
	<div class="row-gutters">
		<div class="col-6 col-sm-12">
			<!--Grafica-->
			<div class="col-lg-6 col-md-12">
				<div class="card mb-30">
					<div class="header-class">
						<h1 class="title">Reporte mensual</h1>
						
					</div>

					<div class="card-body">
						<div id="client-recollection-chart" class="extra-margin"></div>

						<?php echo $insPayment->get_users_by_month_chart() ?>
					</div>
				</div>
			</div>
		</div>

		<!-- formulario -->
		<div class="col-6 col-sm-12">
			<div class="info-stats4">

				<form action="ajax/newPayAjax.php" method="post" autocomplete="off" class="payment-form formulario-ajax">
					
					<div class="header-class">
						<h1 class="title">Registar Trámite</h1>
					</div>

					<div class="payment">
						<?php
							$today = date_create('now');
						?>

						<div class="col-6">
							<label class="label-form">Fecha</label>
							<div class="input-field-profile">
								<i class="fas fa-calendar-alt"></i>
								<input type="date" name="classDate" required="" min="<?= date_format($today, 'Y-m-d') ?>">
							</div>
						</div>

						<!-- <div class="col-6">
							<label class="label">Fecha</label>
							<div class="input-field-profile">
								<input type="date" name="date-newpay" required="" />
							</div>
						</div> -->

						<div class="col-6">
							<label class="label">Documento</label>
							<div class="input-field-profile">
								<input type="texbox" name="dni-newpay" minlength="1" maxlength="100" />
							</div>
						</div>

						<div class="col-6">
							<label class="label">Trámite</label>
							<?php echo $insPayment->list_procedure_controller() ?>
						</div>

						<div class="col-6">
							<label class="label">Valor</label>
							<div class="input-field-profile">
								<input type="text" readonly value="" id="price-newpay" name="price-newpay" required="" />
							</div>
						</div>
						

					</div>

					<input type="submit" class="btn-action-save" value="Guardar" />

					<div class="RespuestaAjax"></div>
			</form>
				
			</div>
		</div>
	</div>
</div>


<div class="row privileges">
	<div class="col-12 col-m-12 col-sm-12">
		<div class="card">
			<div class="card-content">
				
				<div class="header-class">
				<h1 class="title">Gestión de Trámites</h1>

					<div class="barra__buscador">
					<?php
							require_once "./controller/controllerAdmin.php";
							$insAdmin = new controllerAdmin();
						?>

						<form action="ajax/searchAjax.php" class="formulario" method="post" form-data="default" form-data="default" autocomplete="off" enctype="multipart/form-data">
							<div>
								<input type="hidden" name="search_page" id="search_page" value="adminSchedule">
								<input type="text" name="search_class" id="search_class" placeholder="Buscar nombre" value="<?= isset($_SESSION['searchClass']) ? $_SESSION['searchClass'] : '' ?>" class="text-search">
								<button href="#" type="submit" value="Search" name="button-search" class="btn-search">
									<i class="fa bi bi-search"></i>
								</button>
							</div>
							<div class="RespuestaAjax"></div>
						</form>
						
					</div>

				</div>

				<?php
					$pageNumber = 1;

					if (isset($_GET)) {
						$pages = explode("/", $_GET['page']);
						if (count($pages) >= 3) {
							$p = intval($pages[2]);
							if ($p > 1) {
								$pageNumber = $p;
							}
						}
					}

					echo $insPayment->pages_payment_controller($pageNumber, 10, $_SESSION['role_sk'], $_SESSION['code_sk'], "");
				?>

			</div>

		</div>

	</div>

</div>
