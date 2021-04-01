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
					<!-- DESDE AQUI -->
				

					<div class="barra__buscador">
						<form action="" class="formulario" method="post" form-data="dafault" form-data="default"> 
							<input type="text" name="search_user" placeholder="Buscar nombre o apellidos" value="" class="input__text" >


							<a href="#" type="submit" value="Buscar" name="btn_buscar" class="btn"><i class="fas fa-search"></i></a>
							<!-- <a href="#" class="btn btn__nuevo"><i class="fas fa-user-plus"></i></a> -->
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
		
</div>