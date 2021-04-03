<?php
    
    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }

    //MODELO PARA CREAR USUARIO completar info usuario
    class modelAdmin extends mainModel {

        public function add_admin_account($datos) {
            $datos["Role"] = 1;
            return mainModel::add_account($datos);
        }

        //Actualizar perfil
        public function update_admin_model($data) {
            $sql=mainModel::connect()->prepare("UPDATE accounts 
                SET accountDocumentType=:DocumentType, accountDni=:Dni, accountFirstName=:FirstName,
                    accountLastName=:LastName,  accountAddress=:Address, accountPhone=:Phone,
                    accountGenre=:Genre, accountEmail=:Email, accountRole=:Role, accountState=:State, 
                WHERE idAccount=:IdAccount");
            $sql->bindParam(":DocumentType",$data['DocumentType']);
            $sql->bindParam(":Dni",$data['Dni']);
            $sql->bindParam(":FirstName",$data['FirstName']);
            $sql->bindParam(":LastName",$data['LastName']);
            $sql->bindParam(":Address",$data['Address']);
            $sql->bindParam(":Phone",$data['Phone']);
            $sql->bindParam(":Genre",$data['Genre']);
            $sql->bindParam(":Email",$data['Email']);
            $sql->bindParam(":Role",$data['Role']);
            $sql->bindParam(":State",$data['State']);
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

        public function find_email($email) {
            //Obtiene los correos que coincidan con el dni enviado
            $datos=mainModel::connect()->query("SELECT idAccount, accountDni, accountCode
            FROM accounts WHERE accountEmail = '$email'");

            return $datos->fetchAll();
        }
        
    }