<?php
require_once "./controller/controllerPayment.php";
$insPayment = new controllerPayment();
?>

<!-- CMABIAR POR EL CONTROLADOR DE ASISTENCIA -->

<div class="row">
	<div class="col-12 col-m-12 col-sm-12">
		<div class="card">
			<div class="card-content">
				<div class="header-class">
					<h1>Lista de Pagos</h1>

					<div>
						<a href="<?php echo SERVERURL; ?>newPay" class="btn-kohaku">
							<i class="fas fa-plus-circle"></i> Nuevo
						</a>
					</div>
				</div>
						
				<form action="ajax/newPayAjax.php" class="payment-form" method="post" autocomplete="off" class="formulario-ajax">
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

					<div class="RespuestaAjax"></div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo SERVERURL; ?>assets/script/payments.js"></script>