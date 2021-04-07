<?php
    //CONTROLADOR PARA CREAR ADMINISTRADOR
    if($petitionAjax){
        require_once "../models/modelProfile.php";
    }else{
        // si la Peticion ajax es false aceder a la configuración DB
        require_once "./models/modelProfile.php";
    }

    class controllerProfile extends modelProfile{
        //funciòn que me trae la informaciòn de la cuenta
        public function get_profile_controller(){
            $profile = modelProfile::get_profile_model($_SESSION['code_sk']);
            return $profile;
        }  
        //funciòn que llama la lista de tipos de documento de model
        public function list_typeDocument_controller($userCurrentDocType){
            $documentTypes = modelProfile::list_typeDocuments_model();

            $select = '<select class="input-field-profile" name="typeDocument-profile" required="">';
            
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
        //funciòn que llama la lista de generos de model
        public function list_genres_controller($userCurrentGenre) {
            $genres = modelProfile::list_genres_model();

            $select = '<select class="input-field-profile" name="genre-profile" required="">';
            
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

        //funciòn que guarda la informaciòn del perfil
        public function save_profile(){
            // Limpiar la información diligenciada
            $typeDocument= mainModel::clean_string($_POST['typeDocument-profile']);
            $Dni= mainModel::clean_string($_POST['dni-profile']);
            $firstName= mainModel::clean_string($_POST['firstname-profile']); 
            $lastName= mainModel::clean_string($_POST['lastname-profile']);
            $address= mainModel::clean_string($_POST['adress-profile']); 
            $email= mainModel::clean_string($_POST['email-profile']);
            $phone= mainModel::clean_string($_POST['phone-profile']);
            $genre= mainModel::clean_string($_POST['genre-profile']);

            // Validar condiciones
            $profilesByDni=modelProfile::find_dni($Dni);

            if (count($profilesByDni) > 1 || 
                (count($profilesByDni) == 1 && $profilesByDni[0]['accountDni'] != $Dni) )
            {
                $alert=[
                    "alert"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"El número de Identificación ya está registrado",
                    "type"=>"error"
                ];
            }else {
                 // Buscar por correo
                $profilesByEmail=modelProfile::find_email($email);
            
                // Si existe uno, verificar si su account code coincide con el usuario actual
                if(count($profilesByEmail) != 1 || $profilesByEmail[0]['accountCode'] != $_SESSION['code_sk']){
                    // Si no coincide, error
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Ocurrio un error inesperado",
                        "text"=>"Usuario no encontrado",
                        "type"=>"error"
                    ];                         
                }else{
                    // Si coincide, proceder con la actualización
                    $id = $profilesByEmail[0]['idAccount'];
    
                    // Si todas se cumplen, llamar al modelo para que ejecute el cambio, enviando la info en un arreglo
                    $dataProfile = [
                        "Id"=>$id,
                        "DocumentType"=>$typeDocument,
                        "Dni"=>$Dni,
                        "FirstName"=>$firstName,
                        "LastName"=>$lastName,
                        "Address"=>$address,
                        "Phone"=>$phone,
                        "Genre"=>$genre
                    ];
    
                    $saveProfile = modelProfile::update_profile_model($dataProfile);
    
                    // Verificar si el cambió se aplico e informar al usuario
                    if($saveProfile->rowCount() >= 1){
                        $alert=[
                            "alert"=>"limpiar",
                            "title"=>"Actualizar perfil",
                            "text"=>"El perfil se ha actualizado exitósamente.",
                            "type"=>"success"
                        ];
                    } else {
                        $alert=[
                            "alert"=>"simple",
                            "title"=>"Actualizar perfil",
                            "text"=>"No se pudo actualizar el perfil, verifique los campos e intente de nuevo.",
                            "type"=>"error"
                        ];
                    }
                }
                

            }

            return mainModel::sweet_alert($alert);
        }
    }