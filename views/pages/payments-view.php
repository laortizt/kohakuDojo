<?php
require_once "./controller/controllerPayment.php";
$insPayment = new controllerPayment();
?>


<div class="container-report">
	<div class="row-gutters">
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color1">
					<i class="fa bi bi-bag-check"></i>
				</div>
				<div class="sale-num">

					<h3>2</h3>
					<p>Realizados</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color2">
					<i class="fa bi bi-bag-dash"></i>
				</div>
				<div class="sale-num">

					<h3>0</h3>
					<p>Parciales</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color3">
					<i class="fa bi bi-bag-x"></i>
				</div>
				<div class="sale-num">

					<h3>0</h3>
					<p>Pendientes</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color4">
					<i class="fa bi bi-bag"></i>
				</div>
				<div class="sale-num">
					<h3>2</h3>
					<p>Total Pagos</p>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="container-fluid">
	<div class="row-gutters">
		<!-- formulario -->
		<div class="col-6 col-sm-12">
		<h2>Registrar Pago</h2>
			<form action="ajax/newPayAjax.php" method="post" autocomplete="off" class="payment-form formulario-ajax">
				
				<div class="info-stats4">
				
					<div class="payment">
						<div class="col-6">
							<label class="label">Fecha</label>
							<div class="input-field">
								<input type="date" name="date-newpay" required="" />
							</div>
						</div>

						<div class="col-6">
							<label class="label">Documento</label>
							<div class="input-field">
								<input type="texbox" name="dni-newpay" minlength="1" maxlength="100" />
							</div>
						</div>

						<div class="col-6">
							<label class="label">Trámite</label>
							<?php echo $insPayment->list_procedure_controller() ?>
						</div>



						<div class="col-6">
							<label class="label">Valor</label>
							<div class="input-field">
								<i class="far fa-dollar-sign"></i>
								<input type="text" readonly value="" id="price-newpay" name="price-newpay" required="" />
							</div>
						</div>


						<div class="col-6">

							<label class="label">Observaciones</label>
							<div class="input-field">
								<input type="texbox" name="observation-newpay" minlength="1" maxlength="100" />
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
				<h1 class="title">Gestión de Pagos</h1>
				<div class="header-class">


					<div class="barra__buscador">

						<form action="" class="formulario" method="post" form-data="default" form-data="default">
							<div>
								<input type="text" name="search_user" placeholder="Buscar nombre o apellidos" value="" class="text-search">
								<button href="#" type="submit" value="Buscar" name="button-search" class="btn-search"><i class="fa bi bi-search"></i></button>
							</div>
						</form>
					</div>

					<?php include "./views/modules/menuPayments.php"; ?>
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