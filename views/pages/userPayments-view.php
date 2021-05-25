<?php
require_once "./controller/controllerPayment.php";
$insPayment = new controllerPayment();
?>



<div class="row privileges">
	<div class="col-12 col-m-12 col-sm-12">
		<div class="card">
			<div class="card-content">
				
				<div class="header-class">
				<h1 class="title">Mis Pagos</h1>


					<div class="barra__buscador">

						<form action="" class="formulario" method="post" form-data="default" form-data="default">
							<div>
								<input type="text" name="search_user" placeholder="Buscar nombre o apellidos" value="" class="text-search">
								<button href="#" type="submit" value="Buscar" name="button-search" class="btn-search"><i class="fa bi bi-search"></i></button>
							</div>
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

				echo $insPayment->pages_payment_controller(0, 10, $_SESSION['role_sk'], 'code');
				?>
				<nav class="text-center">
					<ul class="pagination pagination-sm">
						<li class="disabled"><a href="javascript:void(0)">«</a></li>
						<li class="active"><a href="<?php echo SERVERURL; ?>payments/page/1">1</a></li>
						<li><a href="<?php echo SERVERURL; ?>payments/page/2">2</a></li>
						<li><a href="<?php echo SERVERURL; ?>payments/page/3">3</a></li>
						<li><a href="<?php echo SERVERURL; ?>payments/page/4">4</a></li>
						<li><a href="<?php echo SERVERURL; ?>payments/page/5">5</a></li>
						<li><a href="javascript:void(0)">»</a></li>
					</ul>
				</nav>
			</div>
			<!-- DIVS  -->



		</div>

	</div>


</div>
