<?php

//buscador admin
    $petitionAjax=true;

    require_once "../config/ConfigGeneral.php";

    if(isset($_POST)) {
        session_start(['name'=>'SK']);

        if (!isset($_POST['search_page'])) {
            echo'<script> window.location.href="'.SERVERURL.'" </script>';
            return;
        }

        //Modulo Admin
        if ($_POST['search_page'] == 'admin') {
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

           //Modulo Clases     
        } elseif ($_POST['search_page'] == 'adminClass') {
            if(isset($_POST['search_class'])) {
                $_SESSION['searchClass'] = $_POST['search_class'];
            } else {
                $_SESSION['searchClass'] = '';
            }

            echo '<script> window.location.href="'.SERVERURL.'adminClass/" </script>';

        } elseif ($_POST['search_page'] == 'instructor') {
            if(isset($_POST['search_class'])) {
                $_SESSION['searchClass'] = $_POST['search_class'];
            } else {
                $_SESSION['searchClass'] = '';
            }

            echo '<script> window.location.href="'.SERVERURL.'instructor/" </script>';            
        } elseif ($_POST['search_page'] == 'adminAttendance') {
            //Modulo Asistencia 
            if(isset($_POST['search_attendance'])) {
                $_SESSION['searchClass'] = $_POST['search_attendance'];
            } else {
                $_SESSION['searchClass'] = '';
            }

            echo '<script> window.location.href="'.SERVERURL.'adminAttendance/" </script>';

            //Modulo Pagos
        }elseif ($_POST['search_page'] == 'adminPayments') {
            if(isset($_POST['search_pay'])) {
                $_SESSION['searchPay'] = $_POST['search_pay'];
            } else {
                $_SESSION['searchPay'] = '';
            }

            echo '<script> window.location.href="'.SERVERURL.'adminPayments/" </script>';
        }
    } else {
        session_destroy();
        echo'<script> window.location.href="'.SERVERURL.'login" </script>';
    }
