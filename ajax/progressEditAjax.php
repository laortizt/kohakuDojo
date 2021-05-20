<?php
$petitionAjax=true;

require_once "../config/ConfigGeneral.php";

//Condicion para comprobar si se reciben los datos del formulario
if(isset($_POST['dni-progress'])){
    require_once"../controller/controllerProgress.php";
	$insProgress= new controllerProgress();

    if(
        //aqui van los datos de los inputs
        isset($_POST['date-progress']) &&
        isset($_POST['dni-progress']) &&
        isset($_POST['menkyo-progress']) &&
        isset($_POST['observation-progress']) &&
        isset($_POST['state-progress'])
        ){

        session_start(['name'=>'SK']);

        echo $insProgress->update_progress_controller();
        echo '<script>window.location.href="'.SERVERURL.'editProgress"</script>';
    } else {
        echo '<script>
            swal({
                title: "Actualizar Registro",
                text: "No están todos los datos necesarios.",
                type: "Alert",
                showCancelButton: true, 
                cancelButtonText: "Cancelar",    
                confirmButtonText: "Aceptar",
                
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
