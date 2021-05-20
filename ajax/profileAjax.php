<?php
$petitionAjax=true;

require_once "../config/ConfigGeneral.php";

//Condicion para comprobar si se reciben los datos del formulario
if(isset($_POST['dni-profile'])){
    require_once"../controller/controllerProfile.php";
	$insProfile= new controllerProfile();

    if(isset($_POST['dni-profile'])&& 
        isset($_POST['firstname-profile'])&&
        isset($_POST['lastname-profile'])&&
        isset($_POST['email-profile'])){

        session_start(['name'=>'SK']);

        echo $insProfile->save_profile();
        echo '<script>window.location.href="'.SERVERURL.'profile"</script>';
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
                window.location.href="'.SERVERURL.'profile"
            });
        </script>';
    }
}else{
    //poner seguridad a la página
    session_start();
    session_destroy();

    echo'<script> window.location.href="'.SERVERURL.'login" </script>';
} 

