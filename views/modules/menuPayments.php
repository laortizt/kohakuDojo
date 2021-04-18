<div class="nav-class">
	<?php
	
		if($_SESSION['role_sk'] == "Administrador" || $_SESSION['role_sk'] == "Instructor"):
	?>
		<a href="<?php echo SERVERURL; ?>payments" class="btn-normal">
			<i></i> Registros
		</a>
		<a href="<?php echo SERVERURL; ?>newPay" class="btn-normal">
			<i></i> Nuevo
		</a>
		

	<?php
		elseif($_SESSION['role_sk'] == "Usuario"):
	?>
		<a href="<?php echo SERVERURL; ?>payments" class="btn-normal">
			<i></i> Mis Pagos
		</a>
	<?php
		endif;
	?>
</div>