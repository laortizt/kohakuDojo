<?php

//buscador admin
    $petitionAjax=true;

    require_once "../config/ConfigGeneral.php";

    if(isset($_POST)) {
        session_start(['name'=>'SK']);

        //Modulo Admin
        if (isset($_POST['search_page'])) {
            if(isset($_POST['search_user'])) {
                $_SESSION['searchUser'] = $_POST['search_user'];
            } else {
                $_SESSION['searchUser'] = '';
            }

            // if(isset($_POST['search_user'])) {
            //     require_once "../controller/controllerAdmin.php";
            //     $insAdmin= new controllerAdmin();
            //     echo $insAdmin->pages_admin_controller(1, 10, $_SESSION['role_sk'], $_SESSION['code_sk'], $_POST['search_user']);
            // }

            echo '<script> window.location.href="'.SERVERURL.'admin/" </script>';
        }
    } else {
        session_destroy();
        echo'<script> window.location.href="'.SERVERURL.'login" </script>';
    }
