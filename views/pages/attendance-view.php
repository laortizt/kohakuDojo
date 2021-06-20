<?php
require_once "./controller/controllerClass.php";
$insClass = new controllerClass();
?>

<div class="row privileges">

	<div class="col-12 col-m-12 col-sm-12">
		<div class="card">
			<div class="card-content">

				<div class="header-class">
					<h1 class="title">Lista de asistencia</h1>

					<div class="barra__buscador">
						<?php
						require_once "./controller/controllerAdmin.php";
						$insAdmin = new controllerAdmin();
						?>
						
						
						<form action="ajax/searchAjax.php" class="formulario" method="post" form-data="default" form-data="default" autocomplete="off" enctype="multipart/form-data">
							<div>
								<input type="hidden" name="search_page" id="search_page" value="attendance">
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

					echo $insClass->pages_attendance_controller($pageNumber, 10, $_SESSION['role_sk'], $_SESSION['code_sk'],"");
				?>

			</div>
			
		</div>
	</div>
</div>