<?php
    
    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }

    //MODELO PARA CREAR USUARIO completar info usuario
    class modelSignUp extends mainModel{
        public function add_modelSignUp($datos){
            $sql=mainModel::connect()->prepare("INSERT INTO users (usersFirstName, usersLastName,) OUTPUT inserted.accountEmail, inserted.accountPassword INTO accounts VALUES(:FirstName,:LastName)(:Email, :Password)");
            $sql->bindParam(":FirstName", $datos['FirstName']);
            $sql->bindParam(":LastName", $datos['LastName']);
            $sql->bindParam(":Email", $datos['Email']);
            $sql->bindParam(":Password", $datos['Password']);
           
            $sql->execute();

            return $sql;
        }
}