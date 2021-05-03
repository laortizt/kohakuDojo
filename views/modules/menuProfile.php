<div class="nav-class">
	<?php
	
		if($_SESSION['role_sk'] == "Administrador" || $_SESSION['role_sk'] == "Instructor"):
	?>
		<a href="<?php echo SERVERURL; ?>admin" class="btn-general">
        <i class="fas fa-times-circle"></i>
		</a>


	<?php
		elseif($_SESSION['role_sk'] == "Usuario"):
	?>
		<!-- <a href="<?php echo SERVERURL; ?>schedule" class="btn-general">
        <i class="fas fa-times-circle"></i> Mis Pagos
		</a> -->
	<?php
		endif;
	?>
</div>