<?php
	require_once"./controller/controllerProgress.php";
	$insProgress = new controllerProgress();
?>

<div class="row">
    <div class="col-12 col-m-12 col-sm-12">
        <div class="card">
			<div class="card-content">
                <div class="header-class">
                    <h1>Registar Progreso</h1>
                    <div>
                        <!-- <a href="<?php echo SERVERURL; ?>calendar" class="btn-kohaku">
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </a> -->

                        <a href="<?php echo SERVERURL; ?>progress" class="btn-kohaku">
                            <i class="far fa-file"></i> Registros
                        </a>
                    </div>
                </div>

                <!-- se crea la ruta que conecta con el ajax,  -->
                <form action="ajax/newPayAjax.php" method="post" autocomplete="off" class="payment-form formulario-ajax">
                    <div class="payment">
                        <div class="input-container">
                            <label class="label">Fecha</label>
                            <div class="input-field">
                                <input type="date" name="date-newprogress" required="" />
                            </div>
                        </div>
                        
                        <div class="input-container">
                            <label class="label">Documento</label>
                            <div class="input-field">
                                <input type="texbox" name="dni-newprogress" minlength="1" maxlength="100"/>
                            </div>
                        </div>

                        <div class="input-container">
                            <label class="label">Ascenso</label>
                            <?php echo $insPayment->list_procedure_controller() ?> 
                        </div>

                        <div class="input-container">
                            
                            <label class="label">Observaciones</label>
                            <div class="input-field">
                                <input type="texbox" name="observation-newprogress" minlength="1" maxlength="100"/>
                            </div>
                        </div>

                    </div>

                    <input type="submit" class="btn-kohaku-newprogress" value="Guardar" />

                    <div class="RespuestaAjax"></div>
                </form>          
            </div>
        </div>
    </div>
</div>
