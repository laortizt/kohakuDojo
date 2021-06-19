<?php
require_once "./controller/controllerClass.php";
$insClass = new controllerClass();
?>

<div class="container-fluid">
    <div class="row-gutters">

        <?php
        $class = $insClass->get_class_controller();
        ?>

      
<div class="container-fluid">
	<div class="row-gutters">

        <!-- formulario -->
        <div class="col-5 col-sm-12 p-0">
            <div class="info-stats4">
                 <img src="assets/img/japon2.png" alt="image" style="width: 100%;">
            </div>
        </div>

        <div class="col-7 col-sm-12">
            <div class="info-stats4">

                <form action="ajax/ClassAjax.php" method="post" autocomplete="off" class="profile-form formulario-ajax">
                    <div class="header-class">
                        <h1 class="title">Editar Clase</h1>
                    </div>

                    <div class="row g-3">
                        <input type="hidden" value="<?php echo $insClass->encryption($class['idClass']) ?>" name="classToEdit">

                        <div class="col-6">
                            <label class="label-form">Instructor</label>


                            <!-- <input type="text" value="<?php echo $class['classTeacher'] ?>" name="select-instructor" required="" readonly /> -->
                            <?php echo $insClass->list_teachers_controller($class['accountFirstName'] . $class['accountLastName']) ?>

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
                           
                            <?php echo $insClass->list_events_controller($class['classEvents']) ?>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Precio</label>
                            <div class="input-field-profile">
                                <i class="fas fa-user"></i>
                                <input type="text" value="<?php echo $class['classPrice'] ?>" name="eventsPrice" required="" readonly />
                            </div>
                        </div>

                        <?php
							$today = date_create('now');
						?>

						<div class="col-6">
							<label class="label-form">Fecha</label>
							<div class="input-field-profile">
								<input type="date" name="classDate" required="" min="<?= date_format($today, 'Y-m-d') ?>">
							</div>
						</div>
                        <!-- <div class="col-6">
                            <label class="label-form">Fecha</label>
                            <div class="input-field-profile">
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="date" value="<?php echo $class['classDate'] ?>" name="classDate" required="" />
                            </div>
                        </div> -->

                        <div class="col-6">
                            <label class="label-form">Hora Inicio</label>
                            <div class="input-field-profile">
                                <i class="fas fa-phone-alt"></i>
                                <input type="time" value="<?php echo $class['classTimeInit'] ?>" name="classTimeInit" required="" />
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="label-form">Hora fin</label>
                            <div class="input-field-profile">
                                <i class="fas fa-envelope"></i>
                                <input type="time" value="<?php echo $class['classTimeEnd'] ?>" required="" name="classTimeEnd" />
                            </div>
                        </div>

                    </div>

                    <div class="btn-action" style="align-self: end;">

                        <input type="submit" class="btn-action-save" value="Guardar" />


                    </div>

                    <!-- <input type="submit" class="btn-action-save" value="Guardar" style="align-self: end;" /> -->

                </form>

            </div>
        </div>
        

    </div>
</div>