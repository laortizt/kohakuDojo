<?php
	require_once"./controller/controllerProgress.php";
    require_once"./controller/controllerProfile.php";
    
	$insProgress = new controllerProgress();
    $insProfile = new controllerProfile();
    
?>


<div class="row">
    <div class="col-12 col-m-12 col-sm-12">
        <div class="card">
			<div class="card-content">
                <div class="header-class">
                    <h1 class="title">Editar Progreso</h1>
                    <?php include "./views/modules/menuProgress.php"; ?>
                    
                    <?php
                        $progress=$insProgress->get_progressUser_controller();

                        print_r($progress);
                    ?>

                </div>

                <!-- se crea la ruta que conecta con el ajax,  -->
                 <div class="container-form">
                    <div class="row form-left">
                        <div class="img-form">
                        <img src="/assets/img/leslie-jones-urBiLDuUhMU-unsplash.jpg"  alt="">
                        </div>
                    </div>

                    <div class="row form-righ">
                        <form action="ajax/EditProgressAjax.php" method="post" autocomplete="off" class="progress-form formulario-ajax">
                            <div class="payment">
                                
                            <input type="hidden" value="<?php echo $insProgress->encryption($progress['accountCode']) ?>" name="userToEdit">
                                
                            <div class="input-container">
                                    <label class="label">Fecha</label>
                                    <div class="input-field">
                                    <input type="date" name="date-progress" value="<?php echo $progress['progressDate']?>" required="" />
                                    </div>
                                </div>
                                
                                <div class="input-container">
                                    <label class="label">Documento</label>
                                    <div class="input-field">
                                        <input type="texbox" name="dni-progress" value="<?php echo $progress['progressDni']?>"  minlength="1" maxlength="100"/>
                                    </div>
                                </div>

                                <div class="input-container">
                                    <label class="label">Grado a promover</label>
                                    <?php echo $insProgress->list_menkyo_controller() ?> 
                                </div>

                                <div class="input-container">
                                    
                                    <label class="label">Observaciones</label>
                                    <div class="input-field">
                                    <input type="texbox" name="observation-progress"  value="<?php echo $progress['progressObservation']?>" minlength="1" maxlength="100"/>
                                    </div>
                                </div>

                                <div class="input-container">
                                    <label class="label">Estado</label>
                                    <?php echo $insProgress->list_state_controller() ?> 
                                </div>

                            </div>

                            <input type="submit" class="btn-kohaku-newPay" value="Guardar" />

                            <div class="RespuestaAjax"></div>
                        </form> 
                    </div> 
                </div>       
            </div>
        </div>
    </div>
</div>
