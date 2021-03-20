<?php
    
    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }

    //MODELO PARA CREAR USUARIO completar info usuario
    class modelSignUp extends mainModel {

        public function add_account($datos) {
            $datos["Role"] = 3;
            $datos["State"] = 1;
            return mainModel::add_account($datos);
        }
    }