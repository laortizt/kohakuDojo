<?php
// funcion para cerrar sesión 
$petitionAjax =true;
require_once "../config/ConfigGeneral.php";

if(isset($_GET['token'])){
    require_once "../controller/controllerLogin.php";
    $logout= new ControllerLogin();

    echo $logout->force_logout();
} else{
    session_start();
    session_destroy();

    echo'<script> windows.location.href="'.SERVERURL.'login/" </script>';
}