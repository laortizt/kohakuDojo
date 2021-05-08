<?php

if ($petitionAjax) {
    require_once "../config/mainModel.php";
} else {
    // si la eticion ajax es fale aceder a la configuración DB
    require_once "./config/mainmodel.php";
}

//MODELO PARA CREAR USUARIO completar info usuario
class modelAdmin extends mainModel
{
    protected function list_genres_model() {
        $conexion= mainModel::connect();

        //Obtiene los géneros registrados
        $datos = $conexion->query("SELECT * FROM genre");
        return $datos->fetchAll();
    }

    protected function list_typeDocuments_model() {
        //Obtiene los géneros registrados
        $datos = mainModel::connect()->query("SELECT * FROM documenttype");
        return $datos->fetchAll();
    }

    protected function list_role_model() {
        //Obtiene los roles registrados
        $datos = mainModel::connect()->query("SELECT * FROM role");
        return $datos->fetchAll();
    }

    protected function list_state_model() {
        //Obtiene los roles registrados
        $datos = mainModel::connect()->query("SELECT * FROM state");
        return $datos->fetchAll();
    }

    protected function add_admin_account($data){
        $sql = mainModel::connect()->prepare("UPDATE accounts 
                SET accountDocumentType=:DocumentType, accountDni=:Dni, accountFirstName=:FirstName,
                    accountLastName=:LastName,  accountAddress=:Address, accountPhone=:Phone,
                    accountGenre=:Genre, accountEmail=:Email, accountRole=:Role, accountState=:State, 
                WHERE idAccount=:IdAccount");
        $sql->bindParam(":DocumentType", $data['DocumentType']);
        $sql->bindParam(":Dni", $data['Dni']);
        $sql->bindParam(":FirstName", $data['FirstName']);
        $sql->bindParam(":LastName", $data['LastName']);
        $sql->bindParam(":Address", $data['Address']);
        $sql->bindParam(":Phone", $data['Phone']);
        $sql->bindParam(":Genre", $data['Genre']);
        $sql->bindParam(":Email", $data['Email']);
        $sql->bindParam(":Role", $data['Role']);
        $sql->bindParam(":State", $data['State']);
        $sql->bindParam(":IdAccount", $data['Id']);

        $sql->execute();

        return $sql;
    }

    protected function delete_admin_model($id){
        $query = mainModel::connect()->prepare("DELETE FROM accounts WHERE IdAccount=:Id");
        $query->bindParam(":Id", $id);
        $query->execute();
        return $query;
    }
    //Actualizar perfil
    public function update_admin_model($data){
        $sql = mainModel::connect()->prepare("UPDATE accounts 
            SET accountDocumentType=:DocumentType, accountDni=:Dni, accountFirstName=:FirstName,
                accountLastName=:LastName,  accountAddress=:Address, accountPhone=:Phone,
                accountGenre=:Genre, accountEmail=:Email, accountRole=:Role, accountState=:State 
            WHERE idAccount=:IdAccount");
        $sql->bindParam(":DocumentType", $data['DocumentType']);
        $sql->bindParam(":Dni", $data['Dni']);
        $sql->bindParam(":FirstName", $data['FirstName']);
        $sql->bindParam(":LastName", $data['LastName']);
        $sql->bindParam(":Address", $data['Address']);
        $sql->bindParam(":Phone", $data['Phone']);
        $sql->bindParam(":Genre", $data['Genre']);
        $sql->bindParam(":Email", $data['Email']);
        $sql->bindParam(":Role", $data['Role']);
        $sql->bindParam(":State", $data['State']);
        $sql->bindParam(":IdAccount", $data['Id']);

        $sql->execute();

        return $sql;
    }

    public function find_dni($dni){
        //Obtiene los perfiles que coincidan con el dni enviado
        $sql = mainModel::connect()->prepare("SELECT idAccount, accountDni, accountCode
            FROM accounts WHERE accountDni ='$dni'");
        $sql->bindParam(':Dni', $dni);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function find_email($email){
        //Obtiene los correos que coincidan con el dni enviado
        $sql = mainModel::connect()->prepare("SELECT idAccount, accountDni, accountCode
            FROM accounts WHERE accountEmail = '$email'");
        $sql->bindParam(':Email', $email);
        $sql->execute();

        return $sql->fetch();
    }

    public function find_menkyo($menkyo){
        //Obtiene el menkyo que coincidan con el dni enviado
        $sql = mainModel::connect()->prepare("SELECT idAccount, accountDni, accountCode
            FROM accounts WHERE accountMenkyo = '$menkyo'");
        $sql->bindParam(':Menkyo', $email);
        $sql->execute();

        return $sql->fetch();
    }

    public function find_code($code){
        //Obtiene el código único del usuario
        $sql = mainModel::connect()->prepare("SELECT idAccount, accountDni, accountCode
            FROM accounts WHERE accountCode=:Code");
        $sql->bindParam(':Code', $code);
        $sql->execute();

        return $sql->fetch();
    }

    public function get_profile_model($code) {
        $sql= mainModel::connect()->prepare("SELECT a.idAccount, a.accountCode, a.accountEmail, 
            a.accountDocumentType, a.accountDni, a.accountFirstName, a.accountLastName,
            a.accountAddress, a.accountPhone, a.accountGenre, a.accountRole, a.accountState, 
            dt.nameDocumentType, g.nameGenre
            FROM accounts a
            JOIN documenttype dt ON (a.accountDocumentType = dt.idDocumentType)
            JOIN genre g ON (a.accountGenre = g.idGenre)
            WHERE a.accountCode=:code");
        $sql->bindParam(':code', $code);
        $sql->execute();

        return $sql->fetch();
    }
}   
