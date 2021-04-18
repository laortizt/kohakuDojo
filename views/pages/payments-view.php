<?php
require_once "./controller/controllerPayment.php";
$insPayment = new controllerPayment();
?>

<!-- CMABIAR POR EL CONTROLADOR DE ASISTENCIA -->

<div class="row">
	<div class="col-12 col-m-12 col-sm-12">
		<div class="card attendance">
			<div class="card-content">
				<div class="header-class">
					<h1 class="title">Lista de Pagos</h1>
					<?php include "./views/modules/menuPayments.php"; ?>
					
				</div>
						
				<!-- <form action="ajax/newPayAjax.php" class="payment-form" method="post" autocomplete="off" class="formulario-ajax">
					<table>
						<thead>
							<tr>
								<th>Fecha de Pago</th>
								<th>Documento</th>
								<th>Monto</th>
								<th>Trámite</th>
								<th>Valor</th>
								<th>Observaciones</th>
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
				</form> -->
				<?php
					$pages = explode("/", $_GET['page']);
					
					echo $insPayment->pages_payment_controller(0, 10, $_SESSION['role_sk'], 'code');
					?>
				
			</div>
		</div>
	</div>
</div>

<script src="<?php echo SERVERURL; ?>assets/script/payments.js"></script>