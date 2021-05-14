<?php
require_once "./controller/controllerProgress.php";
$insProgress = new controllerProgress();
?>


<!-- <?php include "./views/modules/menuProgress.php"; ?> -->

<div class="container-report">
	<div class="row-gutters">
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-user-friends"></i>
				</div>
				<div class="sale-num">
					<h3><?php echo $insProgress->count_students()?></h3>
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

</div>

<div class="row privileges">
    <div class="col-12 col-m-12 col-sm-12">
        <div class="card">
            <div class="card-content">
			<h1 class="title">Listado Ascensos</h1>
                <div class="header-class">
				<div class="barra__buscador">

					<form action="" class="formulario" method="post" form-data="default" form-data="default">
						<div>
							<input type="text" name="search_user" placeholder="Buscar nombre o apellidos" value="" class="text-search">
							<button href="#" type="submit" value="Buscar" name="button-search" class="btn-search"><i class="fa bi bi-search"></i></button>
						</div>
					</form>
					</div>

                    <?php include "./views/modules/menuProgress.php"; ?>
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