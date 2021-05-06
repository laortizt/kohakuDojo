<div class="nav-class">
	<?php
		if($_SESSION['role_sk'] == "Administrador" || $_SESSION['role_sk'] == "Instructor"):
	?>
		<a href="<?php echo SERVERURL; ?>progress" class="btn-menu">
		<i class="fas fa-tasks"></i>
		</a>

		<a href="<?php echo SERVERURL; ?>newProgress" class="btn-menu">
		<i class="fas fa-edit"></i>
		</a>
	<?php
		elseif($_SESSION['role_sk'] == "Usuario"):
	?>
		<a href="<?php echo SERVERURL; ?>newProgress" class="btn-menu">
			<i></i> holi2
		</a>
	<?php
		endif;
	?>
</div>