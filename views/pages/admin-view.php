<!-- ESTABA AQUI O EN PRIVILEGES???? -->
<?php
	require_once"./controller/controllerAdmin.php";
	$insAdmin= new controllerAdmin();
?>

<div class="container-fluid">
	<div class="nav-class">
		<a href="" class="btn-kohaku">
			<i></i> Permisos
		</a>

		<a href="#" class="btn-kohaku">
			<i></i> Usuarios Registrados
		</a>

		<a href="#" class="btn-kohaku">
			<i></i> boton3
		</a>
	</div>

    <!-- Content Row -->
    <div class="row">	
		<!-- Privileges chart -->
		<div class="col-xl-8 col-lg-7">
			<?php include "./views/modules/privileges.php"; ?>
		</div>
	</div>  
</div>
