<?php

    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }
    class modelLogin extends mainModel{
        //funcion que recibe los  datos del login para verificrlos con la base de datos
        protected function start_model_session($datos){
            // $statu=1;
            //comparcion de los datos recibidos en el login y los datos guardados en la base de datos
            $sql=mainModel::connect()->prepare("SELECT * FROM account WHERE accountUser=:User AND accountPassword=:Password AND accountEstate; ");
            $sql->bindParam(':User',$datos['User']);
            $sql->bindParam(':Password',$datos['Password']);
            $sql->execute();
            return $sql;
        }
    }