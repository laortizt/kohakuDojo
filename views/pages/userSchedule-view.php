<?php
require_once "./controller/controllerPayment.php";
$insPayment = new controllerPayment();
?>



<script defer src="<?php echo SERVERURL; ?>assets/script/adminClass.js"></script>


<div class="row privileges">
	<div class="col-12 col-m-12 col-sm-12">
		<div class="card">
			<div class="card-content">
				
				<div class="header-class">
                 <h1 class="title">Mis Trámites</h1>


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
				$pages = explode("/", $_GET['page']);

				echo $insPayment->pages_payment_controller(0, 10, $_SESSION['role_sk'], 'code');
				?>
			</div>
			<!-- DIVS  -->



		</div>

	</div>


</div>
