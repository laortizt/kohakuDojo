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

    <!-- Privileges section -->
	<?php include "./views/modules/privileges.php"; ?>
</div>
