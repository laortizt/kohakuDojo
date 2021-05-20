<?php
require_once "./controller/controllerAdmin.php";
$insAdmin = new controllerAdmin();
?>

<!-- Bienvenida -->
<div class="welcome-area">
	<div class="row m-0 align-items-center welcome-container">
		<div class="col-lg-5 col-md-12 p-0">
			<div class="welcome-content">
				<h1 class="mb-2">Hola, <?php echo $_SESSION['userfirstname_sk'] ?></h1>
				<p class="mb-0">¡Un gusto tenerte de vuelta!</p>
			</div>
		</div>

		<div class="col-lg-7 col-md-12 p-0">
			<div class="welcome-img">
				<img src="assets/img/welcome-img.png" alt="image">
			</div>
		</div>
	</div>
</div>

<!-- divs informaciòn -->
<div class="container-report">
	<div class="row-gutters">
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color1">
					<i class="fa   fa-users"></i>
				</div>
				<div class="sale-num">
					<!-- <h3><?php echo $insAdmin->count_students() ?></h3> -->
					<p>Clases Tomadas</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color2">
					<i class="fa fa-graduation-cap"></i>
				</div>
				<div class="sale-num">
					<!-- <h3><?php echo $insAdmin->count_instructors() ?></h3> -->
					<p>Clases Restantes</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color3">
					<i class="fa fa-unlock-alt"></i>
				</div>
				<div class="sale-num">
					<!-- <h3><?php echo $insAdmin->count_admin() ?></h3> -->
					<p>Nivel Actual</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon info-icon-color4">
					<i class="fas  fa-tasks"></i>
				</div>
				<div class="sale-num">
					<!-- <h3><?php echo $insAdmin->count_allRegisters() ?></h3> -->
					<p>Tramites realizados</p>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="container-fluid">
    <div class="row-gutters">
        <div class="col-6 col-sm-12">
            <div class="info-stats4">
				
            </div>
        </div>

        <!-- formulario -->
        <div class="col-6 col-sm-12">

            <div class="info-stats4">

                <form action="ajax/profileAjax.php" method="post" autocomplete="off" class="profile-form formulario-ajax">


                    <div class="row g-3">
						<h1>Crear Clase</h1>
                        <div class="col-12">
							 <label class="label">Tema de clase</label>
								<div class="input-field-profile">
									<input type="text">
								</div>
								<label class="label"></label>
								<div class="input-field-profile">
									<input type="text">
								</div>
                        </div>

                        <div class="col-6">

                            <label class="label">Fecha inicio</label>
							<div class="input-field-profile">
								<input type="date">
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label">Feha Fin</label>
                            <div class="input-field-profile">
								<input type="date">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="label">Detalles</label>
                            <div class="input-field-profile">
								<input type="text">
                            </div>
                        </div>
                        
                    </div>

                    <input type="submit" class="btn-kohaku-profile" value="Guardar" />

                    <div class="RespuestaAjax"></div>
                </form>

            </div>
        </div>

    </div>

</div>




