<?php
	require_once"./controller/controllerProfile.php";
	$insProfile= new controllerProfile();
?>

<div class="row">
    <div class="col-12 col-m-12 col-sm-12">
        <div class="card">
			<div class="card-content">
            
                <?php
                    $profile=$insProfile->get_profile_controller();
                ?>

                <!-- se crea la ruta que conecta con el ajax,  -->
                <form action="ajax/profileAjax.php" method="post" autocomplete="off" class="profile-form formulario-ajax">
                    <h2 class="title">Mi Perfil</h2>

                    <div class="profile">

                        <div class="input-container">
                            <label class="label">Tipo Documento</label>
                            <?php echo $insProfile->list_typeDocument_controller($profile['accountDocumentType'])?>
                        </div>

                        <div class="input-container">

                            <label class="label">Número Documento</label>
                            <div class="input-field">
                                <i class="far fa-address-card"></i>
                                <input type="text" value="<?php echo $profile['accountDni']?>" name="dni-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{1,30}"/>
                            </div>
                        </div>

                        <div class="input-container">
                            <label class="label">Nombres</label>
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input type="text" value="<?php echo $profile['accountFirstName']?>" name="firstname-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}"/>
                            </div>
                        </div>

                        <div class="input-container">
                            <label class="label">Apellidos</label>
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input type="text" value="<?php echo $profile['accountLastName']?>" name="lastname-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}"/>
                            </div>
                        </div>

                        <div class="input-container">
                            <label class="label">Dirección</label>
                            <div class="input-field">
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="text" value="<?php echo $profile['accountAddress']?>" name="adress-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#\- ]{1,30}"/>
                            </div>
                        </div>

                        <div class="input-container">
                            <label class="label">Correo</label>
                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input type="email" value="<?php echo $profile['accountEmail']?>" required="" name="email-profile" readonly=""/>
                            </div>
                        </div>
    
                        <div class="input-container">                        
                            <label class="label">Telefono</label>
                            <div class="input-field">
                                <i class="fas fa-phone-alt"></i>
                                <input type="text" value="<?php echo $profile['accountPhone']?>" name="phone-profile" required="" pattern="[0-9]{7,20}"/>
                            </div>
                        </div>  

                        <div class="input-container">
                            <label class="label">Género</label>
                            <?php echo $insProfile->list_genres_controller($profile['accountGenre'])?>
                        </div> 
                    </div>

                    <input type="submit" class="btn-kohaku-profile" value="Guardar" />

                    <div class="RespuestaAjax"></div>
                </form>          
            </div>
        </div>
    </div>
</div>
