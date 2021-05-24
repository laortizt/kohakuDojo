<?php

//buscador admin 
    $petitionAjax=true;

    require_once "../config/ConfigGeneral.php";

    if(isset($_POST)){
        
        //Modulo Admin
        if(isset($_POST['search_user'])){
            $_SESSION['searchUser']=$_POST['search_user'];
        }
        //Eliminar búsqueda
        // if(isset($url)){
        //     echo '<script> location.reload(); </script>';
        // }

    }else{
        session_destroy();
        echo'<script> window.location.href="'.SERVERURL.'login" </script>';
    }
    

 