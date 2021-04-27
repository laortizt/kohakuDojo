<div class="nav-class">
	<?php
	
		if($_SESSION['role_sk'] == "Administrador" || $_SESSION['role_sk'] == "Instructor"):
	?>
		<a href="<?php echo SERVERURL; ?>payments" class="btn-general">
			<i class="fas fa-list-ul"></i>
		</a>

		<a href="<?php echo SERVERURL; ?>newPay" class="btn-general">
			<i class="fas fa-plus"></i>
		</a>
		

	<?php
		elseif($_SESSION['role_sk'] == "Usuario"):
	?>
		<a href="<?php echo SERVERURL; ?>payments" class="btn-general">
			<i></i> Mis Pagos
		</a>
	<?php
		endif;
	?>
</div>