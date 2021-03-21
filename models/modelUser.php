<?php
    
    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }

    //MODELO PARA CREAR USUARIO completar info usuario
    class modelUser extends mainModel{
        
        public function add_user_account($datos) {
            $datos["Role"] = 3;
            return mainModel::add_account($datos);
        }
    }