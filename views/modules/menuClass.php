<!-- <div class="nav-class">
	<?php
		if($_SESSION['role_sk'] == "Administrador" || $_SESSION['role_sk'] == "Instructor"):
	?>
		<a href="<?php echo SERVERURL; ?>calendar" class="btn-menu">
			<i></i> Agendar
		</a>

		<a href="<?php echo SERVERURL; ?>attendance" class="btn-menu">
			<i></i> Asistencia
		</a>
	<?php
		elseif($_SESSION['role_sk'] == "Usuario"):
	?>
		<a href="<?php echo SERVERURL; ?>schedule" class="btn-menu">
			<i></i> Inscribir Clase
		</a>
	<?php
		endif;
	?>
</div> -->