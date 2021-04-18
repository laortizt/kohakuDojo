<div class="nav-class">
	<?php
		if($_SESSION['role_sk'] == "Administrador" || $_SESSION['role_sk'] == "Instructor"):
	?>
		<a href="<?php echo SERVERURL; ?>calendar" class="btn-normal">
			<i></i> Agendar
		</a>

		<a href="<?php echo SERVERURL; ?>attendance" class="btn-normal">
			<i></i> Asistencia
		</a>
	<?php
		elseif($_SESSION['role_sk'] == "Usuario"):
	?>
		<a href="<?php echo SERVERURL; ?>schedule" class="btn-normal">
			<i></i> Inscribir Clase
		</a>
	<?php
		endif;
	?>
</div>