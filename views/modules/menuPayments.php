<div class="nav-class">
	<?php

	if ($_SESSION['role_sk'] == "Administrador" || $_SESSION['role_sk'] == "Instructor") :
	?>
		<a href="<?php echo SERVERURL; ?>newPay" class="btn-menu" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
			<i class="fas fa-plus-circle"></i>
			<span>Nuevo Pago</span>

		</a>
		<!-- Button trigger modal -->


		<!-- Modal -->
		<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						...
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div> -->




	<?php
	elseif ($_SESSION['role_sk'] == "Usuario") :
	?>
		<a href="<?php echo SERVERURL; ?>payments" class="btn-menu">

			<i></i> Mis Pagos
		</a>
	<?php
	endif;
	?>
</div>