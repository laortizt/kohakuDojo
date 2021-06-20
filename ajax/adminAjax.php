<?php
//Procesa agregar adminIstrador
$petitionAjax=true;

require_once "../config/ConfigGeneral.php";

//Condicion para comprobar si se reciben los datos del formulario
if(isset($_POST['Dni']) || isset($_POST['idAccount'])){
    require_once "../controller/controllerAdmin.php";
    $insAdmin= new controllerAdmin();

    if(isset($_POST['Dni'])&& 
        isset($_POST['FirstName'])&&
        isset($_POST['LastName'])&&
        isset($_POST['User'])){
        
    }
        echo $insAdmin->add_controller_Admin();
        
    if (isset($_POST['idAccount'])){
        echo $insAdmin->add_controller_Admin();
    }
} else if (isset($_POST['userToDelete'])) {
    session_start(['name'=>'SK']);

    require_once "../controller/controllerAdmin.php";
    $insAdmin= new controllerAdmin();

    echo $insAdmin->delete_user_controller();
    
} else if (isset($_POST['userToEdit'])){
    session_start(['name'=>'SK']);
    require_once "../controller/controllerAdmin.php";
    $insAdmin= new controllerAdmin();

    echo $insAdmin->update_admin_controller();
} else{
//poner seguridad a la página
    session_start();
    session_destroy();

    //NO ME SALE EL LOGIN CON LOS ESTILOS?????
    echo'<script> window.location.href="'.SERVERURL.'login" </script>';
} 