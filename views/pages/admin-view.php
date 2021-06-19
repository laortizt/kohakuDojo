<?php
	require_once "./controller/controllerAdmin.php";
	$insAdmin = new controllerAdmin();
?>

<!-- Bienvenida -->
<div class="welcome-area">
	<div class="row m-0 align-items-center welcome-container">
		<div class="col-lg-5 col-md-12 p-0">
			<div class="welcome-content">
				<h1 class="mb-2">Hola, <?php echo $_SESSION['userfirstname_sk'] ?></h1>
				<p class="mb-0">¡Un gusto tenerte de vuelta!</p>
			</div>
		</div>

		<div class="col-lg-7 col-md-12 p-0">
			<div class="welcome-img">
				<!-- <img src="assets/img/welcome-img.png" alt="image"> -->
				<!-- <img src="assets/img/banner2.png" alt="image"> -->
				<img src="assets/img/banner4.png" alt="image">
			</div>
		</div>
	</div>
</div>


<!--Grafica-->
<!-- <div class="col-lg-6 col-md-12">
	<div class="card mb-30">
		<div class="card-header">
			<h3>Reporte Mensual</h3>
		</div>

		<div class="card-body">
			<div id="client-recollection-chart" class="extra-margin"></div>

			<?php echo $insAdmin->get_users_by_month_chart() ?>
		</div>
	</div>
</div> -->

<!--tabla-->
<div class="row privileges">
	<div class="col-12 col-m-12 col-sm-12">
		<div class="card">
			<div class="card-content">
				<div class="header-class">
					<h1 class="title">Administar usuarios</h1>

					<div class="barra__buscador">
						<?php
							require_once "./controller/controllerAdmin.php";
							$insAdmin = new controllerAdmin();
						?>

						<form action="ajax/searchAjax.php" class="formulario" method="post" form-data="default" form-data="default" autocomplete="off" enctype="multipart/form-data">
							<div>
								<input type="hidden" name="search_page" id="search_page" value="admin">
								<input type="text" name="search_user" id="search_user" placeholder="Buscar nombre o apellidos" value="<?= isset($_SESSION['searchUser']) ? $_SESSION['searchUser'] : '' ?>" class="text-search">
								<button href="#" type="submit" value="Search" name="button-search" class="btn-search">
									<i class="fa bi bi-search"></i>
								</button>
							</div>
							<div class="RespuestaAjax"></div>
						</form>
					</div>
				</div>

				<!-- DESDE AQUI -->
				<?php
					$pageNumber = 1;

					if (isset($_GET)) {
						$pages = explode("/", $_GET['page']);
						if (count($pages) >= 3) {
							$p = intval($pages[1],10);
							if ($p > 1) {
								$pageNumber = $p;
							}
						}
					}

					echo $insAdmin->pages_admin_controller($pageNumber, 10, $_SESSION['role_sk'], $_SESSION['code_sk'], "");
				?>
			</div>
			<!-- DIVS  -->
		</div>
	</div>
</div>

<script defer src="<?php echo SERVERURL; ?>assets/script/admin.js"></script>