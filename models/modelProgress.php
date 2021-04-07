<?php
    
    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }

    //MODELO PARA PROGRESO DE ALUMNOS
    class modelPayment extends mainModel{

        //Traer la lista de grados
        public function list_menkyo_model() {
            //Obtiene los trámites registrados
            $datos = mainModel::connect()->query("SELECT * FROM menkyo");
            return $datos->fetchAll();
        }

         // Listar  grados
         public function get_progress_model($dni) {
            $sql= mainModel::connect()->prepare("SELECT *
                FROM accounts a INNER JOIN menkyo m ON (m.idmenkyo = a.accountMenkyo) WHERE a.accountDni=:dni");
            $sql->bindParam(':dni', $dni);
            $sql->execute(); 

            return $sql->fetch();
        }
        
         //Actualizar Grados
         public function update_progress_model($data) {
            $sql=mainModel::connect()->prepare("UPDATE progress  
                SET progressDate=:Date, progressDni=:Dni,  progressMenkyo=:Menkyo, 
                progressObservation=:Observation, progressState=:State, progressAccount=:IdAccount,
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
         //Crear Grado
         public function create_progress_model($datos) {
            $sql=mainModel::connect()->prepare("INSERT INTO progress 
                (progressDate, progress,  paymentPrice,
                paymentObservation, paymentAccount)
                VALUES (:Date, :Procedure, :Price, :Observation, :IdAccount)");
            $sql->bindParam(":Date",$datos['Date']);
            $sql->bindParam(":Procedure",$datos['Procedure']);
            $sql->bindParam(":Price",$datos['Price']);
            $sql->bindParam(":Observation",$datos['Observation']);
            $sql->bindParam(":IdAccount",$datos['IdAccount']);
            
            $sql->execute();

            return $sql;
        }
         
         //Eliminar Pagos
        protected function delete_pay($idPay){
            $sql=mainModel::connect()->prepare("DELETE FROM payments WHERE idPayments=:idPayments");
            $sql->bindParam(":idPayments",$idPayments);
            $sql->execute();

            return $sql;
        }
        public function find_dni($dni) {
            $datos = mainModel::connect()->query("SELECT idAccount, accountDni, accountCode
                FROM accounts WHERE accountDni ='$dni'");
            return $datos->fetchAll();
        }
    }
