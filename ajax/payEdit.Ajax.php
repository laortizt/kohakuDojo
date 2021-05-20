<?php
$petitionAjax=true;

require_once "../config/ConfigGeneral.php";

//Condicion para comprobar si se reciben los datos del formulario
if(isset($_POST['dni-profile'])){
    require_once"../controller/controllerPayment.php";
	$insPayment= new controllerPayment();

    //aqui van los datos de los inputs
    if(isset($_POST['paymentDate'])&& 
        isset($_POST['accountDni'])&&
        isset($_POST['procedureName'])&&
        isset($_POST['paymentPrice'])&&
        isset($_POST['paymentObservation'])&&
        isset($_POST['firstname-profile'])&&
        isset($_POST['lastname-profile'])){

        session_start(['name'=>'SK']);

        echo $insPayment->update_payment_controller();
        echo '<script>window.location.href="'.SERVERURL.'payEdit"</script>';
    } else {
        echo '<script>
            swal({
                title: "Actualizar perfil",
                text: "No están todos los datos necesarios.",
                type: "Alert",
                showCancelButton: true,     
                cancelButtonText: "Cancelar",
                confirmButtonText: "Aceptar",
                
            }).then(function(){
                window.location.href="'.SERVERURL.'payEdit"
            });
        </script>';
    }
}else{
    //poner seguridad a la página
    session_start();
    session_destroy();

    echo'<script> window.location.href="'.SERVERURL.'login" </script>';
} 
