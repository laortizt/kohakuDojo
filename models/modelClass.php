<?php
    
    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }

    //MODELO PARA CREAR CLASE
    class modelClass extends mainModel{
        //Traer la lista de los instuctores
        public function list_teachers_model() {
            $conexion= mainModel::connect();

            //consulta para traer el rol 2 de instructores.
            $datos = $conexion->query("SELECT idAccount, accountFirstName, accountLastName FROM accounts WHERE accountRole=2");
            return $datos->fetchAll();
        }

        public function list_events_model() {
            //Obtiene los trámites registrados
            $datos = mainModel::connect()->query("SELECT * FROM events");
            return $datos->fetchAll();
        }

        public function update_class_model($datos) {
            $sql=mainModel::connect()->prepare("UPDATE class  
                SET classTeacher:Teacher, classTopic:Topic, classEvents:Events, classPrice:Price, classDate:Date, classTimeInit:TimeInit, classTimeEnd:TimeEnd,
                WHERE idClass=:IdClass");
            $sql->bindParam(":Teacher",$datos['Teacher']);
            $sql->bindParam(":Topic",$datos['Topic']);
            $sql->bindParam(":Events",$datos['Events']);
            $sql->bindParam(":Price",$datos['Price']);
            $sql->bindParam(":Date",$datos['Date']);
            $sql->bindParam(":TimeInit",$datos['TimeInit']);
            $sql->bindParam(":TimeEnd",$datos['TimeEnd']);
            $sql->bindParam(":IdAccount",$datos['IdAccount']);

            $sql->execute();

            return $sql;
        }

        //crear clase
        public function create_class_model($datos) {
            $sql=mainModel::connect()->prepare("INSERT INTO class 
                (classTeacher, classTopic, classEvents, classPrice, classDate, classTimeInit, classTimeEnd)
                VALUES (:Teacher, :Topic, :Events, :Price, :dates, :TimeInit, :TimeEnd)");
            $sql->bindParam(":Teacher",$datos['Teacher']);
            $sql->bindParam(":Topic",$datos['Topic']);
            $sql->bindParam(":Events",$datos['Events']);
            $sql->bindParam(":Price",$datos['Price']);
            $sql->bindParam(":dates",$datos['Date']);
            $sql->bindParam(":TimeInit",$datos['TimeInit']);
            $sql->bindParam(":TimeEnd",$datos['TimeEnd']);
            
            $sql->execute();

            return $sql;
        }

        //Eliminar clase
        protected function delete_class($idClass){
            $sql=mainModel::connect()->prepare("DELETE FROM class WHERE idClass=:idClass");
            $sql->bindParam(":idClass",$idClass);
            $sql->execute();

            return $sql;
        }

        //buscar clase 
        public function find_class($idClass) {
            
            $datos = mainModel::connect()->query("SELECT idClass, classTeacher, classTopic, classEvents, classPrice, classDate, classTimeInit, classTimeEnd 
                FROM class WHERE idClass ='$idClass'");
            return $datos->fetchAll();
        }

        public function get_class_model($code) {
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