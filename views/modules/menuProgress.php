<div class="nav-class">
	<?php
		if($_SESSION['role_sk'] == "Administrador" || $_SESSION['role_sk'] == "Instructor"):
	?>
		<a href="<?php echo SERVERURL; ?>progress" class="btn-normal">
			<i></i> Seguimiento
		</a>

		<a href="<?php echo SERVERURL; ?>#" class="btn-normal">
			<i></i> holi1
		</a>
	<?php
		elseif($_SESSION['role_sk'] == "Usuario"):
	?>
		<a href="<?php echo SERVERURL; ?>schedule" class="btn-normal">
			<i></i> holi2
		</a>
	<?php
		endif;
	?>
</div>