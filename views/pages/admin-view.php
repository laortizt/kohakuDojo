<?php
require_once "./controller/controllerAdmin.php";
$insAdmin = new controllerAdmin();
?>

<div class="container-report">
	<div class="row-gutters">
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-user-friends"></i>
				</div>
				<div class="sale-num">
				<h3><?php echo $insAdmin->count_students()?></h3>
					<p>Alumnos</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-user-tie"></i>
				</div>
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors()?></h3>
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
				<h3><?php echo $insAdmin->count_admin()?></h3>
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
				<h3><?php echo $insAdmin->count_allRegisters()?></h3>
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
					<h1 class="title">Lista de usuarios</h1>
					<?php include "./views/modules/menuAdmin.php"; ?>
				</div>
				<!-- DESDE AQUI -->

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

				echo $insAdmin->pages_admin_controller(0, 10, $_SESSION['role_sk'], 'code');
				?>
			</div>
			<!-- DIVS  -->



		</div>

	</div>


</div>