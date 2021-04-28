<div class="nav-class">
	<?php
	
		if($_SESSION['role_sk'] == "Administrador"):
	?>
		<!-- <a href="<?php echo SERVERURL; ?>#" class="btn-general">
			<i class="fas fa-user-plus"></i>
		</a> -->

		<a href="<?php echo SERVERURL; ?>newPay" class="btn-general">
			<i class="fas fa-dollar-sign"></i>
		</a>
		
		<a href="<?php echo SERVERURL; ?>admin" class="btn-general">
			<i class="fas fa-list-ul"></i>
		</a>

	<?php
		elseif($_SESSION['role_sk'] == "Usuario"):
	?>
		<a href="<?php echo SERVERURL; ?>payments" class="btn-general">
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
