<div class="nav-class">
	<?php
	
		if($_SESSION['role_sk'] == "Administrador"):
	?>  
		<a href="<?php echo SERVERURL; ?>calendar" class="btn-menu">
			<i class="bi bi-calendar-check"></i>
			 <span>Clases</span>
		</a>

		<a href="<?php echo SERVERURL; ?>payments" class="btn-menu">
			<i class="fas fa-dollar-sign"></i>
			<span>Pagos</span>
			
		</a>

		 <a href="<?php echo SERVERURL; ?>progress" class="btn-menu">
		 <i class="bi bi-graph-up"></i>
			<span>Progreso</span>
		</a>
		
		<a href="<?php echo SERVERURL; ?>admin" class="btn-menu">
		<i class="bi bi-file-earmark-bar-graph"></i>
			 <span>Trámites</span>
		</a>

	<?php
		elseif($_SESSION['role_sk'] == "Usuario"):
	?>
		<a href="<?php echo SERVERURL; ?>payments" class="btn-menu">
			<i class="fas fa-list-ul"></i>
		</a>
	<?php
		endif;
	?>
</div>




<!-- 
<div class="nav-class">

	<a href="#" type="submit" value="pay" name="button-pay" class="btn-general"><i class="fas fa-dollar-sign"></i></a>
	<a href="#" type="submit" value="rep" name="button-rep" class="btn-general"><i class="fas fa-list-ul"></i></a>
	<a href="#" type="submit" value="rep" name="button-rep" class="btn-general"><i class="fas fa-user-plus"></i></a>

</div> -->
