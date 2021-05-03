<?php
    
    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }

    //MODELO PARA PROGRESO DE ALUMNOS
    class modelProgress extends mainModel{

        //Traer la lista de grados
        public function list_menkyo_model() {
            //Obtiene los tramites
            $datos = mainModel::connect()->query("SELECT * FROM menkyo");
            return $datos->fetchAll();
        }
        //Traer la lista de estados
        protected function list_state_model() {
            //Obtiene los estados registrados
            $datos = mainModel::connect()->query("SELECT * FROM state");
            return $datos->fetchAll();
        }
        //registrar progreso a usuario
        public function add_progress_model($datos) {
            $sql=mainModel::connect()->prepare("INSERT INTO progress 
                (progressDate, progressDni, progressMenkyo,   
                progressObservation, progressState, progressAccount)
                VALUES (:Date,:Dni, :Menkyo, :Observation, :state, :IdAccount)");
            $sql->bindParam(":Date",$datos['Date']);
            $sql->bindParam(":Dni",$datos['Dni']);
            $sql->bindParam(":Menkyo",$datos['Menkyo']);
            $sql->bindParam(":Observation",$datos['Observation']);
            $sql->bindParam(":State",$datos['State']);
            $sql->bindParam(":IdAccount",$datos['IdAccount']);
            
            $sql->execute();

            return $sql;
        }
        
        // Listar  progresos
        public function get_progress_model($code) {
            $sql= mainModel::connect()->prepare("SELECT p.*, a.accountCode
                FROM progress p INNER JOIN accounts a ON (p.progressAccount = a.idAccount) WHERE a.accountDni=:dni");
            $sql->bindParam(':code', $code);
            $sql->execute(); 

            return $sql->fetch();
        }
        
        // Editar progreso
        public function update_progress_model($data) {
            $sql=mainModel::connect()->prepare("UPDATE progress  
                SET progresstDate=:Date,  progressDni=:Dni, progressMenkyo=:Menkyo, 
                progressObservation=:Observation, progressState=:State, progressAccount=:IdAccount
                WHERE idProgress=:IdProgress");
            $sql->bindParam(":Date",$data['Date']);
            $sql->bindParam(":Dni",$data['Dni']);
            $sql->bindParam(":Menkyo",$data['Menkyo']);
            $sql->bindParam(":Observation",$data['Observation']);
            $sql->bindParam(":State",$data['State']);
            $sql->bindParam(":IdAccount",$data['IdAccount']);

            $sql->execute();

            return $sql;
        }
         
        //Eliminar Progreso
        protected function delete_progress_model($idPay){
            $sql=mainModel::connect()->prepare("DELETE FROM progress WHERE idProgress=:idProgress");
            $sql->bindParam(":idProgress",$idProgress);
            $sql->execute();

            return $sql;
        }

        //Buscar documento
        public function find_dni($dni) {
            $datos = mainModel::connect()->query("SELECT idAccount, accountDni, accountCode
                FROM accounts WHERE accountDni ='$dni'");
            return $datos->fetchAll();
        }

        //Buscar id progreso
        public function find_idProgress($idProgress) {
            $datos = mainModel::connect()->query("SELECT idProgress
                FROM progress WHERE progressAccount ='$idProgress'");
            return $datos->fetchAll();
        }
    }
