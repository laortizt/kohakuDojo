<?php
$petitionAjax=true;

require_once "../config/ConfigGeneral.php";

//Condicion para comprobar si se reciben los datos del calendario
if(isset($_POST['class-date'])){
    require_once"../controller/controllerClass.php";
	$insClass= new controllerClass();

    if(isset($_POST['select-instructor'])&& 
        isset($_POST['topic'])&&
        isset($_POST['class-date'])){
        echo $insClass->save_class();
        //echo '<script>window.location.href="'.SERVERURL.'class"</script>';
    } else {
        echo '<script>
            swal({
                title: "Crear Clase",
                text: "No están todos los campos diligenciados.",
                type: "Alert",
                showCancelButton: true,     
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar"
            }).then(function(){
                window.location.href="'.SERVERURL.'class"
            });
        </script>';
    }
}else{
    //poner seguridad a la página
    session_start();
    session_destroy();

    echo'<script> window.location.href="'.SERVERURL.'login" </script>';
}