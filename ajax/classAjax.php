<?php
$petitionAjax=true;

require_once "../config/ConfigGeneral.php";

//Condicion para comprobar si se reciben los datos del calendario
if(isset($_POST['classDate'])){
    require_once"../controller/controllerClass.php";
	$insClass= new controllerClass();

    if(isset($_POST['select-instructor'])&& 
        isset($_POST['classTopic'])&&
        isset($_POST['classDate']) &&
        isset($_POST['classTimeInit']) &&
        isset($_POST['classTimeEnd'])
    ){
        echo $insClass->save_class();
        //echo '<script>window.location.href="'.SERVERURL.'class"</script>';
    } if (isset($_POST['idAccount'])){
        echo$insAdmin->add_controller_Admin();
    }
} else if (isset($_POST['classToDelete'])) {
    session_start(['name'=>'SK']);

    require_once"../controller/controllerClass.php";
    $insClass= new controllerClass();

    echo $insClass->delete_class_controller();
    
} else if (isset($_POST['classToEdit'])){
    session_start(['name'=>'SK']);
    require_once"../controller/controllerClass.php";
    $insClass= new controllerClass();

    echo $insClass->update_class_controller();
    
}else{
    //poner seguridad a la página
    session_start();
    session_destroy();

    echo'<script> window.location.href="'.SERVERURL.'login" </script>';
}