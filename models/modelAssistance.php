<?php
    
    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }

    //MODELO PARA  LLAMAR LA LISTA DE USUARIOS
    class modelAssistance extends mainModel{

        public function get_listAssistance($data) {
            $sql=mainModel::connect()->prepare("UPDATE class 
            SET classDate=:Date, classTeacher=:Teacher, classTopic=:Topic
            WHERE idClass=:IdClass");
        $sql->bindParam(":Date",$data['Date']);
        $sql->bindParam(":Teacher",$data['Teacher']);
        $sql->bindParam(":Topic",$data['Topic']);
        $sql->bindParam(":IdClass",$data['IdClass']);
        
        $sql->execute();

        return $sql;      
        }
        
}