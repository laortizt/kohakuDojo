<?php
    
    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }

    //MODELO PARA CREAR USUARIO completar info usuario
    class modelProfile extends mainModel{

        public function list_genres_model() {
            $conexion= mainModel::connect();

            //Obtiene los géneros registrados
            $datos = $conexion->query("SELECT * FROM genre");
            return $datos->fetchAll();
        }

        public function list_typeDocuments_model() {
            $conexion= mainModel::connect();

            //Obtiene los géneros registrados
            $datos = $conexion->query("SELECT * FROM documenttype");
            return $datos->fetchAll();
        }

        public function get_profile_model($code) {
            $sql= mainModel::connect()->prepare("SELECT idAccount, accountCode, accountEmail, accountDocumentType,
                accountDni, accountFirstName, accountLastName, accountAddress, accountPhone, accountGenre
                FROM accounts WHERE accountCode=:code");
            $sql->bindParam(':code', $code);
            $sql->execute();

            return $sql->fetch();
        }
    }