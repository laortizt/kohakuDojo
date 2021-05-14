<?php
require_once "./controller/controllerAdmin.php";

$insProfile = new controllerAdmin();
?>

<div class="container-fluid">
    <div>

    </div>
</div>


<div class="container-fluid">
    <div class="row-gutters">
        <div class="col-6 col-sm-12">
            <div class="info-stats4">

                <?php
                $profile = $insProfile->get_user_admin_controller();
                ?>
                <h1 class="title-form">Editar usuario</h1>
                <img src="<?php echo SERVERURL; ?>assets/img/undraw_personal_info_0okl.png" class="img-form" alt="" />



            </div>

            <div class="container-fluid ">
                <div class="row-gutters">
                    <div class="col-6">
                        <div class="info-stats4">
                            <div class="info-icon info-icon-color1">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div class="sale-num">
                                <h3>6</h3>
                                <p>Clases Restantes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-stats4">
                            <div class="info-icon info-icon-color2">
                                <i class="fa bi bi-calendar-check"></i>
                            </div>
                            <div class="sale-num">
                                <h3>40</h3>
                                <p>Clases Asistidas</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-stats4">
                            <div class="info-icon info-icon-color3">
                                <i class="fa bi bi-clipboard-data"></i>
                            </div>
                            <div class="sale-num">
                                <!-- <h3><?php echo $Admin['nameMenkyo'] ?></h3> -->
                                <h3>Mukyu</h3>
                                <p>Grado</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-stats4">
                            <div class="info-icon info-icon-color4">
                                <i class="fas  fa-tasks"></i>
                            </div>
                            <div class="sale-num">
                                <h3>Premium</h3>
                                <p>Plan</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


        </div>


        <div class="col-6 col-sm-12">

            <div class="info-stats4">

                <form action="ajax/adminAjax.php" method="post" autocomplete="off" class="profile-form formulario-ajax">

                    <div class="row g-3">
                        <input type="hidden" value="<?php echo $insProfile->encryption($profile['accountCode']) ?>" name="userToEdit">

                        <div class="col-6">
                            <label class="label-form">Tipo Documento</label>
                            <div class="input-field-profile">
                                <i class="far fa-address-card"></i>
                                <input type="text" value="<?php echo $profile['nameDocumentType'] ?>" name="dni-profile" required="" readonly />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Número Documento</label>
                            <div class="input-field-profile">
                                <i class="far fa-address-card"></i>
                                <input type="text" value="<?php echo $profile['accountDni'] ?>" name="dni-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{1,30}" readonly />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Nombres</label>
                            <div class="input-field-profile">
                                <i class="fas fa-user"></i>
                                <input type="text" value="<?php echo $profile['accountFirstName'] ?>" name="firstname-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Apellidos</label>
                            <div class="input-field-profile">
                                <i class="fas fa-user"></i>
                                <input type="text" value="<?php echo $profile['accountLastName'] ?>" name="lastname-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Dirección</label>
                            <div class="input-field-profile">
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="text" value="<?php echo $profile['accountAddress'] ?>" name="adress-profile" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#\- ]{1,30}" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Telefono</label>
                            <div class="input-field-profile">
                                <i class="fas fa-phone-alt"></i>
                                <input type="text" value="<?php echo $profile['accountPhone'] ?>" name="phone-profile" required="" pattern="[0-9]{7,20}" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Correo</label>
                            <div class="input-field-profile">
                                <i class="fas fa-envelope"></i>
                                <input type="email" value="<?php echo $profile['accountEmail'] ?>" required="" name="email-profile" readonly="" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Género</label>
                            <div class="input-field-profile">
                                <i class="far fa-address-card"></i>
                                <input type="text" value="<?php echo $profile['nameGenre'] ?>" name="dni-profile" required="" readonly />
                            </div>
                        </div>

                       
                        <div class="col-6">
                            <label class="label-form">Rol</label>
                            <?php echo $insProfile->list_role_controller($profile['accountRole'] ? $profile['accountRole'] : null) ?>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Estado</label>
                            <?php echo $insProfile->list_state_controller($profile['accountState'] ? $profile['accountState'] : null) ?>
                        </div>
                       
                    </div>


                    <div class="btn-action">
                        
                            <input type="submit" class="btn-action-save " value="Guardar" />
                            <a href="<?php echo SERVERURL; ?>admin" class="btn-action-delete  ">
                                <span>Cancelar</span>
                            </a>
    

                    </div>

                    
                </form>

            </div>
        </div>


    </div>



</div>