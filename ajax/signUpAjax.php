<?php
//Procesa agregar adminIstrador
$petitionAjax=true;

require_once "../config/ConfigGeneral.php";

//Condicion para comprobar si se reciben los datos del formulario
if(isset($_POST['emailSignUp'])){
    require_once "../controller/controllerSignUp.php";
    $insUser= new controllerSignUp();

    if(isset($_POST['emailSignUp'])&& 
        isset($_POST['firstname'])&&
        isset($_POST['lastname'])&&
        isset($_POST['passwordSignUp'])){
            echo $insUser->add_controller_User();
    } else {
        // echo $insUser->add_User_incomplete_data();  ERROR EN ESTÁ LINEA OOOOOJOOOOOOOO
    }
}else{
//poner seguridad a la página
    session_start();
    session_destroy();

    //NO ME SALE EL LOGIN CON LOS ESTILOS?????
   // echo'<script> window.location.href="'.SERVERURL.'login" </script>';
} 