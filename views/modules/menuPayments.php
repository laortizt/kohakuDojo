<div class="nav-class">
	<?php
	
		if($_SESSION['role_sk'] == "Administrador" || $_SESSION['role_sk'] == "Instructor"):
	?>
		<a href="<?php echo SERVERURL; ?>newPay" class="btn-menu">
		<i class="fas fa-plus-circle"></i>
			<span>Nuevo Pago</span>

		</a>
		
		
		 

	<?php
		elseif($_SESSION['role_sk'] == "Usuario"):
	?>
		<a href="<?php echo SERVERURL; ?>payments" class="btn-menu">

			<i></i> Mis Pagos
		</a>
	<?php
		endif;
	?>
</div>