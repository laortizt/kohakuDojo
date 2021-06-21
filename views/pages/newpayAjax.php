<?php
$petitionAjax=true;

require_once "../config/ConfigGeneral.php";

//Condicion para comprobar si se reciben los datos del formulario
if(isset($_POST['dni-newpay'])){
    require_once "../controller/controllerPayment.php";
	$insProgress= new controllerProgress();

    if(
        //aqui van los datos de los inputs
        isset($_POST['classDate']) &&
        isset($_POST['dni-newpay']) &&
        isset($_POST['procedure-newpay']) &&
        isset($_POST['price-newpay'])
        
        ){

        session_start(['name'=>'SK']);

        echo $insPayment->update_progress_controller();
        echo '<script>window.location.href="'.SERVERURL.'adminSchedule"</script>';
    } else {
        echo '<script>
            swal({
                title: "Actualizar Registro",
                text: "No están todos los datos necesarios.",
                type: "Alert",
                showCancelButton: true, 
                cancelButtonText: "Cancelar",    
                confirmButtonText: "Aceptar",
                reverseButtons: true
            }).then(function(){
                window.location.href="'.SERVERURL.'editProgress"
            });
        </script>';
    }
}else{
    //poner seguridad a la página
    session_start();
    session_destroy();

    echo'<script> window.location.href="'.SERVERURL.'login" </script>';

}