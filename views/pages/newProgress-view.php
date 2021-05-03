<?php
	require_once"./controller/controllerProgress.php";
	$insProgress = new controllerProgress();
?>

<div class="row">
    <div class="col-12 col-m-12 col-sm-12">
        <div class="card">
			<div class="card-content">
                <div class="header-class">
                    <h1 class="title">Registar Progreso</h1>
                    <?php include "./views/modules/menuPayments.php"; ?>
                    
                </div>

                <!-- se crea la ruta que conecta con el ajax,  -->
                <form action="ajax/newProgresAjax.php" method="post" autocomplete="off" class="progress-form formulario-ajax">
                    <div class="progress">
                        <div class="input-container">
                            <label class="label">Fecha</label>
                            <div class="input-field">
                                <input type="date" value="<?php echo $payment['progressDate']?>" name="date-newpay" required="" />
                            </div>
                        </div>
                        
                        <div class="input-container">
                            <label class="label">Documento</label>
                            <div class="input-field">
                                <input type="texbox" value="<?php echo $payment['accountDni']?>" name="dni-newpay" minlength="1" maxlength="100"/>
                            </div>
                        </div>

                        <div class="input-container">
                            <label class="label">Trámite</label>
                            <?php echo $insPayment->list_procedure_controller() ?> 
                        </div>

                        

                        <div class="input-container">
                            <label class="label">Valor</label>
                            <div class="input-field">
                                <i class="far fa-dollar-sign"></i>
                                <input type="text"  value="<?php echo $payment['paymentPrice']?>"readonly value="" id="price-newpay" name="price-newpay" required=""/>
                            </div>
                        </div>

                    
                        <div class="input-container">
                            
                            <label class="label">Observaciones</label>
                            <div class="input-field">
                                <input type="texbox"  value="<?php echo $profile['paymentObservation']?>"name="observation-newpay" minlength="1" maxlength="100"/>
                            </div>
                        </div>

                    </div>

                    <input type="submit" class="btn-kohaku-newPay" value="Guardar" />

                    <div class="RespuestaAjax"></div>
                </form>          
            </div>
        </div>
    </div>
</div>
