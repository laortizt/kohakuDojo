<?php
require_once "./controller/controllerProfile.php";
$insProfile = new controllerProfile();
?>

<div class="welcome-area">
    <div class="row m-0 align-items-center welcome-container">
        <div class="col-lg-5 col-md-12 p-0">
            <div class="welcome-content">
                <div class="header-class">
                    <h2 class="title-banner">Mi perfil</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-md-12 p-0">
            <div class="welcome-img">
                <img src="assets/img/banPerfil.png" alt="image">
            </div>
        </div>
    </div>
</div>
<!-- -------------------------------------------------------------------- -->
<div class="container-fluid">
    <div class="row-gutters">
        <div class="col-5 col-sm-12">
            <?php
            $profile = $insProfile->get_profile_controller();
            ?>

            <!-- divs -->
            <div class="container-fluid ">
                <div class="row-gutters">
                    <div class="col-6">
                        <div class="info-stats4">

                            <div class="info-icon info-icon-color1">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div class="sale-num">
                                <h3>0</h3>
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
                                <h3>0</h3>
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
                    <div class="col-6">
                        <div class="info-stats4">
                            <div class="info-icon info-icon-color1">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div class="sale-num">
                                <h3>0</h3>
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
                                <h3>0</h3>
                                <p>Clases Asistidas</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        <!-- formulario -->
        <div class="col-7 col-sm-12">

            <!-- <div class="info-stats4">
            </div> -->

            <div class="info-stats4">

                <form action="ajax/profileAjax.php" method="post" autocomplete="off" class="profile-form formulario-ajax">
                    <!-- <div class="header-class">
                        <h1 class="title">Mi perfil</h1>
                    </div> -->

                    <div class="row g-3">

                        <div class="col-6">
                            <label class="label-form">Tipo Documento</label>
                            <?php echo $insProfile->list_typeDocument_controller($profile['accountDocumentType']) ?>
                        </div>

                        <div class="col-6">

                            <label class="label-form">N??mero Documento</label>
                            <div class="input-field-profile">
                                <i class="far fa-address-card"></i>
                                <input type="text" value="<?php echo $profile['accountDni'] ?>" name="dni-profile" required="" pattern="[a-zA-Z????????????????????????0-9 ]{1,30}" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Nombres</label>
                            <div class="input-field-profile">
                                <i class="fas fa-user"></i>
                                <input type="text" value="<?php echo $profile['accountFirstName'] ?>" name="firstname-profile" required="" pattern="[a-zA-Z???????????????????????? ]{1,30}" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Apellidos</label>
                            <div class="input-field-profile">
                                <i class="fas fa-user"></i>
                                <input type="text" value="<?php echo $profile['accountLastName'] ?>" name="lastname-profile" required="" pattern="[a-zA-Z???????????????????????? ]{1,30}" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Direcci??n</label>
                            <div class="input-field-profile">
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="text" value="<?php echo $profile['accountAddress'] ?>" name="adress-profile" required="" pattern="[a-zA-Z????????????????????????0-9#\- ]{1,30}" />
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
                            <label class="label-form">Telefono</label>
                            <div class="input-field-profile">
                                <i class="fas fa-phone-alt"></i>
                                <input type="text" value="<?php echo $profile['accountPhone'] ?>" name="phone-profile" required="" pattern="[0-9]{7,20}" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">G??nero</label>
                            <?php echo $insProfile->list_genres_controller($profile['accountGenre']) ?>
                        </div>
                    </div>

                    <input type="submit" class="btn-kohaku-profile" value="Guardar" />

                    <div class="RespuestaAjax"></div>
                </form>

            </div>
        </div>

    </div>

</div>