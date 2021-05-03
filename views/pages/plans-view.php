<?php
require_once "./controller/controllerAdmin.php";
$insAdmin = new controllerAdmin();
?>

<!-- CMABIAR POR EL CONTROLADOR DE ASISTENCIA -->

<!-- <?php
		require_once "./controller/controllerClass.php";
		$insClass = new controllerClass();
		?> -->



	


	<div class="row">
		<div class="col-12 col-m-12 col-sm-12">
			<div class="card">
				<div class="card-content">
					<div class="header-class">
						<h1 class="title">Planes</h1>
						
					</div>

					<div class="Plans text-center">
						
							
						<div class="items-plan">
							<div class="PlaneName">
								<span class="upper title">Básic</span>
								<h3>Little description here</h3>
								<h1>$190<span>/mes</span></h1>
								<p>10 presentations/month Support at $25/hour 1 campaign/month</p>
								<button class="upper">Seleccionar Plan</button>
							</div>
							<div class="PlaneName active">
								<span class="upper title">Platinun</span>
								<h3>Little description here</h3>
								<h1>$220<span>/mes</span></h1>
								<p>10 presentations/month Support at $25/hour 1 campaign/month</p>
								<button class="upper">Seleccionar Plan</button>
							</div>
							<div class="PlaneName">
								<span class="upper title">Golden</span>
								<h3>Little description here</h3>
								<h1>$260<span>/mes</span></h1>
								<p>10 presentations/month Support at $25/hour 1 campaign/month</p>
								<button class="upper">Seleccionar Plan</button>
							</div>
						</div>
					
					</div>

				</div>

			</div>

			<div class="RespuestaAjax"></div>

		</div>
	</div>
</div>

<script src="<?php echo SERVERURL; ?>assets/script/plans.js"></script>