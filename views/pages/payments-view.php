<?php
require_once "./controller/controllerPayment.php";
$insPayment = new controllerPayment();
?>

<!-- CMABIAR POR EL CONTROLADOR DE ASISTENCIA -->

<div class="container-report">
	<div class="row-gutters">
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-check-circle"></i>
				</div>
				<div class="sale-num">
				<h3>2</h3>
				<p> Registrados</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
				<i class="fas fa-times-circle"></i>
				</div>
				<div class="sale-num">
					<h3>0</h3>
					<p>Pendientes</p>
				</div>
			</div>
		</div>
		<!-- <div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-user-cog"></i>
				</div>
				<div class="sale-num">
				
					<p>Administradores</p>
				</div>
			</div>
		</div> -->
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-equals"></i>
				</div>
				<div class="sale-num">
				<h3>2</h3>	
					<p>Total Pagos</p>
				</div>
			</div>
		</div>
	</div>
	
</div>



<div class="row">
	<div class="col-12 col-m-12 col-sm-12">
		<div class="card attendance">
			<div class="card-content">
				<div class="header-class">
					<h1 class="title">Pagos</h1>
					<?php include "./views/modules/menuPayments.php"; ?>
					
				</div>
						
				<div class="barra__buscador">
					<form action="" class="formulario" method="post" form-data="default" form-data="default">
						<div>
							<input type="text" name="search_user" placeholder="Buscar nombre o apellidos" value="" class="text-search">
							<button href="#" type="submit" value="Buscar" name="button-search" class="btn-general"><i class="fas fa-search"></i></button>
						</div>
					</form>
				</div>
				
				<?php
					$pages = explode("/", $_GET['page']);
					
					echo $insPayment->pages_payment_controller(0, 10, $_SESSION['role_sk'], 'code');
					?>
				
			</div>
		</div>
	</div>
</div>

<script src="<?php echo SERVERURL; ?>assets/script/payments.js"></script>