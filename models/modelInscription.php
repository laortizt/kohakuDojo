<?php
    
    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }

    // MODELO PARA ADMINISTRAR INSCRIPCIONES
    class modelInscription extends mainModel {
        // Registrar inscripción
        public function create_inscription_model($data) {
            $sql=mainModel::connect()->prepare("INSERT INTO inscription 
                (inscriptionUserId, inscriptionClass, inscriptionAssisted)
                VALUES (:UserId, :ClassId, :Assisted)");
            $sql->bindParam(":UserId", $data['UserId']);
            $sql->bindParam(":ClassId", $data['ClassId']);
            $sql->bindParam(":Assisted", $data['Assisted']);
            
            $sql->execute();

            return $sql;
        }

        // Actualizar inscripción
        public function update_inscription_model($data) {
            $sql=mainModel::connect()->prepare("UPDATE inscription  
                SET inscriptionUserId=:UserId, inscriptionClass=:ClassId, inscriptionAssisted=:Assisted
                WHERE idInscription=:InscriptionId");

            $sql->bindParam(":UserId", $data['UserId']);
            $sql->bindParam(":ClassId", $data['ClassId']);
            $sql->bindParam(":Assisted", $data['Assisted']);
            $sql->bindParam(":InscriptionId",$data['InscriptionId']);

            $sql->execute();

            return $sql;
        }

        // Eliminar inscripción
        protected function delete_inscription_model($idInscription){
            $sql=mainModel::connect()->prepare("DELETE FROM inscription WHERE idInscription=:InscriptionId");
            $sql->bindParam(":InscriptionId",$idInscription);
            $sql->execute();

            return $sql;
        }

        // Buscar inscripción
        public function find_inscription_model($idInscription) {
            $datos = mainModel::connect()->query("SELECT * FROM inscription WHERE idInscription ='$idInscription'");
            return $datos->fetchAll();
        }

        // Buscar inscripción
        public function find_inscription_by_user_and_classmodel($idUser, $idClass) {
            $sql = mainModel::connect()->prepare("SELECT * FROM inscription
                WHERE inscriptionUserId =:IdUser AND inscriptionClass=:IdClass");
            $sql->bindParam(":IdUser",$idUser);
            $sql->bindParam(":IdClass",$idClass);
            $sql->execute();

            return $sql;
        }

        public function get_inscription_model($idInscription) {
            $sql= mainModel::connect()->prepare("SELECT SQL_CALC_FOUND_ROWS i.*, c.*, a.accountFirstName, a.accountLastName
                FROM inscription i
                INNER JOIN class c ON (i.inscriptionClass = c.idClass)
                INNER JOIN accounts a ON (i.inscriptionUserId = a.idAccount)
                WHERE idInscription=:InscriptionId");
            $sql->bindParam(':InscriptionId', $idInscription);
            $sql->execute();
    
            return $sql->fetch();
        }

        public function get_class_inscriptions($idClass, $start, $register) {
            $sql = mainModel::connect()->prepare("SELECT SQL_CALC_FOUND_ROWS i.*, c.*, a.accountFirstName, a.accountLastName
                FROM inscription i
                INNER JOIN class c ON (i.inscriptionClass = c.idClass)
                INNER JOIN accounts a ON (i.inscriptionUserId = a.idAccount)
                WHERE i.inscriptionClass=:ClassId
                ORDER BY a.accountFirstName ASC LIMIT $start, $register;
            ");
            $sql->bindParam(':ClassId', $idClass);
            $sql->execute();

            return $sql;
        }

        public function get_user_inscriptions($idUser, $start, $register) {
            $sql = mainModel::connect()->prepare("SELECT SQL_CALC_FOUND_ROWS i.*, c.*, a.accountFirstName, a.accountLastName
                FROM inscription i
                INNER JOIN class c ON (i.inscriptionClass = c.idClass)
                INNER JOIN accounts a ON (i.inscriptionUserId = a.idAccount)
                WHERE i.inscriptionUserId=:UserId
                ORDER BY c.classDate ASC LIMIT $start, $register;
            ");
            $sql->bindParam(':UserId', $idUser);

            $sql->execute();
    
            return $sql;
        }
    }