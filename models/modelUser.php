<?php
    
    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }

    //MODELO PARA CREAR USUARIO completar info usuario
    class modelUser extends mainModel{
        public function add_modelUser($datos){
            $sql=mainModel::connect()->prepare("INSERT INTO users(usersTypeDocument,ususersDni,usersFirstName,usersLastName,usersAddres,usersEmail,usersCode,usersPhone,usersGenre) VALUES(:Dni,:FirstName,:LastName,:Addres,:Code,:Phone)");
            $sql->bindParam(":TypeDocument", $datos['TypeDocument']);
            $sql->bindParam(":Dni", $datos['Dni']);
            $sql->bindParam(":FirstName", $datos['FirstName']);
            $sql->bindParam(":LastName", $datos['LastName']);
            $sql->bindParam(":Addres", $datos['Addres']);
            $sql->bindParam(":Email", $datos['Email']);
            $sql->bindParam(":Code", $datos['Code']);
            $sql->bindParam(":Phone", $datos['Phone']);
            $sql->bindParam(":Genre", $datos['Genre']);
            $sql->execute();
            return $sql;

        }
}