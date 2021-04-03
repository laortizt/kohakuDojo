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

        //Actualizar clase
        public function update_class_model($datos) {
            $sql=mainModel::connect()->prepare("INSERT INTO class 
                (classDate, classTeacher, classTopic)
                VALUES (:Date, :Teacher, :Topic)");
            $sql->bindParam(":Date",$datos['Date']);
            $sql->bindParam(":Teacher",$datos['Teacher']);
            $sql->bindParam(":Topic",$datos['Topic']);
            
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
        public function find_class($id) {
            //Obtiene los perfiles que coincidan con el dni enviado
            // $datos = mainModel::connect()->query("SELECT idClass, classTime, classTeacher, classTopic
            //     FROM class WHERE classTopic ='$Topic'");
            // return $datos->fetchAll();
        }
        
    }