<?php
    //CONTROLADOR PARA CREAR ADMINISTRADOR
    if($petitionAjax){
        require_once "../models/modelProfile.php";
    }else{
        // si la Peticion ajax es false aceder a la configuración DB
        require_once "./models/modelProfile.php";
    }

    class controllerProfile extends modelProfile{
        //controlador para agregar administrador
        public function get_profile_controller(){
            $profile = modelProfile::get_profile_model($_SESSION['code_sk']);
            return $profile;

            // $typeDocument= mainModel::clean_string($_POST['']);
            // $Dni= mainModel::clean_string($_POST['dni']);
            // $firstName= mainModel::clean_string($_POST['FirstName']); 
            // $lastName= mainModel::clean_string($_POST['LastName']);
            // $addres= mainModel::clean_string($_POST['Adress']); 
            // $phone= mainModel::clean_string($_POST['Phone']);
            // $user= mainModel::clean_string($_POST['User']);
            // $email= mainModel::clean_string($_POST['Email']);
            // $password= mainModel::clean_string($_POST['Pass1']);
            // $genre= mainModel::clean_string($_POST['Genere']);
            // $privilegio= mainModel::clean_string($_POST['Privileges']);
        }

        public function list_typeDocument_controller($userCurrentDocType){
            $documentTypes = modelProfile::list_typeDocuments_model();

            $select = '<select class="input-field" name="typeDocument-profile" required="">';
            
            foreach($documentTypes as $documentType){
                if ($documentType['idDocumentType'] == $userCurrentDocType) {
                    $select.='
                        <option value="'.$documentType['idDocumentType'].'" selected="">'
                        .$documentType['nameDocumentType'].
                        '</option>
                    ';
                } else {
                    $select.='
                        <option value="'.$documentType['idDocumentType'].'">'
                        .$documentType['nameDocumentType'].
                        '</option>
                    ';
                }
            }

            $select.='</select>';

            return $select;
        }

        public function list_genres_controller($userCurrentGenre) {
            $genres = modelProfile::list_genres_model();

            $select = '<select class="input-field" name="genere-profile" required="">';
            
            foreach($genres as $genre){
                if ($genre['idGenre'] == $userCurrentGenre) {
                    $select.='
                        <option value="'.$genre['idGenre'].'" selected="">'
                        .$genre['nameGenre'].
                        '</option>
                    ';
                } else {
                    $select.='
                        <option value="'.$genre['idGenre'].'">'
                        .$genre['nameGenre'].
                        '</option>
                    ';
                }
            }

            $select.='</select>';

            return $select;
        }

        public function save_profile(){
            
        }
    }