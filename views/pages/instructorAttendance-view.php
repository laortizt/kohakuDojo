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

					echo $insClass->pages_attendance_controller($pageNumber, 10, $_SESSION['role_sk'], $_SESSION['code_sk']);
				?>

				<nav class="text-center">
					<ul class="pagination pagination-sm">
						<li class="disabled"><a href="javascript:void(0)">«</a></li>
						<li class="active"><a href="<?php echo SERVERURL; ?>class/page/1">1</a></li>
						<li><a href="<?php echo SERVERURL; ?>class/page/2">2</a></li>
						<li><a href="<?php echo SERVERURL; ?>class/page/3">3</a></li>
						<li><a href="<?php echo SERVERURL; ?>class/page/4">4</a></li>
						<li><a href="<?php echo SERVERURL; ?>class/page/5">5</a></li>
						<li><a href="javascript:void(0)">»</a></li>
					</ul>
				</nav>
			</div>
			<!-- DIVS  -->
		</div>
	</div>
</div>