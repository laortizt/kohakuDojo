<?php
require_once "./controller/controllerAdmin.php";
$insAdmin = new controllerAdmin();
?>

<!-- CMABIAR POR EL CONTROLADOR DE ASISTENCIA -->

<!-- <?php
		require_once "./controller/controllerClass.php";
		$insClass = new controllerClass();
		?> -->

<div class="container-fluid">

	


	<div class="row">
		<div class="col-12 col-m-12 col-sm-12">
			<div class="card">
				<div class="card-content">

					<form action="ajax/classAjax.php" class="form-class" method="post" autocomplete="off" class="formulario-ajax">
						<div class="header-class">
							<h1>Lista de Pagos</h1>
							<a href="<?php echo SERVERURL; ?>newPay/" class="btn-kohaku">
                            <i></i> Nuevo
                        </a>
                        <a href="<?php echo SERVERURL; ?>calendar/" class="btn-kohaku">
                            <i></i> Eliminar
                        </a>
                        <a href="<?php echo SERVERURL; ?>payments/" class="btn-kohaku">
                            <i></i> Lista
                        </a>
						</div>
						

						<table>
							<thead>
								<tr>
									<th>Pagos</th>
									<th>Fecha de Pago</th>
									<th>Concepto</th>
									<th>Monto</th>
									<th>Estado</th>
									<td colspan="2">Acciones</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td data-label="Pagos">Pago #1</td>
									<td data-label="Fecha de Pago">02/01/2015</td>
									<td data-label="Concepto">Membresía</td>
									<td data-label="Monto">$2,311</td>
									<td data-label="Estado">Pagado</td>
								</tr>
								<tr>
								<td data-label="Pagos">Pago #2</td>
									<td data-label="Fecha de Pago">02/01/2015</td>
									<td data-label="Concepto">Clases Enero</td>
									<td data-label="Monto">$2,311</td>
									<td data-label="Estado">Pendiente</td>
								</tr>
							</tbody>
						</table>

					</form>
				</div>



			</div>


		</div>

		<div class="RespuestaAjax"></div>
		</form>
	</div>
</div>
</div>

<script src="<?php echo SERVERURL; ?>assets/script/assistance.js"></script>