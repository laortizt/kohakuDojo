<?php

$petitionAjax=true;
require_once "../config/ConfigGeneral.php";

require_once "../controller/controllerClass.php";
$insClass= new controllerClass();

// Condicion para comprobar si se reciben los datos de la clase
if (isset($_POST['classToDelete'])) {
    session_start(['name'=>'SK']);
    echo $insClass->delete_class_controller();
} else if (isset($_POST['classDate'])) {
    session_start(['name'=>'SK']);

    if (isset($_POST['select-instructor'])&& 
        isset($_POST['classTopic'])&&
        isset($_POST['select-event'])&&
        isset($_POST['eventsPrice'])&&
        isset($_POST['classDate']) &&
        isset($_POST['classTimeInit']) &&
        isset($_POST['classTimeEnd'])
    ){
        if (isset($_POST['classToEdit'])) {
            echo $insClass->update_class_controller();
        } else {
            echo $insClass->save_class();
        }
    } else {
        echo '<script>
            swal({
                title: "Guardar clase",
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

    echo'<script> window.location.href="'.SERVERURL.'login" </script>';
}