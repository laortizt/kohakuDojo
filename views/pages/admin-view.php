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
				<img src="assets/img/welcome-img.png" alt="image">
			</div>
		</div>
	</div>
</div>

<!-- divs informaciòn -->
<div class="container-report">
	<div class="row-gutters">
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color1">
					<i class="fa   fa-users"></i>
				</div>
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_students() ?></h3>
					<p>Alumnos</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color2">
					<i class="fa fa-graduation-cap"></i>
				</div>
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>Instructores</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color3">
					<i class="fa fa-unlock-alt"></i>
				</div>
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_admin() ?></h3>
					<p>Administradores</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color4">
					<i class="fas  fa-tasks"></i>
				</div>
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_allRegisters() ?></h3>
					<p>Total Usuarios</p>
				</div>
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
								<input type="text" name="search_user" id="search_user" placeholder="Buscar nombre o apellidos" value="" class="text-search">
								<button href="#" type="submit" value="Buscar" name="button-search" class="btn-search"><i class="fa bi bi-search"></i></button>
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
							$p = intval($pages[2]);
							if ($p > 1) {
								$pageNumber = $p;
							}
						}
					}

					echo $insAdmin->pages_admin_controller($pageNumber, 10, $_SESSION['role_sk'], $_SESSION['code_sk']);
				?>

				<nav class="text-center">
					<ul class="pagination pagination-sm">
						<li class="disabled"><a href="javascript:void(0)">«</a></li>
						<li class="active"><a href="<?php echo SERVERURL; ?>admin/page/1">1</a></li>
						<li><a href="<?php echo SERVERURL; ?>admin/page/2">2</a></li>
						<li><a href="<?php echo SERVERURL; ?>admin/page/3">3</a></li>
						<li><a href="<?php echo SERVERURL; ?>admin/page/4">4</a></li>
						<li><a href="<?php echo SERVERURL; ?>admin/page/5">5</a></li>
						<li><a href="javascript:void(0)">»</a></li>
					</ul>
				</nav>
			</div>
			<!-- DIVS  -->



		</div>

	</div>


</div>


<script defer src="<?php echo SERVERURL; ?>assets/script/admin.js"></script>