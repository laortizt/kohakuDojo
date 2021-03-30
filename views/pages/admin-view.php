<?php
require_once "./controller/controllerAdmin.php";
$insAdmin = new controllerAdmin();
?>

<div class="container-fluid">
	<?php include "./views/modules/menuAdmin.php"; ?>

	<!-- Privileges section -->
	<div class="row privileges">
		<div class="col-12 col-m-12 col-sm-12">
			<div class="card">
				<div class="card-content">
					<h2>Lista de usuarios</h2>

					<div class="barra__buscador">
						<form action="" class="formulario" method="post">
							<input type="text" name="buscar" placeholder="Buscar nombre o apellidos" value="<?php if (isset($buscar_text)) echo $buscar_text; ?>" class="input__text">


							<a href="#" type="submit" value="Buscar" name="btn_buscar" class="btn"><i class="fas fa-search"></i></a>
							<a href="#" class="btn btn__nuevo"><i class="fas fa-user-plus"></i></a>
						</form>
					</div>

					<?php
					$pages = explode("/", $_GET['page']);
					// echo $insAdmin->pages_admin_controller($pages[1], 10, $_SESSION['role_sk'], $_SESSION['code']);
					echo $insAdmin->pages_admin_controller(0, 10, $_SESSION['role_sk'], 'code');
					?>
				</div>
			</div>
		</div>
	</div>
</div>