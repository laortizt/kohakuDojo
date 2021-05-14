<?php
require_once "./controller/controllerAdmin.php";
$insAdmin = new controllerAdmin();
?>

<div class="welcome-area">
	<div class="row m-0 align-items-center welcome-container">
		<div class="col-lg-5 col-md-12 p-0">
			<div class="welcome-content">
				<h1 class="mb-2">Hola, Nombre</h1>
				<p class="mb-0">Just Do Somethings Better</p>
			</div>
		</div>

		<div class="col-lg-7 col-md-12 p-0">
			<div class="welcome-img">
				<img src="assets/img/welcome-img.png" alt="image">
			</div>
		</div>
	</div>
</div>

<div class="container-report">
	<div class="row-gutters">
		<div class="col-12 col-m-12 col-sm-12">
		<div class="info-stats4">
			
			<div class="col-2">
			<div class="info-icon info-icon-color">
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>Ene</p>
				</div>
			</div>
			</div>
			<div class="col-2">
			<div class="info-icon info-icon-color">
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>Feb</p>
				</div>
			</div>
			</div>
			<div class="col-2">
			<div class="info-icon info-icon-color">
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>Mar</p>
				</div>
			</div>
			</div>

			<div class="col-2">
			<div class="info-icon info-icon-color">
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>Abr</p>
				</div>
			</div>
			</div>

			<div class="col-2">
			<div class="info-icon info-icon-color">
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>May</p>
				</div>
			</div>
			</div>

			<div class="col-2">
			<div class="info-icon info-icon-color">
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>Jun</p>
				</div>
			</div>
			</div>

			<div class="col-2">
			<div class="info-icon info-icon-color">
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>Jul</p>
				</div>
			</div>
			</div>

			<div class="col-2">
			<div class="info-icon info-icon-color">
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>Ago</p>
				</div>
			</div>
			</div>

			<div class="col-2">
			<div class="info-icon info-icon-color">
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>Sep</p>
				</div>
			</div>
			</div>

			<div class="col-2">
			<div class="info-icon info-icon-color">
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>Oct</p>
				</div>
			</div>
			</div>

			<div class="col-2">
			<div class="info-icon info-icon-color">
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>Nov</p>
				</div>
			</div>
			</div>

			<div class="col-2">
			<div class="info-icon info-icon-color">
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
					<p>Dic</p>
				</div>
			</div>
			</div>
		</div>
		
	</div>
	
</div>


<div class="container-report">
	<div class="row-gutters">
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color1">
					<i class="fa   fa-users"></i>
				</div>
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_students() ?></h3>
					<p>Alumnos</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color2">
					<i class="fa fa-graduation-cap"></i>
				</div>
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors() ?></h3>
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
					<h3><?php echo $insAdmin->count_admin() ?></h3>
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
					<h3><?php echo $insAdmin->count_allRegisters() ?></h3>
					<p>Total Usuarios</p>
				</div>
			</div>
		</div>
	</div>

</div>




<div class="row privileges">

	<div class="col-12 col-m-12 col-sm-12">
		<div class="card">
			<div class="card-content">

				<div class="header-class">
					<h1 class="title">Administar usuarios</h1>

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

				echo $insAdmin->pages_admin_controller(0, 10, $_SESSION['role_sk'], 'code');
				?>
			</div>
			<!-- DIVS  -->



		</div>

	</div>


</div>

<script defer src="<?php echo SERVERURL; ?>assets/script/admin.js"></script>