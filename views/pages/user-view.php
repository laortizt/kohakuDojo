<?php
require_once "./controller/controllerAdmin.php";
require_once "./controller/controllerClass.php";
$insAdmin = new controllerAdmin();
$insClass = new controllerClass();
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
				<img src="assets/img/banner4.png" alt="image">
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
					<!-- <h3><?php echo $insAdmin->count_students() ?></h3> -->
					<p>Clases Tomadas</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color2">
					<i class="fa fa-graduation-cap"></i>
				</div>
				<div class="sale-num">
					<!-- <h3><?php echo $insAdmin->count_instructors() ?></h3> -->
					<p>Clases Restantes</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color3">
					<i class="fa fa-unlock-alt"></i>
				</div>
				<div class="sale-num">
					<!-- <h3><?php echo $insAdmin->count_admin() ?></h3> -->
					<p>Nivel Actual</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color4">
					<i class="fas  fa-tasks"></i>
				</div>
				<div class="sale-num">
					<!-- <h3><?php echo $insAdmin->count_allRegisters() ?></h3> -->
					<p>Tramites realizados</p>
				</div>
			</div>
		</div>
	</div>

</div>


<!-- divs informaciòn -->


<div class="container-fluid">
	<div class="row-gutters">
		<div class="col-12 col-m-12 col-sm-12">
			<div class="card">
				<div class="card-content">

					<div class="header-class">
						<h1 class="title">Clases Programadas</h1>

						<div class="barra__buscador">
						<?php
							require_once "./controller/controllerAdmin.php";
							$insAdmin = new controllerAdmin();
							
						?>


							<form action="ajax/searchAjax.php" class="formulario" method="post" form-data="default" form-data="default" autocomplete="off" enctype="multipart/form-data">			
							<div>
								<input type="hidden" name="search_page" id="search_page" value="adminClass">
								<input type="text" name="search_class" id="search_class" placeholder="Buscar nombre" value="<?= isset($_SESSION['searchClass']) ? $_SESSION['searchClass'] : '' ?>" class="text-search">
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
							$p = intval($pages[2]);
							if ($p > 1) {
								$pageNumber = $p;
							}
						}
					}

					echo $insClass->pages_classUser_controller($pageNumber, 10, $_SESSION['role_sk'], $_SESSION['code_sk'],"");
					?>

				</div>
				<!-- DIVS  -->
			</div>
		</div>

		<!-- formulario -->
		

	</div>

</div>




