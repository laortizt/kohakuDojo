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
            //Obtiene los géneros registrados
            $datos = mainModel::connect()->query("SELECT * FROM documenttype");
            return $datos->fetchAll();
        }

        // Traer datos de un perfil usando el accountCode
        public function get_profile_model($code) {
            $sql= mainModel::connect()->prepare("SELECT idAccount, accountCode, accountEmail, accountDocumentType,
                accountDni, accountFirstName, accountLastName, accountAddress, accountPhone, accountGenre
                FROM accounts WHERE accountCode=:code");
            $sql->bindParam(':code', $code);
            $sql->execute();

            return $sql->fetch();
        }

        //Actualizar perfil
        public function update_profile_model($data) {
            $sql=mainModel::connect()->prepare("UPDATE accounts 
                SET accountDocumentType=:DocumentType, accountDni=:Dni, accountFirstName=:FirstName,
                    accountLastName=:LastName, accountAddress=:Address, accountPhone=:Phone,
                    accountGenre=:Genre
                WHERE idAccount=:IdAccount");
            $sql->bindParam(":DocumentType",$data['DocumentType']);
            $sql->bindParam(":Dni",$data['Dni']);
            $sql->bindParam(":FirstName",$data['FirstName']);
            $sql->bindParam(":LastName",$data['LastName']);
            $sql->bindParam(":Address",$data['Address']);
            $sql->bindParam(":Phone",$data['Phone']);
            $sql->bindParam(":Genre",$data['Genre']);
            $sql->bindParam(":IdAccount",$data['Id']);
            
            $sql->execute();

            return $sql;
        }

        public function find_dni($dni) {
            //Obtiene los perfiles que coincidan con el dni enviado
            $datos = mainModel::connect()->query("SELECT idAccount, accountDni, accountCode
                FROM accounts WHERE accountDni ='$dni'");
            return $datos->fetchAll();
        }
    }