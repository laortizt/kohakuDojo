<?php
    
    if($petitionAjax){
        require_once "../config/mainModel.php";
    }else{
        // si la eticion ajax es fale aceder a la configuración DB
        require_once "./config/mainmodel.php";
    }

    //MODELO PARA  LLAMAR LA LISTA DE USUARIOS
    class modelAdmin extends mainModel{

        public function get_listAssistance($datos) {
            
        }
}