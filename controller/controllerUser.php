<?php
    //CONTROLADOR PARA CREAR ADMINISTRADOR
    if($petitionAjax){
        require_once "../models/modelUser.php";
    }else{
        // si la Peticion ajax es false aceder a la configuración DB
        require_once "./models/modelUser.php";
    }

//clase heredada de modelo user
    class controllerUser extends modelUser{

        //DESDE AQUI modificardatos con os del formulario
        public function add_controller_User(){
            $typeDocument= mainModel::clean_string($_POST['DocumentType']);
            $Dni= mainModel::clean_string($_POST['Dni']);
            $FirstName= mainModel::clean_string($_POST['FirstName']); 
            $LastName= mainModel::clean_string($_POST['LastName']);
            $Addres= mainModel::clean_string($_POST['Adress']); 
            $Phone= mainModel::clean_string($_POST['Phone']);
            $genre= mainModel::clean_string($_POST['Genere']);
            $Email= mainModel::clean_string($_POST['Email']);
            $Role= mainModel::clean_string($_POST['Role']);
            $State= mainModel::clean_string($_POST['State']);
            
            

            //validación contraseñas
        
            //validación documento registrado
            $consult1= mainModel::run_simple_query("SELECT accountDni
                FROM accounts WHERE accountDni ='$Dni'");

            if($consult1->rowCount()>=1){
                $alert=[
                    "alert"=>"simple",
                    "title"=>"Ocurrio un error inesperado",
                    "text"=>"El número de identificación ya está registrado",
                    "type"=>"error"
                ];
            }else{
                //validación correo
                if($Email!=""){
                    $consult2=mainModel::run_simple_query("SELECT accountEmail
                    FROM accounts WHERE accountEmail= '$Email'");  
                    //variable correo-cuenta- columnas afectadas
                    $cc=$consult2->rowCount();
                }else{
                    //si no existe es 0
                    $cc=0;
                }
                if($cc>=1){
                    $alert=[
                        "alert"=>"simple",
                        "title"=>"Ocurrio un error inesperado",
                        "text"=>"El correo ingresado está registrado",
                        "type"=>"error"
                    ];
                }else{
    
                //validación cuantos registros tengo
                $consult4=mainModel::run_simple_query("SELECT idAccount
                    FROM accounts");
                    //variable para guardar la consulta
                $num=($consult4->rowCount())+1;
                    // generar código aletaorio de 10 cifras AC: Account
                $code=mainModel::generate_random_code("AC", 10, $num);

                // encriptar la contraseña +++LO NECESITA EL ADMIN???
                // $password=mainModel::encryption($password);

                // Crar un array para ingresar una cuenta
                $dataAC=[
                    "Code"=>$code,
                    "Email"=>$Email,
                    // "Pasword"=>$password,
                    "Role"=>3,
                    "State"=>1,
                    "FirstName"=>$FirstName,
                    "LastName"=>$LastName,
                ];
                $saveAccount=modelUser::add_user_account($dataAC);
                    
                    // Comprobar si se registro la cuenta
                    if($saveAccount->rowCount()>=1){
                        $alert=[
                            "alert"=>"limpiar",
                            "title"=>"Usuario registrado",
                            "text"=>"El usuario se creo con Éxito",
                            "type"=>"success"
                        ];
                    }else{
                        $alert=[
                            "alert"=>"simple",
                            "title"=>"Ocurrio un error inesperado",
                            "text"=>"El usuario no se pudo registrar",
                            "type"=>"error"
                        ];
                    }
                }
            }
           return mainModel::sweet_alert($alert);
        }
    
        

        // Traer datos de un perfil usando el accountCode (LO TRAJE DE PROFILE)
        public function get_user_model($code) {
            $sql= mainModel::connect()->prepare("SELECT idAccount, accountCode, accountDocumentType,
                accountDni, accountFirstName, accountLastName, accountAddress, accountPhone, accountGenre, accountEmail,
                accountrRole,accountState
                FROM accounts WHERE accountCode=:code");
            $sql->bindParam(':code', $code);
            $sql->execute();

            return $sql->fetch();
        }

        //Actualizar perfil
        public function update_user_model($data) {
            $sql=mainModel::connect()->prepare("UPDATE accounts 
                SET accountDocumentType=:DocumentType, accountDni=:Dni, accountFirstName=:FirstName,
                    accountLastName=:LastName, accountAddress=:Address, accountPhone=:Phone,
                    accountGenre=:Genre, accountEmail=:Email, accountRole=:Role, accountState=:State
                WHERE idAccount=:IdAccount");
            $sql->bindParam(":DocumentType",$data['DocumentType']);
            $sql->bindParam(":Dni",$data['Dni']);
            $sql->bindParam(":FirstName",$data['FirstName']);
            $sql->bindParam(":LastName",$data['LastName']);
            $sql->bindParam(":Address",$data['Address']);
            $sql->bindParam(":Phone",$data['Phone']);
            $sql->bindParam(":Genre",$data['Genre']);
            $sql->bindParam(":Email",$data['Email']);
            $sql->bindParam(":Role",$data['Role']);
            $sql->bindParam(":State",$data['State']);
            $sql->bindParam(":IdAccount",$data['Id']);
            
            $sql->execute();

            return $sql;
        }

        //Buscar dni (buscador)???
        public function find_dni($dni) {
            //Obtiene los perfiles que coincidan con el dni enviado
            $datos = mainModel::connect()->query("SELECT idAccount, accountDni, accountCode
                FROM accounts WHERE accountDni ='$dni'");
            return $datos->fetchAll();
        }

        public function list_typeDocument_controller($userCurrentDocType){
            $documentTypes = modelUser::list_typeDocuments_model();

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
            $genres = modelUser::list_genres_model();

            $select = '<select class="input-field" name="genre-newUser" required="">';
            
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

        public function list_role_controller($userCurrentGenre) {
            $roles= modelUser::list_roles_model();

            $select = '<select class="input-field" name="role-newUser" required="">';
            
            foreach($roles as $role){
                if ($role['idRole'] == $userCurrentGenre) {
                    $select.='
                        <option value="'.$role['idRole'].'" selected="">'
                        .$role['Rolename'].
                        '</option>
                    ';
                } else {
                    $select.='
                        <option value="'.$role['idRole'].'">'
                        .$role['Rolename'].
                        '</option>
                    ';
                }
            }

            $select.='</select>';

            return $select;
        }

        public function list_states_controller($userCurrentGenre) {
            $states= modelUser::list_states_model();

            $select = '<select class="input-field" name="state-newUser" required="">';
            
            foreach($states as $state){
                if ($state['idState'] == $userCurrentGenre) {
                    $select.='
                        <option value="'.$state['idState'].'" selected="">'
                        .$state['idState'].
                        '</option>
                    ';
                } else {
                    $select.='
                        <option value="'.$state['idState'].'">'
                        .$state['idState'].
                        '</option>
                    ';
                }
            }

            $select.='</select>';

            return $select;
        }
    }