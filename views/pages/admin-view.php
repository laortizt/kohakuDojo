<?php
require_once "./controller/controllerAdmin.php";
$insAdmin = new controllerAdmin();
?>


	

	<!-- Privileges section -->
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
								<input type="text" name="search_user" placeholder="Buscar nombre o apellidos" value="" class="text-search" >
								<button href="#" type="submit" value="Buscar" name="button-search" class="btn-search"><i class="fas fa-search"></i></button>
							</div>
						</form>
					</div>
					
					<?php
					$pages = explode("/", $_GET['page']);
					
					echo $insAdmin->pages_admin_controller(0, 10, $_SESSION['role_sk'], 'code');
					?>
				</div>
				
			</div>
		</div>
	</div>
		