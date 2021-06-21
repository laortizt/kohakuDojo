<?php
$petitionAjax = true;

require_once "../config/ConfigGeneral.php";




//Condicion para comprobar si se reciben los datos del formulario
if (isset($_POST['date-newpay']) ||isset($_POST['editPayment'])) {
    require_once "../controller/controllerPayment.php";
    $insPayment = new controllerPayment();
    
    // print_r($_POST);
    if (
        isset($_POST['date-newpay']) &&
        isset($_POST['dni-newpay']) &&
        isset($_POST['procedure-newpay']) &&
        isset($_POST['price-newpay'])){

            echo $insPayment->create_payment_controller();

        }if(isset($_POST['editPayment'])){

            echo $insPayment->create_payment_controller();
        }else{
            echo '<script>
                swal({
                    title: "Guardar pago",
                    text: "No están todos los datos necesarios.",
                    type: "Alert",
                    showCancelButton: true,   
                    cancelButtonText: "Cancelar",  
                    confirmButtonText: "Aceptar",
                    reverseButtons: true
                }).then(function(){
                    window.location.reload()"
                });
            </script>';
        } 
    
    
} else {
    //poner seguridad a la página
    session_start();
    session_destroy();

    echo '<script> window.location.href="' . SERVERURL . 'login" </script>';
}

