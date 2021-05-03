<?php
	require_once"./controller/controllerAdmin.php";
    
	$insProfile = new controllerAdmin();
?>


<div class="container-report">
	<div class="row-gutters">
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-user-friends"></i>
				</div>
				<div class="sale-num">
				<h3><?php echo $insAdmin->count_students()?></h3>
					<p>Alumnos</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-user-tie"></i>
				</div>
				<div class="sale-num">
					<h3><?php echo $insAdmin->count_instructors()?></h3>
					<p>Instructores</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-user-cog"></i>
				</div>
				<div class="sale-num">
				<h3><?php echo $insAdmin->count_admin()?></h3>
					<p>Administradores</p>
				</div>
			</div>
		</div>
		<div class="col-3 col-sm-6">
			<div class="info-stats4">
				<div class="info-icon">
					<i class="fas fa-equals"></i>
				</div>
				<div class="sale-num">
				<h3><?php echo $insAdmin->count_allRegisters()?></h3>
					<p>Total Usuarios</p>
				</div>
			</div>
		</div>
	</div>
	
</div>


<div class="row">
    <div class="col-3 col-sm-6">
        <div class="card">
			<div class="card-content">
            
                <?php
                    $profile=$insProfile->get_user_admin_controller();
                ?>

                <!-- se crea la ruta que conecta con el ajax,  -->
                <form action="ajax/adminAjax.php" method="post" autocomplete="off" class="profile-form formulario-ajax">
                    <h2 class="title">Editar Usuario</h2>

                    <div class="profile">
                        <input type="hidden" value="<?php echo $insProfile->encryption($profile['accountCode']) ?>" name="userToEdit">

                        <div class="input-container-profile">
                            <label class="label">Tipo Documento</label>
                            <div class="input-field-profile">
                                <i class="far fa-address-card"></i>
                                <input type="text" value="<?php echo $profile['nameDocumentType']?>" name="dni-profile" required="" readonly/>
                            </div>
                        </div>

                        <div class="input-container-profile">
                            <label class="label">Número Documento</label>
                            <div class="input-field-profile">
                                <i class="far fa-address-card"></i>
                                <input type="text" value="<?php echo $profile['accountDni']?>" name="dni-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{1,30}" readonly/>
                            </div>
                        </div>

                        <div class="input-container-profile">
                            <label class="label">Nombres</label>
                            <div class="input-field-profile">
                                <i class="fas fa-user"></i>
                                <input type="text" value="<?php echo $profile['accountFirstName']?>" name="firstname-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}"/>
                            </div>
                        </div>

                        <div class="input-container-profile">
                            <label class="label">Apellidos</label>
                            <div class="input-field-profile">
                                <i class="fas fa-user"></i>
                                <input type="text" value="<?php echo $profile['accountLastName']?>" name="lastname-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}"/>
                            </div>
                        </div>

                        <div class="input-container-profile">
                            <label class="label">Dirección</label>
                            <div class="input-field-profile">
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="text" value="<?php echo $profile['accountAddress']?>" name="adress-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#\- ]{1,30}"/>
                            </div>
                        </div>

                        <div class="input-container-profile">                        
                            <label class="label">Telefono</label>
                            <div class="input-field-profile">
                                <i class="fas fa-phone-alt"></i>
                                <input type="text" value="<?php echo $profile['accountPhone']?>" name="phone-profile" required="" pattern="[0-9]{7,20}"/>
                            </div>
                        </div>  

                        <div class="input-container-profile">
                            <label class="label">Correo</label>
                            <div class="input-field-profile">
                                <i class="fas fa-envelope"></i>
                                <input type="email" value="<?php echo $profile['accountEmail']?>" required="" name="email-profile" readonly=""/>
                            </div>
                        </div>

                        <div class="input-container-profile">
                            <label class="label">Género</label>
                            <div class="input-field-profile">
                                <i class="far fa-address-card"></i>
                                <input type="text" value="<?php echo $profile['nameGenre']?>" name="dni-profile" required="" readonly/>
                            </div>
                        </div> 

                        <div class="input-container-profile">
                            <label class="label">Rol</label>
                            <?php echo $insProfile-> list_role_controller($profile['accountRole'] ? $profile['accountRole'] : null)?>
                        </div> 

                        <div class="input-container-profile">
                            <label class="label">Estado</label>
                            <?php echo $insProfile-> list_state_controller($profile['accountState'] ? $profile['accountState'] : null)?>
                        </div>
                        
                    </div>

                    <input type="submit" class="btn-kohaku-profile" value="Guardar" />

                    <div class="RespuestaAjax"></div>
                </form>          
            </div>
        </div>
    </div>
</div>
