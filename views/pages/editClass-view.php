<?php
require_once "./controller/controllerClass.php";
$insClass = new controllerClass();

?>

<div class="container-fluid">
    <div class="row-gutters">

        <?php
        $class = $insClass->update_class_controller();
        ?>
        <!-- formulario -->
        <div class="col-6 col-sm-12">
            <div class="info-stats4">
                <form action="ajax/ClassAjax.php" method="post" autocomplete="off" class="profile-form formulario-ajax">
                    <div class="header-class">
                        <h1 class="title">Editar Pago</h1>
                    </div>


                    <div class="row g-3">
                        <input type="hidden" value="<?php echo $insClass->encryption($class['idClass']) ?>" name="userToEdit">

                        <div class="col-6">
                            <label class="label-form">Instructor</label>
                            <div class="input-field-profile">
                                <i class="far fa-address-card"></i>
                                <input type="text" value="<?php echo $class['select-instructor'] ?>" name="select-instructor" required="" readonly />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Tema</label>
                            <div class="input-field-profile">
                                <i class="far fa-address-card"></i>
                                <input type="text" value="<?php echo $class['classTopic'] ?>" name="classTopic" required="" readonly />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Tipo de Evento</label>
                            <div class="input-field-profile">
                                <i class="fas fa-user"></i>
                                <input type="text" value="<?php echo $class['select-event'] ?>" name="select-event" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Precio</label>
                            <div class="input-field-profile">
                                <i class="fas fa-user"></i>
                                <input type="text" value="<?php echo $class['eventsPrice'] ?>" name="eventsPrice" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Fecha</label>
                            <div class="input-field-profile">
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="date" value="<?php echo $class['classDate'] ?>" name="classDate" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9#\- ]{1,30}" />
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Hora Inicio</label>
                            <div class="input-field-profile">
                                <i class="fas fa-phone-alt"></i>
                                <input type="time" value="<?php echo $class['classTimeInit'] ?>" name="classTimeInit" required="" pattern="[0-9]{7,20}" />
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Hora fin</label>
                            <div class="input-field-profile">
                                <i class="fas fa-envelope"></i>
                                <input type="time" value="<?php echo $class['classTimeEnd'] ?>" required="" name="classTimeEnd" pattern="[0-9]{7,20}" readonly="" />
                            </div>
                        </div>



                        <div class="btn-action" style="align-self: end;">

                            <input type="submit" class="btn-action-save" value="Guardar" />
                            <!-- <a href="<?php echo SERVERURL; ?>admin" class="btn-action-delete  ">
                            <span>Cancelar</span>
                        </a> -->


                        </div>


                </form>

            </div>
        </div>

    </div>

</div>