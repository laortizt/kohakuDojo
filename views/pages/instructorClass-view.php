<?php
require_once "./controller/controllerClass.php";
$insClass = new controllerClass();
?>



<!--divs-->
<!-- <div class="container-report">
	<div class="row-gutters">
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color1">
					<i class="fa   fa-users"></i>
				</div>
				<div class="sale-num">

					<p>Total</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color2">
					<i class="fa fa-graduation-cap"></i>
				</div>
				<div class="sale-num">

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

					<p>Total Usuarios</p>
				</div>
			</div>
		</div>
	</div>
</div> -->

<!--tabla-->
<div class="container-fluid">
	<div class="row-gutters">
		<div class="col-6 col-sm-12">
			<!--Grafica-->
			<div class="col-lg-6 col-md-12">
				<div class="card mb-30">
					<div class="header-class">
						<h1 class="title">Reporte mensual</h1>
						
					</div>

					<div class="card-body">
						<div id="client-recollection-chart" class="extra-margin"></div>

						<?php echo $insClass->get_users_by_month_chart() ?>
					</div>
				</div>
			</div>
		</div>

		<!-- formulario -->
		<div class="col-6 col-sm-12">

			<div class="info-stats4">

				<form action="ajax/classAjax.php" method="post" autocomplete="off" class="profile-form formulario-ajax">
					<div class="header-class">
						<h1 class="title">Crear Clase</h1>
					</div>

					<div class="row g-3">
						<div class="col-6">
							<label class="label-form">Instructor</label>
							<?php echo $insClass->list_teachers_controller() ?>
						</div>
						<div class="col-6">
							<label class="label-form">Tema</label>
							<div class="input-field-profile">
								<input type="text" name="classTopic" required="">
							</div>
						</div>
						<div class="col-6">
							<label class="label-form">Tipo de Evento</label>
							<?php echo $insClass->list_events_controller(-1) ?>
						</div>

						<div class="col-6">
							<label class="label-form">Precio</label>
							<div class="input-field-profile">
								<input type="text" readonly value="" id="eventsPrice" name="eventsPrice" required="">
							</div>
						</div>

						<div class="col-6">
							<label class="label-form">Fecha</label>
							<div class="input-field-profile">
								<input type="date" name="classDate" required="">
							</div>
						</div>

						<div class="col-6">
							<label class="label">Hora Inicio</label>
							<select class="input-field-profile" id="classTimeInit" name="classTimeInit" required="">
								<option>9:00</option>
								<option>10:00</option>
								<option>11:00</option>
								<option>12:00</option>
								<option>1:00</option>
								<option>2:00</option>
								<option>3:00</option>
								<option>4:00</option>
								<option>5:00</option>
								<option>6:00</option>
								<option>7:00</option>

							</select>
						</div>

						<div class="col-6">
							<label class="label">Hora Fin</label>
							<select class="input-field-profile" id="classTimeEnd" name="classTimeEnd" required="">
								<option>11:00</option>
								<option>12:00</option>
								<option>13:00</option>
								<option>14:00</option>
								<option>15:00</option>
								<option>16:00</option>
								<option>17:00</option>
								<option>18:00</option>
								<option>19:00</option>
								<option>20:00</option>
								<option>21:00</option>
							</select>
						</div>
					</div>

					<input type="submit" class="btn-kohaku-profile" value="Guardar" />

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

				<div class="header-class">
					<h1 class="title">Registro de Clases</h1>

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

					echo $insClass->pages_class_controller($pageNumber, 10, $_SESSION['role_sk'], $_SESSION['code_sk']);
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


<script defer src="<?php echo SERVERURL; ?>assets/script/adminClass.js"></script>