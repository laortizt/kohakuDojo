<?php
	require_once"./controller/controllerProfile.php";
	$insProfile= new controllerProfile();
?>

<div class="row">
    <div class="col-12 col-m-12 col-sm-12">
        <div class="card">
			<div class="card-content">
            
                <!-- <?php
                    $profile=$insProfile->get_profile_controller();
                ?> -->
                <div class="header-class">
                    <h1>Lista de Pagos</h1>
                    <a href="<?php echo SERVERURL; ?>newPay/" class="btn-kohaku">
                        <i class="fas fa-plus-circle"></i>
                        Añadir
                    </a>
                    <a href="<?php echo SERVERURL; ?>calendar/" class="btn-kohaku">
                        <i></i> Eliminar
                    </a>
                    <a href="<?php echo SERVERURL; ?>payments/" class="btn-kohaku">
                        <i></i> Lista
                    </a>
                </div>

                <!-- se crea la ruta que conecta con el ajax,  -->
                <form action="ajax/newPayAjax.php" method="post" autocomplete="off" class="profile-form formulario-ajax">
                    <div class="profile">
                        
                    <div class="input-container">
                            <label class="label">Fecha</label>
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input type="date" value="<?php echo $profile['accountLastName']?>" name="lastname-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}"/>
                            </div>
                        </div>

                        <div class="input-container">

                            <label class="label">Concepto</label>
                            <div class="input-field">
                                <i class="far fa-address-card"></i>
                                <input type="text" value="<?php echo $profile['accountDni']?>" name="dni-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{1,30}"/>
                            </div>
                        </div>

                        <div class="input-container">

                            <label class="label">Monto</label>
                            <div class="input-field">
                                <i class="far fa-address-card"></i>
                                <input type="text" value="<?php echo $profile['accountDni']?>" name="dni-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{1,30}"/>
                            </div>
                        </div>

                        

                        <div class="input-container">
                            <label class="label">Estado</label>
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input type="text" value="<?php echo $profile['accountLastName']?>" name="lastname-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}"/>
                            </div>
                        </div>

                    
                        <div class="input-container">
                            <label class="label">Género</label>
                            <?php echo $insProfile->list_genres_controller($profile['accountGenre'])?>
                        </div> 
                    </div>

                    <input type="submit" class="btn-kohaku-newPay" value="Guardar" />

                    <div class="RespuestaAjax"></div>
                </form>          
            </div>
        </div>
    </div>
</div>
