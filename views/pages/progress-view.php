<?php
require_once "./controller/controllerProgress.php";
$insProgress = new controllerProgress();
?>


<!-- <?php include "./views/modules/menuProgress.php"; ?> -->

<!-- <div class="container-report">
	<div class="row-gutters">
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-user-friends"></i>
				</div>
				<div class="sale-num">
					<h3><?php echo $insProgress->count_students() ?></h3>
					<p></p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-user-tie"></i>
				</div>
				<div class="sale-num">
					<h3>2500</h3>
					<p>Instructores</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-user-cog"></i>
				</div>
				<div class="sale-num">
					<h3>7500</h3>
					<p>Administradores</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-equals"></i>
				</div>
				<div class="sale-num">
					<h3>3500</h3>
					<p>Total Usuarios</p>
				</div>
			</div>
		</div>
	</div>

</div> -->




<?php
require_once "./controller/controllerClass.php";
$insClass = new controllerClass();
?>




<div class="container-fluid">
	<div class="row-gutters">

		

		<!-- formulario -->
		<div class="col-6 col-sm-12">

			<div class="info-stats4">

				<form action="ajax/classAjax.php" method="post" autocomplete="off" class="profile-form formulario-ajax">
					<div class="header-class">
						<h1 class="title">Registrar Progreso</h1>
					</div>
					
					<div class="row g-3">
						<div class="col-6">
							<label class="label-form">Fecha</label>
							<div class="input-field-profile">
								<input type="date" name="classDate" required="">
							</div>
						</div>
						<div class="col-6">
							<label class="label-form">Documento</label>
							<div class="input-field-profile">
								<input type="text" name="classTopic" required="">
							</div>
						</div>

						<div class="col-6">
							<label class="label-form">Nombre</label>
							<div class="input-field-profile">
								<input type="text" name="classTopic" required="">
							</div>
						</div>
						

						<div class="col-6">
							<label class="label-form">Grado</label>
							<div class="input-field-profile">
								<input type="text" readonly value="" id="eventsPrice" name="eventsPrice" required="">
							</div>
						</div>

						<div class="col-6">
							<label class="label-form">Estado</label>
							<div class="input-field-profile">
								<input type="text" readonly value="" id="eventsPrice" name="eventsPrice" required="">
							</div>
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
					<h1 class="title">Listado Ascensos</h1>
					<div class="barra__buscador">

					<form action="" class="formulario" method="post" form-data="default" form-data="default">
						<div>
							<input type="text" name="search_user" placeholder="Buscar nombre o apellidos" value="" class="text-search">
							<button href="#" type="submit" value="Buscar" name="button-search" class="btn-search"><i class="fa bi bi-search"></i></button>
						</div>
					</form>
					</div>

                 
                </div>

                <div>

                    <?php
					$pages = explode("/", $_GET['page']);

					echo $insProgress->pages_progress_controller(0, 10, $_SESSION['role_sk'], 'code');
					?>
                </div>
            </div>
        </div>

    </div>
</div>


<script defer src="<?php echo SERVERURL; ?>assets/script/adminClass.js"></script>